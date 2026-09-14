@extends('public.layout')

@section('title', $article->title . ' - Afya Mtandaoni')

@section('content')
    @php
        $wordCount = str_word_count(strip_tags((string) $article->body));
        $readTime = max((int) ceil($wordCount / 220), 1);
        $articleHtml = (string) ($article->body ?? '');
        preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $articleHtml, $firstImageMatch);
        $heroImage = $firstImageMatch[1] ?? $article->cover_image_url ?? null;
        if (empty($heroImage) || \Illuminate\Support\Str::startsWith((string) $heroImage, 'data:image')) {
            $heroImage = 'https://source.unsplash.com/featured/1200x700?health,article';
        }
    @endphp

    <section class="hero hero-detail">
        <h1>{{ $article->title }}</h1>
        <p>Trusted public health article for everyday awareness.</p>
    </section>

    <div class="reader-shell">
        <article class="reader-card">
            <img class="reader-cover" src="{{ $heroImage }}" alt="{{ $article->title }}">
            <div class="reader-content">
                <div class="meta">
                    <span class="pill">Article</span>
                    <span class="pill">By {{ $article->authorDisplayName() }}</span>
                    <span class="pill">{{ $article->published_at?->format('F j, Y') }}</span>
                    <span class="pill">{{ $readTime }} min read</span>
                </div>

                @if (!empty($article->excerpt))
                    <p class="lead-text">{{ strip_tags((string) $article->excerpt) }}</p>
                @endif

                <div class="rich">{!! $article->body ?: '<p>Content will be available soon.</p>' !!}</div>
            </div>
        </article>

        <div class="nav-row">
            @if ($previous)
                <a class="btn" href="{{ route('articles.show', $previous->slug) }}">← Previous article</a>
            @else
                <a class="btn" href="{{ route('articles.index') }}">← All articles</a>
            @endif

            @if ($next)
                <a class="btn btn-primary" href="{{ route('articles.show', $next->slug) }}">Next article →</a>
            @else
                <a class="btn btn-primary" href="{{ route('articles.index') }}">More articles →</a>
            @endif
        </div>
    </div>
@endsection

