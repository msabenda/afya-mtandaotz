@extends('public.layout')

@section('title', 'Health News - Afya Mtandaoni')

@section('content')
    <section class="hero">
        <h1>Health News</h1>
        <p>Read full trusted health updates and announcements.</p>
    </section>

    <section class="post-grid">
        @forelse ($newsItems as $news)
            <article class="post-card">
                <div class="post-media-wrap">
                    <img src="{{ $news->image_url ?: 'https://source.unsplash.com/featured/700x450?health,news' }}" alt="{{ $news->headline }}">
                    <span class="post-chip">News</span>
                </div>
                <div class="post-body">
                    <h3 class="post-title">{{ $news->headline }}</h3>
                    <p class="post-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags((string) $news->summary), 130) }}</p>
                    <div class="post-meta">
                        <span>By {{ $news->authorDisplayName() }}</span>
                        <span>{{ $news->published_at?->format('M j, Y') ?: 'Draft' }}</span>
                        <span>{{ $news->source_name ?: 'Afya Mtandaoni' }}</span>
                    </div>
                    <a class="post-link" href="{{ route('news.show', $news->slug) }}">Read full news</a>
                </div>
            </article>
        @empty
            <div class="card content">
                <p style="margin:0;color:#475569;">No published health news found.</p>
            </div>
        @endforelse
    </section>

    <div class="pagination">
        {{ $newsItems->links() }}
    </div>
@endsection

