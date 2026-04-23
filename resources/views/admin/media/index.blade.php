@extends('admin.layouts.app')

@section('title', 'Media Library')

@section('content')
<style>
.media-library-toolbar {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.media-library-toolbar .btn { font-size: 13px; }
.media-dropzone {
    border: 2px dashed #cbd5e1;
    background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 10px;
    padding: 44px 24px;
    text-align: center;
    margin-bottom: 24px;
    transition: all .2s ease;
}
.media-dropzone:hover, .media-dropzone.dragover {
    border-color: #3b82f6;
    background: linear-gradient(180deg, #eff6ff 0%, #dbeafe 100%);
    box-shadow: 0 0 0 3px rgba(59,130,246,.15);
}
.media-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 16px;
}
.media-grid.list-view { grid-template-columns: 1fr; }
.media-grid.list-view .media-item { display: grid; grid-template-columns: 72px 1fr; }
.media-grid.list-view .media-item .thumb-wrap { aspect-ratio: 1; max-height: 72px; }
.media-grid.list-view .media-item .info { display: flex; flex-direction: column; justify-content: center; }
.media-item {
    position: relative;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color .15s, box-shadow .15s;
    box-shadow: 0 1px 2px rgba(0,0,0,.04);
}
.media-item:hover {
    border-color: #94a3b8;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}
.media-item.selected {
    border: 2px solid #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,.2);
}
.media-item .thumb-wrap {
    aspect-ratio: 1;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-bottom: 1px solid #e2e8f0;
}
.media-item .thumb-wrap img { width: 100%; height: 100%; object-fit: cover; }
.media-item .thumb-wrap .file-icon { font-size: 2.5rem; color: #94a3b8; }
.media-item .info {
    padding: 10px 12px;
    font-size: 12px;
    color: #334155;
    background: #fff;
}
.media-item .info .name { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight: 500; }
.media-details-sidebar {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 20px;
    position: sticky;
    top: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}
.media-details-sidebar h6 { color: #1e293b; font-weight: 600; }
.media-details-sidebar .copy-row { display: flex; gap: 8px; align-items: flex-start; margin-bottom: 12px; }
.media-details-sidebar .copy-row input { flex: 1; font-size: 12px; border-radius: 6px; }
#detailsPreview { border: 1px solid #e2e8f0; border-radius: 8px; }
.media-toast {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: #1e293b;
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 13px;
    z-index: 9999;
    box-shadow: 0 4px 14px rgba(0,0,0,.2);
    display: none;
}
.media-toast.show { display: block; animation: mediaFadeIn 0.25s ease; }
@keyframes mediaFadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="d-flex flex-column flex-lg-row gap-3">
    <div class="flex-grow-1">
        <div class="media-library-toolbar">
            <div class="d-inline-block">
                <label class="btn btn-primary btn-sm mb-0" for="mediaUpload" id="uploadLabel">
                    <i class="bi bi-upload me-1"></i><span id="uploadBtnText">Upload</span>
                </label>
                <input type="file" id="mediaUpload" accept="image/*,.pdf,.doc,.docx" multiple class="d-none">
            </div>
            <form action="{{ route('admin.media.index') }}" method="get" class="d-flex gap-2 flex-grow-1" style="min-width: 200px;">
                <input type="search" name="q" class="form-control form-control-sm" placeholder="Search media..." value="{{ request('q') }}">
                <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="bi bi-search"></i></button>
            </form>
            <div class="btn-group btn-group-sm" role="group">
                <button type="button" class="btn btn-outline-secondary active" id="viewGrid" title="Grid view"><i class="bi bi-grid-3x3-gap"></i></button>
                <button type="button" class="btn btn-outline-secondary" id="viewList" title="List view"><i class="bi bi-list-ul"></i></button>
            </div>
        </div>

        <div class="media-dropzone" id="dropzone">
            <i class="bi bi-cloud-arrow-up display-4 text-muted d-block mb-2"></i>
            <p class="text-muted mb-0 small">Drop files here or use <strong>Upload</strong> to add media.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible py-2 mb-2">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible py-2 mb-2">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif

        <div class="media-grid" id="mediaGrid">
            @forelse($media as $m)
                @php
                    $mediaPath = trim((string)($m->path ?? ''));
                    $mediaUrl = $mediaPath !== '' ? asset('storage/'.$mediaPath) : '';
                    $mediaImgTag = $mediaUrl !== '' && $m->isImage() ? '<img src="'.e($mediaUrl).'" alt="'.e($m->alt ?? $m->name ?? $m->file_name).'" />' : '';
                @endphp
                <div class="media-item" data-id="{{ $m->id }}" data-url="{{ e($mediaUrl) }}" data-shortcode="{{ e($m->shortcode) }}" data-imgtag="{{ e($mediaImgTag) }}" data-name="{{ e($m->name ?? $m->file_name) }}" data-filename="{{ e($m->file_name) }}">
                    <div class="thumb-wrap">
                        @if($m->isImage() && $mediaUrl !== '')
                            <img src="{{ $mediaUrl }}" alt="{{ e($m->alt ?? $m->file_name) }}" loading="lazy">
                        @else
                            <i class="bi bi-file-earmark file-icon"></i>
                        @endif
                    </div>
                    <div class="info">
                        <div class="name">{{ $m->name ?? $m->file_name }}</div>
                        <div class="text-muted small">{{ number_format($m->size / 1024, 1) }} KB</div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted" style="grid-column: 1 / -1;">
                    <i class="bi bi-images display-4 d-block mb-2"></i>
                    <p class="mb-0">No media yet. Upload files above or drop them in the drop zone.</p>
                </div>
            @endforelse
        </div>

        @if($media->hasPages())
            <div class="d-flex justify-content-center mt-3">{{ $media->links() }}</div>
        @endif
    </div>

    <div class="media-details-sidebar" id="detailsSidebar" style="width: 320px; display: none;">
        <h6 class="mb-3">Attachment details</h6>
        <div id="detailsPreview" class="mb-3 text-center bg-light rounded py-3"></div>
        <div class="mb-2 small fw-semibold">URL</div>
        <div class="copy-row">
            <input type="text" id="detailUrl" class="form-control form-control-sm" readonly>
            <button type="button" class="btn btn-sm btn-outline-secondary copy-btn" data-target="detailUrl" title="Copy">Copy</button>
        </div>
        <div class="mb-2 small fw-semibold">Shortcode</div>
        <div class="copy-row">
            <input type="text" id="detailShortcode" class="form-control form-control-sm" readonly>
            <button type="button" class="btn btn-sm btn-outline-secondary copy-btn" data-target="detailShortcode" title="Copy">Copy</button>
        </div>
        <div class="mb-2 small fw-semibold">Image tag</div>
        <div class="copy-row">
            <input type="text" id="detailImgTag" class="form-control form-control-sm small" readonly>
            <button type="button" class="btn btn-sm btn-outline-secondary copy-btn" data-target="detailImgTag" title="Copy">Copy</button>
        </div>
        <hr>
        <form id="detailsForm" method="post" action="">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label class="form-label small fw-semibold">Title</label>
                <input type="text" name="name" id="detailName" class="form-control form-control-sm">
            </div>
            <div class="mb-2">
                <label class="form-label small fw-semibold">Alt text</label>
                <input type="text" name="alt" id="detailAlt" class="form-control form-control-sm">
            </div>
            <div class="mb-2">
                <label class="form-label small fw-semibold">Caption</label>
                <textarea name="caption" id="detailCaption" class="form-control form-control-sm" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
        <hr>
        <form id="detailsDeleteForm" method="post" action="" class="d-inline" onsubmit="return confirm('Permanently delete this file?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">Delete permanently</button>
        </form>
    </div>
</div>

<div class="media-toast" id="mediaToast">Copied to clipboard</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    var grid = document.getElementById('mediaGrid');
    var sidebar = document.getElementById('detailsSidebar');
    var toast = document.getElementById('mediaToast');
    var meta = document.querySelector('meta[name="csrf-token"]');
    var csrf = meta ? meta.getAttribute('content') : '';
    var baseUrl = '{{ url("admin/media") }}';

    function showToast(msg) {
        if (!toast) return;
        toast.textContent = msg || 'Copied to clipboard';
        toast.classList.add('show');
        setTimeout(function(){ toast.classList.remove('show'); }, 2000);
    }

    document.querySelectorAll('.copy-btn').forEach(function(btn){
        btn.addEventListener('click', function(){
            var id = this.getAttribute('data-target');
            var inp = document.getElementById(id);
            if (inp) { inp.select(); document.execCommand('copy'); showToast(); }
        });
    });

    if (grid && sidebar) {
        document.querySelectorAll('.media-item').forEach(function(item){
            item.addEventListener('click', function(e){
                if (e.target.closest('a') || e.target.closest('button')) return;
                document.querySelectorAll('.media-item').forEach(function(i){ i.classList.remove('selected'); });
                this.classList.add('selected');
                var id = this.getAttribute('data-id');
                sidebar.style.display = 'block';
                var form = document.getElementById('detailsForm');
                var delForm = document.getElementById('detailsDeleteForm');
                if (form) form.action = baseUrl + '/' + id;
                if (delForm) delForm.action = baseUrl + '/' + id;
                var u = document.getElementById('detailUrl'); if (u) u.value = this.getAttribute('data-url');
                var s = document.getElementById('detailShortcode'); if (s) s.value = this.getAttribute('data-shortcode');
                var i = document.getElementById('detailImgTag'); if (i) i.value = this.getAttribute('data-imgtag');
                var n = document.getElementById('detailName'); if (n) n.value = this.getAttribute('data-name') || '';
                var preview = document.getElementById('detailsPreview');
                if (preview) {
                    if (this.querySelector('img')) preview.innerHTML = '<img src="' + this.getAttribute('data-url') + '" class="img-fluid rounded" style="max-height:180px">';
                    else preview.innerHTML = '<i class="bi bi-file-earmark display-4 text-muted"></i>';
                }
                fetch(baseUrl + '/' + id, { headers: { 'Accept': 'application/json' } })
                    .then(function(r){ return r.json(); })
                    .then(function(d){
                        var a = document.getElementById('detailAlt'); if (a) a.value = d.alt || '';
                        var c = document.getElementById('detailCaption'); if (c) c.value = d.caption || '';
                    });
            });
        });
    }

    var vg = document.getElementById('viewGrid');
    var vl = document.getElementById('viewList');
    if (vg && vl && grid) {
        vg.addEventListener('click', function(){ grid.classList.remove('list-view'); this.classList.add('active'); vl.classList.remove('active'); });
        vl.addEventListener('click', function(){ grid.classList.add('list-view'); this.classList.add('active'); vg.classList.remove('active'); });
    }

    var dropzone = document.getElementById('dropzone');
    var uploadInput = document.getElementById('mediaUpload');
    var uploadLabel = document.getElementById('uploadLabel');
    var uploadBtnText = document.getElementById('uploadBtnText');

    function doUpload(files, callback) {
        if (!files.length) return;
        if (!csrf) { showToast('CSRF token missing'); return; }
        var fd = new FormData();
        fd.append('_token', csrf);
        if (files.length === 1) {
            fd.append('file', files[0]);
        } else {
            for (var i = 0; i < files.length; i++) fd.append('file[]', files[i]);
        }
        if (uploadLabel) uploadLabel.classList.add('disabled');
        if (uploadBtnText) uploadBtnText.textContent = 'Uploading…';
        fetch('{{ route("admin.media.store") }}', { method: 'POST', body: fd, headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(function(r){
                if (!r.ok) return r.json().then(function(d){ throw new Error(d.message || d.error || 'Upload failed'); });
                return r.json();
            })
            .then(function(){ showToast('Uploaded'); setTimeout(function(){ location.reload(); }, 800); })
            .catch(function(e){ if (uploadLabel) uploadLabel.classList.remove('disabled'); if (uploadBtnText) uploadBtnText.textContent = 'Upload'; showToast(e.message || 'Upload failed'); });
    }

    if (dropzone) {
        dropzone.addEventListener('dragover', function(e){ e.preventDefault(); this.classList.add('dragover'); });
        dropzone.addEventListener('dragleave', function(){ this.classList.remove('dragover'); });
        dropzone.addEventListener('drop', function(e){
            e.preventDefault();
            this.classList.remove('dragover');
            var files = e.dataTransfer.files;
            if (files.length) doUpload(Array.from(files));
        });
    }

    if (uploadInput) {
        uploadInput.addEventListener('change', function(e){
            e.preventDefault();
            if (this.files.length) doUpload(Array.from(this.files));
            this.value = '';
        });
    }

    var detailsForm = document.getElementById('detailsForm');
    if (detailsForm) {
        detailsForm.addEventListener('submit', function(e){
            e.preventDefault();
            var form = this;
            var fd = new FormData(form);
            fetch(form.action, { method: 'POST', body: fd, headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(function(){ showToast('Updated'); location.reload(); })
                .catch(function(){ showToast('Update failed'); });
        });
    }
});
</script>
@endpush
@endsection
