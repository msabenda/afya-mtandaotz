@extends('public.layout')

@section('title', 'Articles - Afya Mtandaoni')

@section('content')
    <section class="hero">
        <h1>Latest Articles</h1>
        <p>Read full health education articles published by Afya Mtandaoni.</p>
    </section>

    <section class="post-grid">
        @forelse ($articles as $article)
            @php
                $articleHtml = (string) ($article->body ?? '');
                preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $articleHtml, $firstImageMatch);
                $previewImage = $firstImageMatch[1] ?? $article->cover_image_url ?? null;
                if (empty($previewImage) || \Illuminate\Support\Str::startsWith((string) $previewImage, 'data:image')) {
                    $previewImage = 'https://source.unsplash.com/featured/700x450?health,article';
                }
            @endphp
            <article class="post-card">
                <div class="post-media-wrap">
                    <img src="{{ $previewImage }}" alt="{{ $article->title }}">
                    <span class="post-chip">Article</span>
                </div>
                <div class="post-body">
                    <h3 class="post-title">{{ $article->title }}</h3>
                    <p class="post-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags((string) $article->excerpt), 130) }}</p>
                    <div class="post-meta">
                        <span>By {{ $article->authorDisplayName() }}</span>
                        <span>{{ $article->published_at?->format('M j, Y') ?: 'Draft' }}</span>
                    </div>
                    <a class="post-link" href="{{ route('articles.show', $article->slug) }}">Read full article</a>
                </div>
            </article>
        @empty
            <div class="card content">
                <p style="margin:0;color:#475569;">No published articles found.</p>
            </div>
        @endforelse
    </section>

    <div class="pagination">
        {{ $articles->links() }}
    </div>
@endsection

