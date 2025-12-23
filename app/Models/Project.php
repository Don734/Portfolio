<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use App\Enums\ProjectVisibility;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements TranslatableContract, HasMedia
{
    use Translatable;
    use InteractsWithMedia;

    protected $translatedAttributes = ['title', 'content'];
    protected $fillable = [
        'slug', 'status', 'type', 'started_at', 'finished_at', 'priority', 'visibility'
    ];

    protected $casts = [
        'status' => ProjectStatus::class,
        'type' => ProjectType::class,
        'visibility' => ProjectVisibility::class,
    ];

    // ****** BEGIN Actions ************

    public static function boot()
    {
        parent::boot();
        self::saving(function (self $instance) {
            $instance->slug = empty($instance->slug) ? Str::slug($instance->translate('en')->title) : $instance->slug;
        });
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg','image/png','image/webp'])
            ->singleFile(false);

        $this->addMediaCollection('cover')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->sharpen(10)
            ->queued();

        $this->addMediaConversion('webp')
            ->format('webp')
            ->width(1200)
            ->queued();
    }

    // ****** END Actions ************

    // ****** BEGIN Relations ************

    

    // ****** END Relations ************
}
