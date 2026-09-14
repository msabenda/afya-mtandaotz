@extends('publisher.layout')

@section('title', 'Edit Health News')

@section('content')
    <div class="card">
        <h2>Edit Health News</h2>
        <form method="post" action="{{ route('publisher.news.update', $newsItem) }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="field">
                <label>Headline</label>
                <input name="headline" value="{{ old('headline', $newsItem->headline) }}" required>
            </div>

            <div class="field">
                <label>Summary</label>
                <input type="hidden" id="summary_input" name="summary" value="{{ old('summary', $newsItem->summary) }}">
                <div id="summary_editor" style="background:#fff;border:1px solid #cbd5e1;border-radius:8px;min-height:220px;"></div>
            </div>

            <div class="field">
                <label>Cover Image</label>
                <input type="file" name="cover_image" accept="image/*">
                @if (!empty($newsItem->image_url))
                    <img src="{{ $newsItem->image_url }}" alt="{{ $newsItem->headline }}" style="margin-top:8px;max-width:220px;border-radius:8px;border:1px solid #dbe4ee;">
                @endif
            </div>

            <div class="field">
                <label>Source Name</label>
                <input name="source_name" value="{{ old('source_name', $newsItem->source_name) }}">
            </div>

            <div class="field">
                <label>Source URL</label>
                <input name="source_url" value="{{ old('source_url', $newsItem->source_url) }}">
            </div>

            <div class="field">
                <label>Publish At (optional)</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', $newsItem->published_at?->format('Y-m-d\TH:i')) }}">
                <label style="display:flex;align-items:center;gap:8px;margin-top:8px;">
                    <input type="checkbox" name="publish_now" value="1" {{ old('publish_now', $newsItem->published_at ? '1' : '0') ? 'checked' : '' }}>
                    Publish now (show to public immediately)
                </label>
            </div>

            <button class="btn" type="submit">Update Health News</button>
        </form>
    </div>
@endsection

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script>
        const summaryEditor = new Quill('#summary_editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [2, 3, false] }],
                    ['bold', 'italic', 'underline'],
                    [{ list: 'ordered'}, { list: 'bullet' }],
                    ['blockquote', 'link', 'image'],
                    ['clean']
                ]
            }
        });
        const summaryInput = document.getElementById('summary_input');
        summaryEditor.root.innerHTML = summaryInput.value || '';
        const toolbar = summaryEditor.getModule('toolbar');
        toolbar.addHandler('image', () => selectAndUploadImage(summaryEditor));

        function selectAndUploadImage(editor) {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.click();

            input.addEventListener('change', async () => {
                if (!input.files || !input.files[0]) return;
                const formData = new FormData();
                formData.append('image', input.files[0]);

                try {
                    const response = await fetch('{{ route('publisher.editor.upload-image') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });
                    if (!response.ok) throw new Error('Upload failed');
                    const data = await response.json();
                    const range = editor.getSelection(true);
                    editor.insertEmbed(range ? range.index : editor.getLength(), 'image', data.url);
                } catch (e) {
                    alert('Image upload failed. Please try again.');
                }
            });
        }

        summaryInput.closest('form').addEventListener('submit', () => {
            summaryInput.value = summaryEditor.root.innerHTML;
        });
    </script>
@endpush

