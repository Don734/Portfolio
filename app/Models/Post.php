<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Post extends Model implements TranslatableContract
{
    use Translatable;

    const STATUS_PUBLISHED = "PUBLISHED";
    const STATUS_DRAFT = "DRAFT";
    
    const STATUSES = [
        self::STATUS_PUBLISHED,
        self::STATUS_DRAFT
    ];

    protected $translatedAttributes = ['title', 'content'];
    protected $fillable = [
        'status', 'slug', 'published_at'
    ];

    // ****** BEGIN Actions ************

    public function scopePublished($q)
    {
        return $q->where('status', self::STATUS_PUBLISHED);
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
