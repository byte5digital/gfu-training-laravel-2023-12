<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'text',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];


    public function __toString(): string
    {
        return $this->title;
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Returns the options to make it slugable
     *
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Returns single paragraphs as `Collection`.
     *
     * @return Collection
     */
    public function getTextAsParagraphs(): Collection
    {
        return collect(preg_split('#[\r\n]+#', $this->text));
    }

    /**
     * Returns the url of the detail page
     *
     * @return string
     */
    public function getReadMoreLinkAttribute(): string
    {
        return route('blog.show', ['post' => $this]);
    }


    public function title(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => strtoupper($value),
        );
    }


    public function editLink(): Attribute
    {
        return Attribute::make(
            get: fn() => route('posts.edit', ['post' => $this]),
        );
    }

    /**
     * order items recursive by created_at
     *
     * @param Builder $query
     * @return void
     */
    public function scopeRecursive(Builder $query): void
    {
        $query->orderBy('created_at', 'DESC');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
