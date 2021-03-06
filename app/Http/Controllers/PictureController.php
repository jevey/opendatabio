<?php

/*
 * This file is part of the OpenDataBio app.
 * (c) OpenDataBio development team https://github.com/opendatabio
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taxon;
use App\Person;
use App\Picture;
use Lang;
use App\UserTranslation;
use App\Language;
use App\Tag;
use App\Location;
use App\Voucher;
use App\Plant;

class PictureController extends Controller
{
    public function createTaxons($id)
    {
        $object = Taxon::findOrFail($id);

        return $this->create($object);
    }

    public function createLocations($id)
    {
        $object = Location::findOrFail($id);

        return $this->create($object);
    }

    public function createVouchers($id)
    {
        $object = Voucher::findOrFail($id);

        return $this->create($object);
    }

    public function createPlants($id)
    {
        $object = Plant::findOrFail($id);

        return $this->create($object);
    }

    protected function create($object)
    {
        $persons = Person::all();
        $languages = Language::all();
        $tags = Tag::all();

        return view('pictures.create', compact('object', 'persons', 'languages', 'tags'));
    }

    public function edit($id)
    {
        $persons = Person::all();
        $languages = Language::all();
        $picture = Picture::findOrFail($id);
        $tags = Tag::all();
        $object = $picture->object;

        return view('pictures.create', compact('object', 'persons', 'languages', 'picture', 'tags'));
    }

    public function show($id)
    {
        $picture = Picture::findOrFail($id);

        return view('pictures.show', compact('picture'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Picture::class);
        $this->validate($request, [
            'image' => 'file|required',
            'description' => 'array',
            'tags' => 'array',
            'collector' => 'required|array|min:1',
        ]);
        $picture = Picture::create($request->only(['object_id', 'object_type']));
        $contents = file_get_contents($request->image->getRealPath());
        try {
            $picture->saveImage($contents);
        } catch (\Intervention\Image\Exception\NotReadableException $e) {
            $picture->delete();

            return redirect()->back()
                ->withErrors(['image' => Lang::get('messages.invalid_image')])
                ->withInput();
        }
        $picture->tags()->sync($request->tags);
        // syncs collectors
        foreach ($request->collector as $collector) {
            $picture->collectors()->create(['person_id' => $collector]);
        }
        // syncs descriptions
        foreach ($request->description as $key => $translation) {
            $picture->setTranslation(UserTranslation::DESCRIPTION, $key, $translation);
        }

        return redirect('pictures/'.$picture->id)->withStatus(Lang::get('messages.stored'));
    }

    public function update(Request $request, $id)
    {
        $picture = Picture::findOrFail($id);
        $this->authorize('update', $picture);
        $this->validate($request, [
            'description' => 'array',
            'tags' => 'array',
            'collector' => 'required|array|min:1',
        ]);
        $picture->tags()->sync($request->tags);
        // syncs collectors
        if ($request->collector) {
            // sync collectors. See app/Project.php / setusers()
            $current = $picture->collectors->pluck('person_id');
            $detach = $current->diff($request->collector)->all();
            $attach = collect($request->collector)->diff($current)->all();
            $picture->collectors()->whereIn('person_id', $detach)->delete();
            foreach ($attach as $collector) {
                $picture->collectors()->create(['person_id' => $collector]);
            }
        }
        // syncs descriptions
        foreach ($request->description as $key => $translation) {
            $picture->setTranslation(UserTranslation::DESCRIPTION, $key, $translation);
        }

        return redirect('pictures/'.$picture->id)->withStatus(Lang::get('messages.stored'));
    }
}
