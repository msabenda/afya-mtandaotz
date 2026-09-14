<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class HealthNews extends Model
{
    protected $table = 'health_news';

    protected $fillable = [
        'user_id',
        'headline',
        'slug',
        'summary',
        'image_url',
        'source_name',
        'source_url',
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

    public function getImageUrlAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        if (Str::startsWith($value, 'http://localhost/storage/')) {
            return parse_url($value, PHP_URL_PATH) ?: $value;
        }

        return $value;
    }

    public function getSummaryAttribute(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        return str_replace('http://localhost/storage/', '/storage/', $value);
    }
}
