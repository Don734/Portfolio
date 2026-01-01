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
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements TranslatableContract, HasMedia
{
    use Translatable;
    use InteractsWithMedia;

    protected $translatedAttributes = ['title', 'description'];
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

    public function scopeActive($q): bool
    {
        return $q->where('is_active', true);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile();
            
        $this->addMediaCollection('gallery');

        $this->addMediaCollection('video')
            ->singleFile();

        $this->addMediaCollection('attachments');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(300)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('webp')
            ->format('webp')
            ->width(1200)
            ->nonQueued();
    }

    // ****** END Actions ************

    // ****** BEGIN Relations ************

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'project_has_categories', 'project_id', 'category_id');
    }

    public function techs()
    {
        return $this->belongsToMany(Technology::class, 'project_has_technologies', 'project_id', 'technology_id');
    }

    // ****** END Relations ************
}
