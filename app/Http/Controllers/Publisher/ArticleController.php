<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewArticleNewsletterJob;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('publisher.articles.index', [
            'articles' => Article::query()->with('author')->latest()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('publisher.articles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'published_at' => ['nullable', 'date'],
            'publish_now' => ['nullable', 'boolean'],
        ]);

        $coverImageUrl = $this->storeCoverImage($request);

        unset($data['cover_image'], $data['publish_now']);

        $article = Article::query()->create([
            ...$data,
            'user_id' => $request->user()->id,
            'cover_image_url' => $coverImageUrl,
            'published_at' => $this->resolvePublishedAt($request),
            'slug' => Str::slug($data['title']).'-'.Str::lower(Str::random(6)),
        ]);

        if ($article->published_at) {
            SendNewArticleNewsletterJob::dispatch($article->id);
        }

        return redirect()->route('publisher.articles.index')->with('status', 'Article created.');
    }

    public function edit(Article $article): View
    {
        return view('publisher.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'published_at' => ['nullable', 'date'],
            'publish_now' => ['nullable', 'boolean'],
        ]);

        $coverImageUrl = $this->storeCoverImage($request) ?: $article->cover_image_url;

        $wasPublished = $article->published_at !== null;

        unset($data['cover_image'], $data['publish_now']);

        $article->update([
            ...$data,
            'cover_image_url' => $coverImageUrl,
            'published_at' => $this->resolvePublishedAt($request),
        ]);

        $article->refresh();

        if ($article->published_at && ! $wasPublished) {
            SendNewArticleNewsletterJob::dispatch($article->id);
        }

        return redirect()->route('publisher.articles.index')->with('status', 'Article updated.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('publisher.articles.index')->with('status', 'Article deleted.');
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

        $path = $request->file('cover_image')->store('article-covers', 'public');

        return '/storage/'.$path;
    }
}
