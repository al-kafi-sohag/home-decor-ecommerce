<?php

namespace App\Models;

use App\Enums\CategoryStatus;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model implements HasMedia
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory, HasSlug, InteractsWithMedia, SoftDeletes;

    /**
     * Media collection that holds the category image (optional).
     */
    public const IMAGE_COLLECTION = 'image';

    protected $fillable = [
        'title',
        'slug',
        'is_featured',
        'is_menu',
        'status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_menu' => 'boolean',
            'status' => CategoryStatus::class,
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Register media collections. The image is optional and holds a single file.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::IMAGE_COLLECTION)
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    /**
     * Public URL for the uploaded category image, or null when none is set.
     */
    public function imageUrl(): ?string
    {
        return $this->getFirstMediaUrl(self::IMAGE_COLLECTION) ?: null;
    }
}
