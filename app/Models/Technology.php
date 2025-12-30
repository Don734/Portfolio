<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Technology extends Model implements TranslatableContract, HasMedia
{
    use Translatable;
    use InteractsWithMedia;

    protected $translatedAttributes = ['title'];
    protected $fillable = [
        'slug', 'color', 'order', 'is_visible'
    ];

    // ****** BEGIN Actions ************

    public static function boot()
    {
        parent::boot();
        self::saving(function (self $instance) {
            $instance->slug = empty($instance->slug) ? Str::slug($instance->translate('en')->title) : $instance->slug;
        });
    }

    public function scopeVisible($q)
    {
        return $q->where('is_visible', true);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')
            ->singleFile();
    }

    // ****** END Actions ************

    // ****** BEGIN Relations ************

    

    // ****** END Relations ************
}
