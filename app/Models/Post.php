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

    protected $fillable = [
        'status', 'slug', 'published_at'
    ];

    protected $translatedAttributes = ['title', 'content'];
}
