@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title m-0">Edit Category</h3>
    </div>
    <form action="{{ route('admin.categories.update', $category) }}" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input name="name" id="category_name" class="form-control" required value="{{ old('name', $category->name) }}" placeholder="Enter category name" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Slug</label>
                    <input name="slug" id="category_slug" class="form-control" required value="{{ old('slug', $category->slug) }}" placeholder="category-slug" />
                    <div id="slug_error" class="text-danger small mt-1 fw-semibold" style="display: none;"></div>
                    <div id="slug_success" class="text-success small mt-1 fw-semibold" style="display: none;"></div>
                </div>
                <div class="col-12">
                    <label class="form-label">Parent</label>
                    <select name="parent_id" class="form-select">
                        <option value="">None</option>
                        @foreach($parents as $id => $name)
                            <option value="{{ $id }}" @selected($category->parent_id == $id)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control" placeholder="Enter category description (optional)">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="col-md-3">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active_cat" value="1" @checked($category->is_active) />
                        <label class="form-check-label" for="is_active_cat"> Active </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" id="submit_btn">Save</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from name
    const nameInput = document.getElementById('category_name');
    const slugInput = document.getElementById('category_slug');
    const slugError = document.getElementById('slug_error');
    const slugSuccess = document.getElementById('slug_success');
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submit_btn');
    let slugCheckTimeout;
    let slugDuplicate = false;
    window.slugDuplicate = false;
    const categoryId = {{ $category->id }};
    
    // Ensure submit button exists
    if (!submitBtn) {
        console.error('Submit button not found');
    }
    
    // Function to generate slug from text
    function generateSlug(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }
    
    // Auto-generate slug when name changes
    let isManualSlugEdit = false;
    nameInput.addEventListener('input', function() {
        if (!isManualSlugEdit) {
            const slug = generateSlug(this.value);
            slugInput.value = slug;
            if (slug) {
                checkSlugAvailability(slug);
            }
        }
    });
    
    // Track manual slug edits
    slugInput.addEventListener('input', function() {
        isManualSlugEdit = true;
        const slug = this.value.trim();
        if (slug) {
            checkSlugAvailability(slug);
        } else {
            hideSlugMessages();
        }
    });
    
    // Check slug availability
    function checkSlugAvailability(slug) {
        if (!slug || slug.trim() === '') {
            hideSlugMessages();
            return;
        }
        
        clearTimeout(slugCheckTimeout);
        slugCheckTimeout = setTimeout(function() {
            // Show loading state
            slugError.style.display = 'none';
            slugSuccess.style.display = 'none';
            
            fetch('{{ route("admin.categories.check-slug") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    slug: slug.trim(),
                    category_id: categoryId
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Slug check response:', data);
                if (data.available) {
                    slugError.style.display = 'none';
                    slugSuccess.style.display = 'block';
                    slugSuccess.textContent = data.message || 'Slug is available';
                    slugInput.classList.remove('is-invalid');
                    slugInput.classList.add('is-valid');
                    slugDuplicate = false;
                    window.slugDuplicate = false;
                    // Enable submit button
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('disabled');
                    }
                } else {
                    slugSuccess.style.display = 'none';
                    slugError.style.display = 'block';
                    slugError.textContent = data.message || 'This slug is already taken';
                    slugInput.classList.remove('is-valid');
                    slugInput.classList.add('is-invalid');
                    slugDuplicate = true;
                    window.slugDuplicate = true;
                    // Disable submit button
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.classList.add('disabled');
                    }
                }
            })
            .catch(error => {
                console.error('Error checking slug:', error);
                slugError.style.display = 'block';
                slugError.textContent = 'Error checking slug availability. Please try again.';
                slugInput.classList.add('is-invalid');
                // Disable submit button on error
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('disabled');
                }
            });
        }, 500);
    }
    
    function hideSlugMessages() {
        slugError.style.display = 'none';
        slugSuccess.style.display = 'none';
        slugInput.classList.remove('is-invalid', 'is-valid');
        // Enable submit button when slug is cleared
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('disabled');
        }
    }
    
    // Prevent form submission if slug is duplicate
    form.addEventListener('submit', function(e) {
        if (window.slugDuplicate) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Slug Error',
                text: 'Please fix the slug error before submitting.',
                confirmButtonColor: '#667eea'
            });
            return false;
        }
    });
    
    // Check initial slug on page load
    @if(old('slug', $category->slug))
        checkSlugAvailability('{{ old("slug", $category->slug) }}');
    @endif
});
</script>
@endpush
@endsection


