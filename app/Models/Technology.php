<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Technology extends Model implements TranslatableContract
{
    use Translatable;

    protected $translatedAttributes = ['title'];

    // ****** BEGIN Actions ************

    public function scopeVisible($q)
    {
        return $q->where('is_visible', true);
    }

    // ****** END Actions ************

    // ****** BEGIN Relations ************

    

    // ****** END Relations ************
}
