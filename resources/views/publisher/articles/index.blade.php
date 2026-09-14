@extends('publisher.layout')

@section('title', 'Manage Articles')

@section('content')
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
            <h2>Articles</h2>
            <a class="btn" href="{{ route('publisher.articles.create') }}">New Article</a>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Cover</th>
                    <th>Status</th>
                    <th>Published At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->author?->name ?? '—' }}</td>
                        <td>
                            <img class="article-thumb" src="{{ $article->cover_image_url ?: 'https://source.unsplash.com/featured/200x140?health,article' }}" alt="{{ $article->title }}">
                        </td>
                        <td>{{ $article->published_at ? 'Published' : 'Draft' }}</td>
                        <td>{{ $article->published_at?->format('M j, Y H:i') ?? '-' }}</td>
                        <td style="display:flex;gap:8px;">
                            <a class="btn btn-outline" href="{{ route('publisher.articles.edit', $article) }}">Edit</a>
                            <form method="post" action="{{ route('publisher.articles.destroy', $article) }}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No articles yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:10px;">{{ $articles->links() }}</div>
    </div>
@endsection

