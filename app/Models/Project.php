<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Project extends Model implements TranslatableContract
{
    use Translatable;

    protected $translatedAttributes = ['title', 'content'];
    protected $fillable = [
        'is_active', 'url', 'order',
    ];

    protected $casts = [
        'is_active' => "boolean"
    ];

    protected $attributes = [
        "is_active" => false,
    ];

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
