<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Banner extends Model implements TranslatableContract
{
    use Translatable;

    const TYPE_BANNER = "BANNER";

    protected $fillable = [
        'type', 'is_active', 'url', 'order',
    ];

    protected $translatedAttributes = ['title', 'content'];

    // ****** BEGIN Actions ************

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function landscape()
    {
        $this->loadMissing('images');
        return $this->images->where('pivot.meta', "landscape")->first();
    }

    // ****** END Actions ************

    // ****** BEGIN Relations ************

    public function images()
    {
        return $this->morphToMany(
            Picture::class,
            'entity',
            'entity_has_images'
        )->withPivot('meta');
    }

    // ****** END Relations ************
}
