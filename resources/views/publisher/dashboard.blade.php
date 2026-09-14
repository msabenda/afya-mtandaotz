@extends('publisher.layout')

@section('title', 'Publisher Dashboard')

@section('content')
    <div class="dash-grid dash-grid--stats" style="margin-bottom: 4px;">
        <div class="dash-stat-tile dash-stat-tile--articles">
            <h3>Total Articles</h3>
            <div class="dash-stat-num">{{ $articlesCount }}</div>
            <div class="dash-stat-meta">All created articles in the system.</div>
        </div>
        <div class="dash-stat-tile dash-stat-tile--blue">
            <h3>Published Articles</h3>
            <div class="dash-stat-num">{{ $publishedArticles }}</div>
            <div class="dash-stat-meta">Drafts left: <strong>{{ $draftArticles }}</strong></div>
        </div>
        <div class="dash-stat-tile dash-stat-tile--orange">
            <h3>Total Health News</h3>
            <div class="dash-stat-num">{{ $newsCount }}</div>
            <div class="dash-stat-meta">All health news posts available.</div>
        </div>
        <div class="dash-stat-tile dash-stat-tile--violet">
            <h3>Published Health News</h3>
            <div class="dash-stat-num">{{ $publishedNews }}</div>
            <div class="dash-stat-meta">Drafts left: <strong>{{ $draftNews }}</strong></div>
        </div>
    </div>

    <div class="dash-grid">
        <div class="dash-card">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;">
                <h3 style="margin:0;">Recent Articles</h3>
                <a class="dash-btn dash-btn-outline" href="{{ route('publisher.articles.index') }}">Manage</a>
            </div>
            <div style="margin-top:12px;display:grid;gap:10px;">
                @forelse($latestArticles as $article)
                    <div class="dash-list-row">
                        <img class="article-thumb" src="{{ $article->cover_image_url ?: 'https://source.unsplash.com/featured/200x140?health,article' }}" alt="{{ $article->title }}">
                        <div>
                            <strong>{{ $article->title }}</strong>
                            <div class="dash-muted">{{ $article->author?->name ? 'By '.$article->author->name.' · ' : '' }}{{ $article->published_at ? 'Published '.$article->published_at->format('M j, Y') : 'Draft' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="dash-muted">No recent articles.</div>
                @endforelse
            </div>
        </div>

        <div class="dash-card">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;">
                <h3 style="margin:0;">Recent Health News</h3>
                <a class="dash-btn dash-btn-outline" href="{{ route('publisher.news.index') }}">Manage</a>
            </div>
            <div style="margin-top:12px;display:grid;gap:10px;">
                @forelse($latestNews as $news)
                    <div class="dash-list-row">
                        <img class="news-thumb" src="{{ $news->image_url ?: 'https://source.unsplash.com/featured/200x140?health,news' }}" alt="{{ $news->headline }}">
                        <div>
                            <strong>{{ $news->headline }}</strong>
                            <div class="dash-muted">{{ $news->author?->name ? 'By '.$news->author->name.' · ' : '' }}{{ $news->published_at ? 'Published '.$news->published_at->format('M j, Y') : 'Draft' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="dash-muted">No recent health news.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
