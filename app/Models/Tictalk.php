<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Override;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Translatable\HasTranslations;

class Tictalk extends Model implements HasMedia
{
    use HasSlug, HasTags, HasTranslations, InteractsWithMedia;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];

    public array $translatable = ['title', 'description', 'content'];

    /**
     * Get the excerpt.
     *
     * @return string
     */
    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::limit(strip_tags((string) $this->content), 200)
        );
    }

    /**
     * Get the category that owns the Ticktalks
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TictalksCategory::class, 'tictalks_category_id');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->usingLanguage('id')
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('webp')
            ->width(1024)
            ->format('webp')
            ->performOnCollections('thumbnail')
            ->nonQueued();

        $this->addMediaConversion('webp_small')
            ->width(400)
            ->performOnCollections('thumbnail')
            ->format('webp')
            ->nonQueued();
    }

    /**
     * Filter out empty or disallowed translations
     * Modified to filter out empty array
     */
    protected function filterTranslations(mixed $value = null, ?string $locale = null, ?array $allowedLocales = null): bool
    {
        if ($value === null) {
            return false;
        }

        if ($value === '') {
            return false;
        }

        if ($value === []) {
            return false;
        }

        if ($value === '<p></p>') {
            return false;
        }

        if ($allowedLocales === null) {
            return true;
        }

        if (! in_array($locale, $allowedLocales)) {
            return false;
        }

        return true;
    }
}
