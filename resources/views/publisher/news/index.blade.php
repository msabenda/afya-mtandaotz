@extends('publisher.layout')

@section('title', 'Manage Health News')

@section('content')
    <div class="card">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
            <h2>Health News</h2>
            <a class="btn" href="{{ route('publisher.news.create') }}">New Health News</a>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Headline</th>
                    <th>Author</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Published At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($newsItems as $item)
                    <tr>
                        <td>{{ $item->headline }}</td>
                        <td>{{ $item->author?->name ?? '—' }}</td>
                        <td>
                            <img class="news-thumb" src="{{ $item->image_url ?: 'https://source.unsplash.com/featured/200x140?health,news' }}" alt="{{ $item->headline }}">
                        </td>
                        <td>{{ $item->published_at ? 'Published' : 'Draft' }}</td>
                        <td>{{ $item->published_at?->format('M j, Y H:i') ?? '-' }}</td>
                        <td style="display:flex;gap:8px;">
                            <a class="btn btn-outline" href="{{ route('publisher.news.edit', $item) }}">Edit</a>
                            <form method="post" action="{{ route('publisher.news.destroy', $item) }}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No health news yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:10px;">{{ $newsItems->links() }}</div>
    </div>
@endsection

