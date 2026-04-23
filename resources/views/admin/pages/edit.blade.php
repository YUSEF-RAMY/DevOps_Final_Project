@extends('admin.layouts.app')

@section('title', 'Edit Page')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title m-0">Edit Page</h3>
    </div>
    <form action="{{ route('admin.pages.update', $page) }}" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input name="title" class="form-control @error('title') is-invalid @enderror" required value="{{ old('title', $page->title) }}" placeholder="Enter page title" />
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', $page->slug) }}" placeholder="page-slug" />
                    <small class="text-muted">Leave empty to auto-generate from title</small>
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Content</label>
                    <textarea name="content" id="page_content" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Page content">{{ old('content', $page->content) }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Meta Title</label>
                    <input name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $page->meta_title) }}" placeholder="SEO meta title (optional)" />
                    @error('meta_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Meta Keywords</label>
                    <input name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{ old('meta_keywords', $page->meta_keywords) }}" placeholder="keyword1, keyword2, keyword3" />
                    @error('meta_keywords')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $page->sort_order) }}" min="0" placeholder="0" />
                    @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" placeholder="SEO meta description (optional)">{{ old('meta_description', $page->meta_description) }}</textarea>
                    @error('meta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active_page" value="1" @checked($page->is_active) />
                        <label class="form-check-label" for="is_active_page"> Active </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@push('styles')
<!-- Quill Editor CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    #editor {
        height: 400px;
        background: #fff;
    }
    .ql-editor {
        min-height: 400px;
        font-size: 14px;
    }
</style>
@endpush

@push('scripts')
<!-- Quill Editor JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create editor container
    const textarea = document.getElementById('page_content');
    const editorDiv = document.createElement('div');
    editorDiv.id = 'editor';
    textarea.parentNode.insertBefore(editorDiv, textarea);
    textarea.style.display = 'none';
    
    // Initialize Quill
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['link'],
                ['blockquote', 'code-block'],
                ['clean']
            ]
        },
        placeholder: 'Start writing your page content...'
    });
    
    // Set initial content
    @if(old('content', $page->content))
        quill.root.innerHTML = @json(old('content', $page->content));
    @endif
    
    // Update textarea before form submit
    const form = textarea.closest('form');
    form.addEventListener('submit', function() {
        textarea.value = quill.root.innerHTML;
    });
});
</script>
@endpush
@endsection

