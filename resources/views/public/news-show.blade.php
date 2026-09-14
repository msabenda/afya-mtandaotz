@extends('public.layout')

@section('title', $news->headline . ' - Afya Mtandaoni')

@section('content')
    <section class="hero hero-detail">
        <h1>{{ $news->headline }}</h1>
        <p>Latest health update for public awareness.</p>
    </section>

    <div class="reader-shell">
        <article class="reader-card">
            <img class="reader-cover" src="{{ $news->image_url ?: 'https://source.unsplash.com/featured/1200x700?health,news' }}" alt="{{ $news->headline }}">
            <div class="reader-content">
                <div class="meta">
                    <span class="pill">Health News</span>
                    <span class="pill">By {{ $news->authorDisplayName() }}</span>
                    <span class="pill">{{ $news->published_at?->format('F j, Y') }}</span>
                    <span class="pill">{{ $news->source_name ?: 'Afya Mtandaoni' }}</span>
                </div>

                <div class="rich">{!! $news->summary ?: '<p>Summary will be available soon.</p>' !!}</div>

                @if (!empty($news->source_url))
                    <p style="margin:16px 0 0;">
                        <a class="btn btn-primary" href="{{ $news->source_url }}" target="_blank" rel="noreferrer">View original source</a>
                    </p>
                @endif
            </div>
        </article>

        <div class="nav-row">
            @if ($previous)
                <a class="btn" href="{{ route('news.show', $previous->slug) }}">← Previous news</a>
            @else
                <a class="btn" href="{{ route('news.index') }}">← All news</a>
            @endif

            @if ($next)
                <a class="btn btn-primary" href="{{ route('news.show', $next->slug) }}">Next news →</a>
            @else
                <a class="btn btn-primary" href="{{ route('news.index') }}">More news →</a>
            @endif
        </div>
    </div>
@endsection

