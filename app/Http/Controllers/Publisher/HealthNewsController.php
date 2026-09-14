<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\HealthNews;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HealthNewsController extends Controller
{
    public function index(): View
    {
        return view('publisher.news.index', [
            'newsItems' => HealthNews::query()->with('author')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('publisher.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'headline' => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'source_name' => ['nullable', 'string', 'max:255'],
            'source_url' => ['nullable', 'url', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'publish_now' => ['nullable', 'boolean'],
        ]);

        $imageUrl = $this->storeCoverImage($request);

        HealthNews::query()->create([
            ...$data,
            'user_id' => $request->user()->id,
            'image_url' => $imageUrl,
            'published_at' => $this->resolvePublishedAt($request),
            'slug' => Str::slug($data['headline']).'-'.Str::lower(Str::random(6)),
        ]);

        return redirect()->route('publisher.news.index')->with('status', 'Health news created.');
    }

    public function edit(HealthNews $news): View
    {
        return view('publisher.news.edit', ['newsItem' => $news]);
    }

    public function update(Request $request, HealthNews $news): RedirectResponse
    {
        $data = $request->validate([
            'headline' => ['required', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'source_name' => ['nullable', 'string', 'max:255'],
            'source_url' => ['nullable', 'url', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'publish_now' => ['nullable', 'boolean'],
        ]);

        $imageUrl = $this->storeCoverImage($request) ?: $news->image_url;

        $news->update([
            ...$data,
            'image_url' => $imageUrl,
            'published_at' => $this->resolvePublishedAt($request),
        ]);

        return redirect()->route('publisher.news.index')->with('status', 'Health news updated.');
    }

    public function destroy(HealthNews $news): RedirectResponse
    {
        $news->delete();

        return redirect()->route('publisher.news.index')->with('status', 'Health news deleted.');
    }

    private function resolvePublishedAt(Request $request): ?Carbon
    {
        if (! $request->boolean('publish_now') && ! $request->filled('published_at')) {
            return null;
        }

        if ($request->filled('published_at')) {
            return Carbon::parse((string) $request->input('published_at'));
        }

        return now();
    }

    private function storeCoverImage(Request $request): ?string
    {
        if (! $request->hasFile('cover_image')) {
            return null;
        }

        $path = $request->file('cover_image')->store('news-covers', 'public');

        return '/storage/'.$path;
    }
}

