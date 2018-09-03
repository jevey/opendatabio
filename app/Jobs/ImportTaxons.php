<?php

/*
 * This file is part of the OpenDataBio app.
 * (c) OpenDataBio development team https://github.com/opendatabio
 */

namespace App\Jobs;

use App\Taxon;
use App\ExternalAPIs;

class ImportTaxons extends AppJob
{
    /**
     * Execute the job.
     */
    public function inner_handle()
    {
        $data = $this->extractEntrys();
        if (!$this->setProgressMax($data)) {
            return;
        }
        foreach ($data as $taxon) {
            if ($this->isCancelled()) {
                break;
            }
            $this->userjob->tickProgress();

            if (array_key_exists('parent_name', $taxon) and (null === $taxon['parent_name'])) {
                unset($taxon['parent_name']);
            }

            if ($this->validateData($taxon)) {
                // Arrived here: let's import it!!
                try {
                    $this->import($taxon);
                } catch (\Exception $e) {
                    $this->setError();
                    $this->appendLog('Exception '.$e->getMessage().' at '.$e->getFile().'+'.$e->getLine().' on taxon '.$taxon['name']);
                }
            }
        }
    }

    protected function validateData(&$taxon)
    {
        if (!$this->hasRequiredKeys(['name'], $taxon)) {
            return false;
        }
        if (!$this->validateAPIs($taxon)) {
            return false;
        }
        if (!$this->validateParentAndLevel($taxon)) {
            return false;
        }
        if (!$this->validateSeniorAndValid($taxon)) {
            return false;
        }
        // TODO: several other validation checks

        return true;
    }

    /**
    * If taxon['mobot'] exists with a key, replaces it to an array with index 'key' having this value.
    * If it not exists, try to get it from the external mobot API and creates this field with the obtained
    * key. If fails to obtain it from the API, set taxon['mobot'] to an empty array.
    * The same process is applied for taxon['ipni'] with external ipni API.
    * This is done for use at other fields validation of taxon.
    */
    protected function validateAPIs(&$taxon)
    {
        // TODO: check / add level, parent, etc from APIs??
        $apis = new ExternalAPIs();
        $name = $taxon['name'];

        // MOBOT
        $mobotdata['key'] = array_key_exists('mobot', $taxon) ? $taxon['mobot'] : null;
        if (!$mobotdata['key']) {
            try {
                $mobotdata = $apis->getMobot($name);
                if (!$mobotdata['key']) {
                    $mobotdata['key'] = null;
                }
                $taxon['mobot'] = $mobotdata;
            } catch (\Exception $e) {
                $taxon['mobot'] = array ();
            }
        }

        // IPNI
        $ipnidata['key'] = array_key_exists('ipni', $taxon) ? $taxon['ipni'] : null;
        if (!$ipnidata['key']) {
            try {
                $taxon['ipni'] = array ();
                $ipnidata = $apis->getIPNI($name);
                if (!array_key_exists('key', $ipnidata)) {
                    $ipnidata['key'] = null;
                }
                $taxon['ipni'] = $ipnidata;
            } catch (\Exception $e) {
                $taxon['ipni'] = array ();
            }
        }

        return true;
    }

    protected function validateParentAndLevel(&$taxon)
    {
        if (!$this->validateLevel($taxon)) {
            return false;
        }
        if (!$this->validateParent($taxon)) {
            return false;
        }
        if (($taxon['level'] > 180) and (null === $taxon['parent_name'])) {
            $this->skipEntry($taxon, 'Parent for taxon '.$taxon['name'].' is required!');

            return false;
        }

        return true;
    }

    protected function validateSeniorAndValid(&$taxon)
    {
        if (!$this->validateSenior($taxon)) {
            return false;
        }
        if (!$this->validateValid($taxon)) {
            return false;
        }

        return true;
    }

    protected function validateLevel(array &$taxon)
    {
        $level = $this->getValue($taxon, 'level');
        if (!is_numeric($level) and !is_null($level)) {
            $level = Taxon::getRank($level);
        }
        if (is_null($level)) {
            $name = $taxon['name'];
            $this->skipEntry($taxon, "Level for taxon $name not available");

            return false;
        }
        $taxon['level'] = $level;

        return true;
    }

    protected function validateParent(&$taxon)
    {
        if (!array_key_exists('parent_name', $taxon)) {
            $taxon['parent_name'] = $this->getTaxonIdFromAPI($taxon, 'parent');

            return true;
        }
        // parent might be numeric (ie, already the ID) or a name. if it's a name, let's get the id
        $parent = $this->getTaxonId($taxon['parent_name']);
        if (null === $parent) {
            $name = $taxon['name'];
            $parent = $taxon['parent_name'];
            $this->skipEntry($taxon, "Parent for taxon $name is listed as $parent, but this was not found in the database");

            return false;
        } else {
            $taxon['parent_name'] = $parent;

            return true;
        }
    }

    protected function getTaxonIdFromAPI($taxon, $field)
    {
        if (array_key_exists('mobot', $taxon) and array_key_exists($field, $taxon['mobot'])) {
            return $this->getTaxonId($taxon['mobot'][$field]);
        }
        if (array_key_exists('ipni', $taxon) and array_key_exists($field, $taxon['ipni'])) {
            return $this->getTaxonId($taxon['ipni'][$field]);
        }

        return null;
    }

    protected function validateSenior(&$taxon)
    {
        if (!array_key_exists('senior', $taxon)) {
            $taxon['senior'] = $this->getTaxonIdFromAPI($taxon, 'senior');

            return true;
        }
        // parent might be numeric (ie, already the ID) or a name. if it's a name, let's get the id
        $senior = $this->getTaxonId($taxon['senior']);
        if (null === $senior) {
            $name = $taxon['name'];
            $senior = $taxon['senior'];
            $this->skipEntry($taxon, "Senior for taxon $name is listed as $senior, but this was not found in the database");

            return false;
        } else {
            $taxon['senior'] = $senior;

            return true;
        }
    }

    protected function getTaxonId($ref)
    {
        if (is_null($ref)) {
            return null;
        }
        // ref might be numeric (ie, already the ID) or a name. if it's a name, let's get the id
        if (is_numeric($ref)) {
            $ref = Taxon::select('id')->where('id', '=', $ref)->get();
        } else {
            $ref = Taxon::select('id')->whereRaw('odb_txname(name, level, parent_id) = ?', [$ref])->get();
        }
        if (count($ref)) {
            return $ref->first()->id;
        }

        return null;
    }

    protected function validateValid(&$taxon)
    {
        if (null === $taxon['senior']) {
            if (!array_key_exists('valid', $taxon)) {
                $taxon['valid'] = true;
            }

            return $taxon['valid'];
        } else {
            if (!array_key_exists('valid', $taxon)) {
                $taxon['valid'] = false;
            }

            return !$taxon['valid'];
        }
    }

    public function import($taxon)
    {
        $name = $taxon['name'];
        $parent = $taxon['parent_name'];
        $level = $taxon['level'];
        $bibreference = array_key_exists('bibreference', $taxon) ? $taxon['bibreference'] : null;
        $author = array_key_exists('author', $taxon) ? $taxon['author'] : null;
        $senior = $taxon['senior'];
        $valid = $taxon['valid'];
        $mobot = array_key_exists('mobot', $taxon) ? $taxon['mobot'] : null;
        $ipni = array_key_exists('ipni', $taxon) ? $taxon['ipni'] : null;
        // Is this taxon already imported?
        if (Taxon::whereRaw('odb_txname(name, level, parent_id) = ? AND parent_id = ?', [$name, $parent])->count() > 0) {
            $this->skipEntry($taxon, 'taxon '.$name.' already imported to database');

            return;
        }

        $taxon = new Taxon([
            'level' => $level,
            'parent_id' => $parent,
            'valid' => $valid,
            'senior_id' => $senior,
            'author' => $author,
            'bibreference' => $bibreference,
        ]);
        $taxon->fullname = $name;
        $taxon->save();
        if (!is_null($mobot) and $mobot['key']) {
            $taxon->setapikey('Mobot', $mobot['key']);
        }
        if (!is_null($ipni) and $ipni['key']) {
            $taxon->setapikey('IPNI', $ipni['key']);
        }
        $taxon->save();
        $this->affectedId($taxon->id);

        return;
    }
}
