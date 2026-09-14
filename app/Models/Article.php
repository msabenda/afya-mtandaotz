<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'cover_image_url',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function authorDisplayName(): string
    {
        return $this->author?->name ?? config('app.name');
    }

    public function getCoverImageUrlAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        if (Str::startsWith($value, 'http://localhost/storage/')) {
            return parse_url($value, PHP_URL_PATH) ?: $value;
        }

        return $value;
    }

    public function getBodyAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        return str_replace('http://localhost/storage/', '/storage/', $value);
    }
}
