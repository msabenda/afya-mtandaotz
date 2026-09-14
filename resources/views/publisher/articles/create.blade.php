@extends('publisher.layout')

@section('title', 'Create Article')

@section('content')
    <div class="card">
        <h2>Create Article</h2>
        <form method="post" action="{{ route('publisher.articles.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label>Title</label>
                <input name="title" value="{{ old('title') }}" required>
                @error('title') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="field">
                <label>Excerpt</label>
                <input type="hidden" id="excerpt_input" name="excerpt" value="{{ old('excerpt') }}">
                <div id="excerpt_editor" style="background:#fff;border:1px solid #cbd5e1;border-radius:8px;min-height:140px;"></div>
            </div>

            <div class="field">
                <label>Body</label>
                <input type="hidden" id="body_input" name="body" value="{{ old('body') }}">
                <div id="body_editor" style="background:#fff;border:1px solid #cbd5e1;border-radius:8px;min-height:260px;"></div>
                <small style="color:#64748b;">Use the image tool inside editor to place multiple images anywhere in your article.</small>
            </div>

            <div class="field">
                <label>Cover Image</label>
                <input type="file" name="cover_image" accept="image/*">
            </div>

            <div class="field">
                <label>Publish At (optional)</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at') }}">
                <label style="display:flex;align-items:center;gap:8px;margin-top:8px;">
                    <input type="checkbox" name="publish_now" value="1" {{ old('publish_now', '1') ? 'checked' : '' }}>
                    Publish now (show to public immediately)
                </label>
            </div>

            <button class="btn" type="submit">Save Article</button>
        </form>
    </div>
@endsection

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script>
        const quillOptions = {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered'}, { list: 'bullet' }],
                    ['blockquote', 'link', 'image'],
                    [{ align: [] }],
                    ['clean']
                ]
            }
        };

        const excerptEditor = new Quill('#excerpt_editor', quillOptions);
        const bodyEditor = new Quill('#body_editor', quillOptions);
        const excerptInput = document.getElementById('excerpt_input');
        const bodyInput = document.getElementById('body_input');

        excerptEditor.root.innerHTML = excerptInput.value || '';
        bodyEditor.root.innerHTML = bodyInput.value || '';

        const form = excerptInput.closest('form');
        const toolbar = bodyEditor.getModule('toolbar');
        toolbar.addHandler('image', () => selectAndUploadImage(bodyEditor));

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

        form.addEventListener('submit', () => {
            excerptInput.value = excerptEditor.root.innerHTML;
            bodyInput.value = bodyEditor.root.innerHTML;
        });
    </script>
@endpush

