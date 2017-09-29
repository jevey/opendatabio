<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Language;

class UserTranslation extends Model
{
    const NAME = 0;
    const DESCRIPTION = 1;

    protected $fillable = ['translatable_type', 'translatable_id', 'language_id', 'translation', 'translation_type'];
    public function language() {
        return $this->belongsTo(Language::class);
    }
    public function translatable() {
        return $this->morphTo();
    }
}