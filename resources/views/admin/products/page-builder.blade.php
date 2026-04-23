@extends('admin.layouts.app')

@section('title', 'Page Builder - ' . $product->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="card-title mb-0 fw-semibold">
                                <i class="bi bi-layout-text-window me-2"></i>Page Builder
                            </h3>
                            <small class="text-muted">{{ $product->name }}</small>
                        </div>
                        <div>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Back to Product
                            </a>
                            <button type="button" id="savePageBuilder" class="btn btn-sm btn-primary">
                                <i class="bi bi-save me-1"></i>Save
                            </button>
                            <a href="{{ route('products.custom', $product->slug) }}" target="_blank" class="btn btn-sm btn-success">
                                <i class="bi bi-eye me-1"></i>Preview Custom Page
                            </a>
                            <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-box-arrow-up-right me-1"></i>View Default Page
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0" style="height: calc(100vh - 150px);">
                        <!-- Left Sidebar - Blocks -->
                        <div class="col-md-3 border-end bg-light" style="overflow-y: auto; max-height: 100%;">
                            <div class="p-3">
                                <h6 class="fw-semibold mb-3">Blocks</h6>
                                <div class="d-grid gap-2">
                                    <h6 class="small fw-semibold text-muted mt-2 mb-1">Basic Blocks</h6>
                                    <button type="button" class="btn btn-outline-primary btn-sm add-block" data-type="text">
                                        <i class="bi bi-type me-1"></i>Text
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm add-block" data-type="heading">
                                        <i class="bi bi-type-h1 me-1"></i>Heading
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm add-block" data-type="image">
                                        <i class="bi bi-image me-1"></i>Image
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm add-block" data-type="button">
                                        <i class="bi bi-cursor me-1"></i>Button
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm add-block" data-type="spacer">
                                        <i class="bi bi-arrows-vertical me-1"></i>Spacer
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm add-block" data-type="divider">
                                        <i class="bi bi-hr me-1"></i>Divider
                                    </button>
                                    
                                    <h6 class="small fw-semibold text-muted mt-3 mb-1">Product Blocks</h6>
                                    <button type="button" class="btn btn-outline-success btn-sm add-block" data-type="product-info">
                                        <i class="bi bi-info-circle me-1"></i>Product Info
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm add-block" data-type="product-gallery">
                                        <i class="bi bi-images me-1"></i>Product Gallery
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm add-block" data-type="buy-button">
                                        <i class="bi bi-cart-plus me-1"></i>Buy Button
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm add-block" data-type="product-reviews">
                                        <i class="bi bi-star me-1"></i>Product Reviews
                                    </button>
                                    
                                    <h6 class="small fw-semibold text-muted mt-3 mb-1">Layout Blocks</h6>
                                    <button type="button" class="btn btn-outline-info btn-sm add-block" data-type="hero">
                                        <i class="bi bi-image-fill me-1"></i>Hero Section
                                    </button>
                                    <button type="button" class="btn btn-outline-info btn-sm add-block" data-type="two-column">
                                        <i class="bi bi-columns me-1"></i>Two Columns
                                    </button>
                                    <button type="button" class="btn btn-outline-info btn-sm add-block" data-type="three-column">
                                        <i class="bi bi-layout-three-columns me-1"></i>Three Columns
                                    </button>
                                    <button type="button" class="btn btn-outline-info btn-sm add-block" data-type="tabs">
                                        <i class="bi bi-folder2-open me-1"></i>Tabs
                                    </button>
                                    
                                    <h6 class="small fw-semibold text-muted mt-3 mb-1">Media Blocks</h6>
                                    <button type="button" class="btn btn-outline-warning btn-sm add-block" data-type="video">
                                        <i class="bi bi-play-circle me-1"></i>Video Embed
                                    </button>
                                    <button type="button" class="btn btn-outline-warning btn-sm add-block" data-type="image-gallery">
                                        <i class="bi bi-grid-3x3-gap me-1"></i>Image Gallery
                                    </button>
                                    
                                    <h6 class="small fw-semibold text-muted mt-3 mb-1">Content Blocks</h6>
                                    <button type="button" class="btn btn-outline-secondary btn-sm add-block" data-type="icon-box">
                                        <i class="bi bi-box me-1"></i>Icon Box
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm add-block" data-type="features-list">
                                        <i class="bi bi-list-check me-1"></i>Features List
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm add-block" data-type="faq">
                                        <i class="bi bi-question-circle me-1"></i>FAQ Accordion
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm add-block" data-type="testimonials">
                                        <i class="bi bi-chat-quote me-1"></i>Testimonials
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm add-block" data-type="stats">
                                        <i class="bi bi-graph-up me-1"></i>Stats Counter
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm add-block" data-type="progress-bar">
                                        <i class="bi bi-bar-chart me-1"></i>Progress Bar
                                    </button>
                                    
                                    <h6 class="small fw-semibold text-muted mt-3 mb-1">Social & Sharing</h6>
                                    <button type="button" class="btn btn-outline-danger btn-sm add-block" data-type="social-share">
                                        <i class="bi bi-share me-1"></i>Social Share
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Center - Canvas -->
                        <div class="col-md-6" style="overflow-y: auto; max-height: 100%; background: #f8f9fa;">
                            <div class="p-4">
                                <div id="pageBuilderCanvas" class="bg-white shadow-sm" style="min-height: 800px; padding: 2rem;">
                                    @if($product->page_builder_data && count($product->page_builder_data) > 0)
                                        @foreach($product->page_builder_data as $index => $block)
                                            <!-- Blocks will be rendered by JavaScript -->
                                        @endforeach
                                    @else
                                        <div class="text-center text-muted py-5">
                                            <i class="bi bi-layout-text-window fs-1 d-block mb-3"></i>
                                            <p>Start building your page by adding blocks from the left sidebar</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Sidebar - Settings -->
                        <div class="col-md-3 border-start bg-light" style="overflow-y: auto; max-height: 100%;">
                            <div class="p-3">
                                <h6 class="fw-semibold mb-3">Settings</h6>
                                <div id="blockSettings">
                                    <p class="text-muted small">Select a block to edit its settings</p>
                                </div>
                                <hr>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="useCustomPage" {{ $product->use_custom_page ? 'checked' : '' }}>
                                    <label class="form-check-label" for="useCustomPage">
                                        Use Custom Page
                                    </label>
                                    <small class="text-muted d-block">Enable to show this custom page instead of default product page</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.block-item {
    position: relative;
    padding: 1rem;
    margin-bottom: 1rem;
    border: 2px dashed transparent;
    cursor: move;
    transition: all 0.2s;
}
.block-item:hover {
    border-color: #0d6efd;
    background-color: #f8f9fa;
}
.block-item.selected {
    border-color: #0d6efd;
    background-color: #e7f1ff;
}
.block-item .block-actions {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    opacity: 0;
    transition: opacity 0.2s;
}
.block-item:hover .block-actions {
    opacity: 1;
}
.block-item .block-actions button {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}
.sortable-ghost {
    opacity: 0.4;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let selectedBlockIndex = null;
    const canvas = document.getElementById('pageBuilderCanvas');
    let blocks = @json($product->page_builder_data ?? []);

    // Initialize Sortable
    const sortable = Sortable.create(canvas, {
        animation: 150,
        handle: '.block-item',
        ghostClass: 'sortable-ghost',
        onEnd: function(evt) {
            // Update block order
            const item = blocks.splice(evt.oldIndex, 1)[0];
            blocks.splice(evt.newIndex, 0, item);
            updateCanvas();
        }
    });

    // Add block
    document.querySelectorAll('.add-block').forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.dataset.type;
            addBlock(type);
        });
    });

    function addBlock(type) {
        const block = {
            id: Date.now(),
            type: type,
            content: getDefaultContent(type),
            styles: getDefaultStyles(type)
        };
        blocks.push(block);
        updateCanvas();
        selectBlock(blocks.length - 1);
    }

    function getDefaultContent(type) {
        const defaults = {
            text: 'Enter your text here...',
            heading: 'Heading Text',
            image: { url: '', alt: '' },
            button: { text: 'Click Me', url: '#', style: 'primary' },
            'product-info': {},
            'product-gallery': {},
            'product-reviews': {},
            'buy-button': {},
            spacer: { height: '50px' },
            divider: { style: 'solid', color: '#dee2e6' },
            hero: { 
                title: 'Hero Title', 
                subtitle: 'Hero Subtitle', 
                backgroundImage: '', 
                buttonText: 'Get Started', 
                buttonUrl: '#',
                overlay: true,
                overlayOpacity: '0.5'
            },
            'two-column': { 
                left: { blocks: [] },
                right: { blocks: [] }
            },
            'three-column': { 
                col1: { blocks: [] },
                col2: { blocks: [] },
                col3: { blocks: [] }
            },
            tabs: { 
                tabs: [
                    { title: 'Tab 1', content: 'Tab 1 content' },
                    { title: 'Tab 2', content: 'Tab 2 content' }
                ]
            },
            video: { url: '', platform: 'youtube', autoplay: false },
            'image-gallery': { images: [] },
            'icon-box': { 
                icon: 'bi-star', 
                title: 'Feature Title', 
                text: 'Feature description',
                iconColor: '#0d6efd'
            },
            'features-list': { 
                features: [
                    { icon: 'bi-check-circle', text: 'Feature 1' },
                    { icon: 'bi-check-circle', text: 'Feature 2' }
                ]
            },
            faq: { 
                items: [
                    { question: 'Question 1?', answer: 'Answer 1' },
                    { question: 'Question 2?', answer: 'Answer 2' }
                ]
            },
            testimonials: { 
                testimonials: [
                    { name: 'John Doe', text: 'Great product!', rating: 5 },
                    { name: 'Jane Smith', text: 'Highly recommended!', rating: 5 }
                ]
            },
            stats: { 
                stats: [
                    { label: 'Customers', value: '1000+', icon: 'bi-people' },
                    { label: 'Products', value: '500+', icon: 'bi-box' }
                ]
            },
            'progress-bar': { 
                label: 'Progress', 
                value: 75, 
                showPercentage: true,
                color: 'primary'
            },
            'social-share': { 
                platforms: ['facebook', 'twitter', 'whatsapp', 'linkedin'],
                showLabels: true
            }
        };
        return defaults[type] || {};
    }

    function getDefaultStyles(type) {
        return {
            padding: { top: '1rem', bottom: '1rem', left: '0', right: '0' },
            margin: { top: '0', bottom: '0', left: '0', right: '0' },
            backgroundColor: '',
            textAlign: 'left',
            fontSize: type === 'heading' ? '2rem' : '1rem',
            color: '#333'
        };
    }

    function updateCanvas() {
        canvas.innerHTML = '';
        if (blocks.length === 0) {
            canvas.innerHTML = `
                <div class="text-center text-muted py-5">
                    <i class="bi bi-layout-text-window fs-1 d-block mb-3"></i>
                    <p>Start building your page by adding blocks from the left sidebar</p>
                </div>
            `;
            return;
        }
        blocks.forEach((block, index) => {
            const blockElement = createBlockElement(block, index);
            canvas.appendChild(blockElement);
        });
    }

    function createBlockElement(block, index) {
        const div = document.createElement('div');
        div.className = 'block-item' + (selectedBlockIndex === index ? ' selected' : '');
        div.dataset.index = index;
        
        let html = '<div class="block-actions">';
        html += '<button type="button" class="btn btn-sm btn-danger delete-block" title="Delete"><i class="bi bi-trash"></i></button>';
        html += '</div>';
        html += renderBlock(block);
        
        div.innerHTML = html;
        
        div.addEventListener('click', function(e) {
            if (!e.target.closest('.block-actions')) {
                selectBlock(index);
            }
        });
        
        div.querySelector('.delete-block')?.addEventListener('click', function(e) {
            e.stopPropagation();
            Swal.fire({
                icon: 'warning',
                title: 'Delete Block?',
                text: 'Are you sure you want to delete this block?',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Delete It',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (!result.isConfirmed) {
                    return;
                }
                blocks.splice(index, 1);
                selectedBlockIndex = null;
                updateCanvas();
                updateSettings();
            });
        });
        
        return div;
    }

    function renderBlock(block) {
        const style = block.styles || {};
        const content = block.content || {};
        let html = '';
        
        switch(block.type) {
            case 'text':
                html = `<div style="font-size: ${style.fontSize || '1rem'}; color: ${style.color || '#333'}; text-align: ${style.textAlign || 'left'}; padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'}; background-color: ${style.backgroundColor || 'transparent'};">${content.text || 'Enter text...'}</div>`;
                break;
            case 'heading':
                const headingSize = style.fontSize || '2rem';
                html = `<h2 style="font-size: ${headingSize}; color: ${style.color || '#333'}; text-align: ${style.textAlign || 'left'}; padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'}; background-color: ${style.backgroundColor || 'transparent'};">${content.text || 'Heading'}</h2>`;
                break;
            case 'image':
                html = `<div style="text-align: ${style.textAlign || 'center'}; padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};"><img src="${content.url || ''}" alt="${content.alt || ''}" style="max-width: 100%; height: auto; ${content.width ? 'width: ' + content.width + ';' : ''}" /></div>`;
                break;
            case 'button':
                html = `<div style="text-align: ${style.textAlign || 'center'}; padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};"><a href="${content.url || '#'}" class="btn btn-${content.style || 'primary'}">${content.text || 'Button'}</a></div>`;
                break;
            case 'product-info':
                html = `<div class="product-info-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'}; background-color: ${style.backgroundColor || 'transparent'};">
                    <h3>{{ $product->name }}</h3>
                    <p class="text-muted">{{ $product->short_description }}</p>
                    <div class="h4 text-primary">@currency($product->price)</div>
                </div>`;
                break;
            case 'product-gallery':
                html = `<div class="product-gallery-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    <div class="row g-3">
                        @foreach($product->images as $image)
                            <div class="col-md-4">
                                <img src="{{ asset($image->path) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                            </div>
                        @endforeach
                    </div>
                </div>`;
                break;
            case 'buy-button':
                html = `<div style="text-align: ${style.textAlign || 'center'}; padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="bi bi-cart-plus me-2"></i>Add to Cart - @currency($product->price)
                        </button>
                    </form>
                </div>`;
                break;
            case 'spacer':
                html = `<div style="height: ${content.height || '50px'};"></div>`;
                break;
            case 'divider':
                html = `<hr style="border-top: 2px ${content.style || 'solid'} ${content.color || '#dee2e6'}; margin: ${style.margin?.top || '1rem'} 0 ${style.margin?.bottom || '1rem'} 0;">`;
                break;
            case 'hero':
                const heroBg = content.backgroundImage ? `background-image: url(${content.backgroundImage}); background-size: cover; background-position: center;` : '';
                const heroOverlay = content.overlay ? `background-color: rgba(0,0,0,${content.overlayOpacity || 0.5});` : '';
                html = `<div class="hero-section" style="${heroBg} ${heroOverlay} padding: 4rem 2rem; text-align: center; color: white; min-height: 400px; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <h1 style="font-size: 3rem; margin-bottom: 1rem;">${content.title || 'Hero Title'}</h1>
                    <p style="font-size: 1.25rem; margin-bottom: 2rem;">${content.subtitle || 'Hero Subtitle'}</p>
                    <a href="${content.buttonUrl || '#'}" class="btn btn-lg btn-light">${content.buttonText || 'Get Started'}</a>
                </div>`;
                break;
            case 'two-column':
                const leftBlocks = (content.left?.blocks || []).map(b => renderBlock(b)).join('');
                const rightBlocks = (content.right?.blocks || []).map(b => renderBlock(b)).join('');
                html = `<div class="two-column-block column-container" data-block-id="${block.id}" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'}; background-color: ${style.backgroundColor || 'transparent'};">
                    <div class="row g-4">
                        <div class="col-md-6 column-dropzone" data-column="left" style="min-height: 100px; padding: 1rem; background: #f8f9fa; border-radius: 0.5rem; border: 2px dashed #dee2e6;">
                            ${leftBlocks || '<div class="text-muted text-center">Drop blocks here</div>'}
                        </div>
                        <div class="col-md-6 column-dropzone" data-column="right" style="min-height: 100px; padding: 1rem; background: #f8f9fa; border-radius: 0.5rem; border: 2px dashed #dee2e6;">
                            ${rightBlocks || '<div class="text-muted text-center">Drop blocks here</div>'}
                        </div>
                    </div>
                </div>`;
                break;
            case 'three-column':
                const col1Blocks = (content.col1?.blocks || []).map(b => renderBlock(b)).join('');
                const col2Blocks = (content.col2?.blocks || []).map(b => renderBlock(b)).join('');
                const col3Blocks = (content.col3?.blocks || []).map(b => renderBlock(b)).join('');
                html = `<div class="three-column-block column-container" data-block-id="${block.id}" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'}; background-color: ${style.backgroundColor || 'transparent'};">
                    <div class="row g-4">
                        <div class="col-md-4 column-dropzone" data-column="col1" style="min-height: 100px; padding: 1rem; background: #f8f9fa; border-radius: 0.5rem; border: 2px dashed #dee2e6;">
                            ${col1Blocks || '<div class="text-muted text-center">Drop blocks here</div>'}
                        </div>
                        <div class="col-md-4 column-dropzone" data-column="col2" style="min-height: 100px; padding: 1rem; background: #f8f9fa; border-radius: 0.5rem; border: 2px dashed #dee2e6;">
                            ${col2Blocks || '<div class="text-muted text-center">Drop blocks here</div>'}
                        </div>
                        <div class="col-md-4 column-dropzone" data-column="col3" style="min-height: 100px; padding: 1rem; background: #f8f9fa; border-radius: 0.5rem; border: 2px dashed #dee2e6;">
                            ${col3Blocks || '<div class="text-muted text-center">Drop blocks here</div>'}
                        </div>
                    </div>
                </div>`;
                break;
            case 'tabs':
                const tabsHtml = (content.tabs || []).map((tab, idx) => 
                    `<button class="btn btn-outline-primary btn-sm me-2 ${idx === 0 ? 'active' : ''}">${tab.title || 'Tab'}</button>`
                ).join('');
                const tabContent = (content.tabs || []).map((tab, idx) => 
                    `<div class="tab-content p-3 border rounded ${idx === 0 ? '' : 'd-none'}">${tab.content || 'Tab content'}</div>`
                ).join('');
                html = `<div class="tabs-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    <div class="tabs-header mb-3">${tabsHtml}</div>
                    <div class="tabs-body">${tabContent}</div>
                </div>`;
                break;
            case 'video':
                let videoHtml = '';
                if (content.platform === 'youtube' && content.url) {
                    const videoId = content.url.includes('youtu.be/') ? content.url.split('youtu.be/')[1].split('?')[0] : 
                                   content.url.includes('youtube.com/watch?v=') ? content.url.split('v=')[1].split('&')[0] : '';
                    videoHtml = `<iframe width="100%" height="400" src="https://www.youtube.com/embed/${videoId}${content.autoplay ? '?autoplay=1' : ''}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
                } else if (content.platform === 'vimeo' && content.url) {
                    const videoId = content.url.split('vimeo.com/')[1]?.split('?')[0] || '';
                    videoHtml = `<iframe src="https://player.vimeo.com/video/${videoId}${content.autoplay ? '?autoplay=1' : ''}" width="100%" height="400" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>`;
                } else {
                    videoHtml = `<div class="text-center p-5 bg-light">Enter video URL in settings</div>`;
                }
                html = `<div class="video-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    ${videoHtml}
                </div>`;
                break;
            case 'image-gallery':
                const galleryImages = (content.images || []).slice(0, 6);
                const galleryHtml = galleryImages.length > 0 ? 
                    `<div class="row g-2">
                        ${galleryImages.map(img => `<div class="col-md-4"><img src="${img.url || ''}" alt="${img.alt || ''}" class="img-fluid rounded"></div>`).join('')}
                    </div>` :
                    `<div class="text-center p-3 bg-light">Add images in settings</div>`;
                html = `<div class="image-gallery-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    ${galleryHtml}
                </div>`;
                break;
            case 'icon-box':
                html = `<div class="icon-box-block text-center" style="padding: ${style.padding?.top || '2rem'} ${style.padding?.right || '1rem'} ${style.padding?.bottom || '2rem'} ${style.padding?.left || '1rem'}; background-color: ${style.backgroundColor || 'transparent'};">
                    <i class="bi ${content.icon || 'bi-star'}" style="font-size: 3rem; color: ${content.iconColor || '#0d6efd'}; margin-bottom: 1rem;"></i>
                    <h4>${content.title || 'Feature Title'}</h4>
                    <p>${content.text || 'Feature description'}</p>
                </div>`;
                break;
            case 'features-list':
                const featuresHtml = (content.features || []).map(f => 
                    `<div class="d-flex align-items-start mb-3">
                        <i class="bi ${f.icon || 'bi-check-circle'} text-success me-2" style="font-size: 1.5rem;"></i>
                        <span>${f.text || 'Feature'}</span>
                    </div>`
                ).join('');
                html = `<div class="features-list-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    ${featuresHtml || '<p class="text-muted">Add features in settings</p>'}
                </div>`;
                break;
            case 'faq':
                const faqHtml = (content.items || []).map((item, idx) => 
                    `<div class="accordion-item mb-2">
                        <div class="accordion-header">
                            <button class="btn btn-link w-100 text-start" type="button">${item.question || 'Question?'}</button>
                        </div>
                        <div class="accordion-body p-3 bg-light">
                            ${item.answer || 'Answer'}
                        </div>
                    </div>`
                ).join('');
                html = `<div class="faq-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    ${faqHtml || '<p class="text-muted">Add FAQ items in settings</p>'}
                </div>`;
                break;
            case 'testimonials':
                const testimonialsHtml = (content.testimonials || []).map(t => 
                    `<div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-2">
                                ${'★'.repeat(t.rating || 5)} ${'☆'.repeat(5 - (t.rating || 5))}
                            </div>
                            <p class="mb-2">"${t.text || 'Testimonial text'}"</p>
                            <strong>${t.name || 'Customer'}</strong>
                        </div>
                    </div>`
                ).join('');
                html = `<div class="testimonials-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    ${testimonialsHtml || '<p class="text-muted">Add testimonials in settings</p>'}
                </div>`;
                break;
            case 'stats':
                const statsHtml = (content.stats || []).map(s => 
                    `<div class="text-center p-3">
                        <i class="bi ${s.icon || 'bi-graph-up'}" style="font-size: 2rem; color: #0d6efd;"></i>
                        <div class="h2 mt-2">${s.value || '0'}</div>
                        <div class="text-muted">${s.label || 'Label'}</div>
                    </div>`
                ).join('');
                html = `<div class="stats-block row g-3" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    ${statsHtml || '<p class="text-muted">Add stats in settings</p>'}
                </div>`;
                break;
            case 'progress-bar':
                html = `<div class="progress-bar-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    <div class="d-flex justify-content-between mb-2">
                        <span>${content.label || 'Progress'}</span>
                        ${content.showPercentage ? `<span>${content.value || 0}%</span>` : ''}
                    </div>
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar bg-${content.color || 'primary'}" role="progressbar" style="width: ${content.value || 0}%"></div>
                    </div>
                </div>`;
                break;
            case 'social-share':
                const platforms = content.platforms || ['facebook', 'twitter'];
                const shareButtons = platforms.map(p => {
                    const icons = {
                        facebook: 'bi-facebook',
                        twitter: 'bi-twitter',
                        whatsapp: 'bi-whatsapp',
                        linkedin: 'bi-linkedin',
                        pinterest: 'bi-pinterest'
                    };
                    return `<a href="#" class="btn btn-sm btn-outline-primary me-2">
                        <i class="bi ${icons[p] || 'bi-share'}"></i>
                        ${content.showLabels ? p.charAt(0).toUpperCase() + p.slice(1) : ''}
                    </a>`;
                }).join('');
                html = `<div class="social-share-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'}; text-align: ${style.textAlign || 'center'};">
                    ${shareButtons || '<p class="text-muted">Select platforms in settings</p>'}
                </div>`;
                break;
            case 'product-reviews':
                html = `<div class="product-reviews-block" style="padding: ${style.padding?.top || '1rem'} ${style.padding?.right || '0'} ${style.padding?.bottom || '1rem'} ${style.padding?.left || '0'};">
                    <h5>Customer Reviews</h5>
                    <p class="text-muted">Product reviews will be displayed here</p>
                </div>`;
                break;
        }
        
        return html;
    }

    function selectBlock(index) {
        selectedBlockIndex = index;
        updateCanvas();
        updateSettings();
    }

    function updateSettings() {
        const settingsDiv = document.getElementById('blockSettings');
        if (selectedBlockIndex === null || !blocks[selectedBlockIndex]) {
            settingsDiv.innerHTML = '<p class="text-muted small">Select a block to edit its settings</p>';
            return;
        }
        
        const block = blocks[selectedBlockIndex];
        let html = `<h6 class="fw-semibold mb-3">${block.type.charAt(0).toUpperCase() + block.type.slice(1)} Settings</h6>`;
        
        // Content settings based on block type
        if (['text', 'heading'].includes(block.type)) {
            html += `<div class="mb-3">
                <label class="form-label small">Text</label>
                <textarea class="form-control form-control-sm" rows="3" id="blockContentText">${block.content?.text || ''}</textarea>
            </div>`;
        }
        
        if (block.type === 'image') {
            html += `<div class="mb-3">
                <label class="form-label small">Image URL</label>
                <input type="text" class="form-control form-control-sm" id="blockContentImageUrl" value="${block.content?.url || ''}" placeholder="https://...">
            </div>
            <div class="mb-3">
                <label class="form-label small">Alt Text</label>
                <input type="text" class="form-control form-control-sm" id="blockContentImageAlt" value="${block.content?.alt || ''}">
            </div>`;
        }
        
        if (block.type === 'button') {
            html += `<div class="mb-3">
                <label class="form-label small">Button Text</label>
                <input type="text" class="form-control form-control-sm" id="blockContentButtonText" value="${block.content?.text || ''}">
            </div>
            <div class="mb-3">
                <label class="form-label small">Button URL</label>
                <input type="text" class="form-control form-control-sm" id="blockContentButtonUrl" value="${block.content?.url || '#'}">
            </div>
            <div class="mb-3">
                <label class="form-label small">Button Style</label>
                <select class="form-select form-select-sm" id="blockContentButtonStyle">
                    <option value="primary" ${block.content?.style === 'primary' ? 'selected' : ''}>Primary</option>
                    <option value="secondary" ${block.content?.style === 'secondary' ? 'selected' : ''}>Secondary</option>
                    <option value="success" ${block.content?.style === 'success' ? 'selected' : ''}>Success</option>
                    <option value="danger" ${block.content?.style === 'danger' ? 'selected' : ''}>Danger</option>
                    <option value="warning" ${block.content?.style === 'warning' ? 'selected' : ''}>Warning</option>
                    <option value="info" ${block.content?.style === 'info' ? 'selected' : ''}>Info</option>
                </select>
            </div>`;
        }
        
        if (block.type === 'spacer') {
            html += `<div class="mb-3">
                <label class="form-label small">Height (px)</label>
                <input type="number" class="form-control form-control-sm" id="blockContentSpacerHeight" value="${parseInt(block.content?.height) || 50}">
            </div>`;
        }
        
        if (block.type === 'hero') {
            html += `<div class="mb-3">
                <label class="form-label small">Title</label>
                <input type="text" class="form-control form-control-sm" id="blockContentHeroTitle" value="${block.content?.title || ''}">
            </div>
            <div class="mb-3">
                <label class="form-label small">Subtitle</label>
                <input type="text" class="form-control form-control-sm" id="blockContentHeroSubtitle" value="${block.content?.subtitle || ''}">
            </div>
            <div class="mb-3">
                <label class="form-label small">Background Image URL</label>
                <input type="text" class="form-control form-control-sm" id="blockContentHeroBg" value="${block.content?.backgroundImage || ''}" placeholder="https://...">
            </div>
            <div class="mb-3">
                <label class="form-label small">Button Text</label>
                <input type="text" class="form-control form-control-sm" id="blockContentHeroButtonText" value="${block.content?.buttonText || ''}">
            </div>
            <div class="mb-3">
                <label class="form-label small">Button URL</label>
                <input type="text" class="form-control form-control-sm" id="blockContentHeroButtonUrl" value="${block.content?.buttonUrl || '#'}">
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="blockContentHeroOverlay" ${block.content?.overlay ? 'checked' : ''}>
                    <label class="form-check-label" for="blockContentHeroOverlay">Dark Overlay</label>
                </div>
            </div>`;
        }
        
        if (block.type === 'two-column') {
            html += `<div class="mb-3">
                <label class="form-label small">Left Column</label>
                <div class="column-blocks-list mb-2" data-column="left" style="min-height: 50px; padding: 0.5rem; background: #f8f9fa; border-radius: 0.25rem;">
                    ${(block.content?.left?.blocks || []).length > 0 ? 
                        (block.content.left.blocks.map((b, idx) => `<div class="d-flex justify-content-between align-items-center mb-1 p-2 bg-white rounded">
                            <span>${b.type}</span>
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeColumnBlock(${selectedBlockIndex}, 'left', ${idx})">Remove</button>
                        </div>`).join('')) : 
                        '<div class="text-muted text-center small">No blocks. Click "Add Block" below.</div>'
                    }
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="showColumnBlockSelector('left')">Add Block to Left Column</button>
            </div>
            <div class="mb-3">
                <label class="form-label small">Right Column</label>
                <div class="column-blocks-list mb-2" data-column="right" style="min-height: 50px; padding: 0.5rem; background: #f8f9fa; border-radius: 0.25rem;">
                    ${(block.content?.right?.blocks || []).length > 0 ? 
                        (block.content.right.blocks.map((b, idx) => `<div class="d-flex justify-content-between align-items-center mb-1 p-2 bg-white rounded">
                            <span>${b.type}</span>
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeColumnBlock(${selectedBlockIndex}, 'right', ${idx})">Remove</button>
                        </div>`).join('')) : 
                        '<div class="text-muted text-center small">No blocks. Click "Add Block" below.</div>'
                    }
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="showColumnBlockSelector('right')">Add Block to Right Column</button>
            </div>`;
        }
        
        if (block.type === 'three-column') {
            html += `<div class="mb-3">
                <label class="form-label small">Column 1</label>
                <div class="column-blocks-list mb-2" data-column="col1" style="min-height: 50px; padding: 0.5rem; background: #f8f9fa; border-radius: 0.25rem;">
                    ${(block.content?.col1?.blocks || []).length > 0 ? 
                        (block.content.col1.blocks.map((b, idx) => `<div class="d-flex justify-content-between align-items-center mb-1 p-2 bg-white rounded">
                            <span>${b.type}</span>
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeColumnBlock(${selectedBlockIndex}, 'col1', ${idx})">Remove</button>
                        </div>`).join('')) : 
                        '<div class="text-muted text-center small">No blocks. Click "Add Block" below.</div>'
                    }
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="showColumnBlockSelector('col1')">Add Block to Column 1</button>
            </div>
            <div class="mb-3">
                <label class="form-label small">Column 2</label>
                <div class="column-blocks-list mb-2" data-column="col2" style="min-height: 50px; padding: 0.5rem; background: #f8f9fa; border-radius: 0.25rem;">
                    ${(block.content?.col2?.blocks || []).length > 0 ? 
                        (block.content.col2.blocks.map((b, idx) => `<div class="d-flex justify-content-between align-items-center mb-1 p-2 bg-white rounded">
                            <span>${b.type}</span>
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeColumnBlock(${selectedBlockIndex}, 'col2', ${idx})">Remove</button>
                        </div>`).join('')) : 
                        '<div class="text-muted text-center small">No blocks. Click "Add Block" below.</div>'
                    }
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="showColumnBlockSelector('col2')">Add Block to Column 2</button>
            </div>
            <div class="mb-3">
                <label class="form-label small">Column 3</label>
                <div class="column-blocks-list mb-2" data-column="col3" style="min-height: 50px; padding: 0.5rem; background: #f8f9fa; border-radius: 0.25rem;">
                    ${(block.content?.col3?.blocks || []).length > 0 ? 
                        (block.content.col3.blocks.map((b, idx) => `<div class="d-flex justify-content-between align-items-center mb-1 p-2 bg-white rounded">
                            <span>${b.type}</span>
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeColumnBlock(${selectedBlockIndex}, 'col3', ${idx})">Remove</button>
                        </div>`).join('')) : 
                        '<div class="text-muted text-center small">No blocks. Click "Add Block" below.</div>'
                    }
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="showColumnBlockSelector('col3')">Add Block to Column 3</button>
            </div>`;
        }
        
        if (block.type === 'tabs') {
            html += `<div id="tabsList" class="mb-3"></div>
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addTab()">Add Tab</button>`;
        }
        
        if (block.type === 'video') {
            html += `<div class="mb-3">
                <label class="form-label small">Platform</label>
                <select class="form-select form-select-sm" id="blockContentVideoPlatform">
                    <option value="youtube" ${block.content?.platform === 'youtube' ? 'selected' : ''}>YouTube</option>
                    <option value="vimeo" ${block.content?.platform === 'vimeo' ? 'selected' : ''}>Vimeo</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label small">Video URL</label>
                <input type="text" class="form-control form-control-sm" id="blockContentVideoUrl" value="${block.content?.url || ''}" placeholder="https://youtube.com/watch?v=...">
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="blockContentVideoAutoplay" ${block.content?.autoplay ? 'checked' : ''}>
                    <label class="form-check-label" for="blockContentVideoAutoplay">Autoplay</label>
                </div>
            </div>`;
        }
        
        if (block.type === 'icon-box') {
            html += `<div class="mb-3">
                <label class="form-label small">Icon (Bootstrap Icons class)</label>
                <input type="text" class="form-control form-control-sm" id="blockContentIconBoxIcon" value="${block.content?.icon || 'bi-star'}" placeholder="bi-star">
            </div>
            <div class="mb-3">
                <label class="form-label small">Title</label>
                <input type="text" class="form-control form-control-sm" id="blockContentIconBoxTitle" value="${block.content?.title || ''}">
            </div>
            <div class="mb-3">
                <label class="form-label small">Text</label>
                <textarea class="form-control form-control-sm" rows="3" id="blockContentIconBoxText">${block.content?.text || ''}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label small">Icon Color</label>
                <input type="color" class="form-control form-control-color form-control-sm" id="blockContentIconBoxColor" value="${block.content?.iconColor || '#0d6efd'}">
            </div>`;
        }
        
        if (block.type === 'features-list') {
            const features = block.content?.features || [];
            html += `<div id="featuresList" class="mb-3">`;
            features.forEach((feature, idx) => {
                html += `<div class="card mb-2">
                    <div class="card-body p-2">
                        <input type="text" class="form-control form-control-sm mb-2" value="${feature.icon || ''}" placeholder="Icon class (bi-check-circle)" onchange="updateFeatureIcon(${idx}, this.value)">
                        <input type="text" class="form-control form-control-sm" value="${feature.text || ''}" placeholder="Feature text" onchange="updateFeatureText(${idx}, this.value)">
                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeFeature(${idx})">Remove</button>
                    </div>
                </div>`;
            });
            html += `</div><button type="button" class="btn btn-sm btn-outline-primary" onclick="addFeature()">Add Feature</button>`;
        }
        
        if (block.type === 'faq') {
            const faqItems = block.content?.items || [];
            html += `<div id="faqList" class="mb-3">`;
            faqItems.forEach((item, idx) => {
                html += `<div class="card mb-2">
                    <div class="card-body p-2">
                        <input type="text" class="form-control form-control-sm mb-2" value="${item.question || ''}" placeholder="Question" onchange="updateFaqQuestion(${idx}, this.value)">
                        <textarea class="form-control form-control-sm" rows="2" placeholder="Answer" onchange="updateFaqAnswer(${idx}, this.value)">${item.answer || ''}</textarea>
                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeFaqItem(${idx})">Remove</button>
                    </div>
                </div>`;
            });
            html += `</div><button type="button" class="btn btn-sm btn-outline-primary" onclick="addFaqItem()">Add FAQ</button>`;
        }
        
        if (block.type === 'testimonials') {
            const testimonials = block.content?.testimonials || [];
            html += `<div id="testimonialsList" class="mb-3">`;
            testimonials.forEach((testimonial, idx) => {
                html += `<div class="card mb-2">
                    <div class="card-body p-2">
                        <input type="text" class="form-control form-control-sm mb-2" value="${testimonial.name || ''}" placeholder="Customer Name" onchange="updateTestimonialName(${idx}, this.value)">
                        <textarea class="form-control form-control-sm mb-2" rows="2" placeholder="Testimonial" onchange="updateTestimonialText(${idx}, this.value)">${testimonial.text || ''}</textarea>
                        <input type="number" class="form-control form-control-sm" min="1" max="5" value="${testimonial.rating || 5}" placeholder="Rating (1-5)" onchange="updateTestimonialRating(${idx}, this.value)">
                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeTestimonial(${idx})">Remove</button>
                    </div>
                </div>`;
            });
            html += `</div><button type="button" class="btn btn-sm btn-outline-primary" onclick="addTestimonial()">Add Testimonial</button>`;
        }
        
        if (block.type === 'stats') {
            const stats = block.content?.stats || [];
            html += `<div id="statsList" class="mb-3">`;
            stats.forEach((stat, idx) => {
                html += `<div class="card mb-2">
                    <div class="card-body p-2">
                        <input type="text" class="form-control form-control-sm mb-2" value="${stat.label || ''}" placeholder="Label" onchange="updateStatLabel(${idx}, this.value)">
                        <input type="text" class="form-control form-control-sm mb-2" value="${stat.value || ''}" placeholder="Value" onchange="updateStatValue(${idx}, this.value)">
                        <input type="text" class="form-control form-control-sm" value="${stat.icon || ''}" placeholder="Icon (bi-graph-up)" onchange="updateStatIcon(${idx}, this.value)">
                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeStat(${idx})">Remove</button>
                    </div>
                </div>`;
            });
            html += `</div><button type="button" class="btn btn-sm btn-outline-primary" onclick="addStat()">Add Stat</button>`;
        }
        
        if (block.type === 'progress-bar') {
            html += `<div class="mb-3">
                <label class="form-label small">Label</label>
                <input type="text" class="form-control form-control-sm" id="blockContentProgressLabel" value="${block.content?.label || ''}">
            </div>
            <div class="mb-3">
                <label class="form-label small">Value (%)</label>
                <input type="number" class="form-control form-control-sm" id="blockContentProgressValue" min="0" max="100" value="${block.content?.value || 0}">
            </div>
            <div class="mb-3">
                <label class="form-label small">Color</label>
                <select class="form-select form-select-sm" id="blockContentProgressColor">
                    <option value="primary" ${block.content?.color === 'primary' ? 'selected' : ''}>Primary</option>
                    <option value="success" ${block.content?.color === 'success' ? 'selected' : ''}>Success</option>
                    <option value="info" ${block.content?.color === 'info' ? 'selected' : ''}>Info</option>
                    <option value="warning" ${block.content?.color === 'warning' ? 'selected' : ''}>Warning</option>
                    <option value="danger" ${block.content?.color === 'danger' ? 'selected' : ''}>Danger</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="blockContentProgressShowPercent" ${block.content?.showPercentage ? 'checked' : ''}>
                    <label class="form-check-label" for="blockContentProgressShowPercent">Show Percentage</label>
                </div>
            </div>`;
        }
        
        if (block.type === 'social-share') {
            const platforms = ['facebook', 'twitter', 'whatsapp', 'linkedin', 'pinterest'];
            html += `<div class="mb-3">
                <label class="form-label small">Platforms</label>
                ${platforms.map(p => `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sharePlatform${p}" value="${p}" ${(block.content?.platforms || []).includes(p) ? 'checked' : ''}>
                        <label class="form-check-label" for="sharePlatform${p}">${p.charAt(0).toUpperCase() + p.slice(1)}</label>
                    </div>
                `).join('')}
            </div>
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="blockContentSocialShowLabels" ${block.content?.showLabels ? 'checked' : ''}>
                    <label class="form-check-label" for="blockContentSocialShowLabels">Show Labels</label>
                </div>
            </div>`;
        }
        
        // Style settings
        html += `<hr><h6 class="fw-semibold mb-3">Style Settings</h6>`;
        html += `<div class="mb-3">
            <label class="form-label small">Text Align</label>
            <select class="form-select form-select-sm" id="blockStyleTextAlign">
                <option value="left" ${block.styles?.textAlign === 'left' ? 'selected' : ''}>Left</option>
                <option value="center" ${block.styles?.textAlign === 'center' ? 'selected' : ''}>Center</option>
                <option value="right" ${block.styles?.textAlign === 'right' ? 'selected' : ''}>Right</option>
            </select>
        </div>`;
        html += `<div class="mb-3">
            <label class="form-label small">Background Color</label>
            <input type="color" class="form-control form-control-color form-control-sm" id="blockStyleBackgroundColor" value="${block.styles?.backgroundColor || '#ffffff'}">
        </div>`;
        html += `<div class="mb-3">
            <label class="form-label small">Text Color</label>
            <input type="color" class="form-control form-control-color form-control-sm" id="blockStyleColor" value="${block.styles?.color || '#333333'}">
        </div>`;
        
        settingsDiv.innerHTML = html;
        
        // Add event listeners
        settingsDiv.querySelectorAll('input, textarea, select').forEach(input => {
            input.addEventListener('change', function() {
                updateBlockFromSettings();
            });
            input.addEventListener('input', function() {
                if (this.type === 'text' || this.type === 'textarea') {
                    updateBlockFromSettings();
                }
            });
        });
    }

    function updateBlockFromSettings() {
        if (selectedBlockIndex === null) return;
        
        const block = blocks[selectedBlockIndex];
        const settingsDiv = document.getElementById('blockSettings');
        
        // Update content
        if (['text', 'heading'].includes(block.type)) {
            const textInput = settingsDiv.querySelector('#blockContentText');
            if (textInput) block.content.text = textInput.value;
        }
        
        if (block.type === 'image') {
            const urlInput = settingsDiv.querySelector('#blockContentImageUrl');
            const altInput = settingsDiv.querySelector('#blockContentImageAlt');
            if (urlInput) block.content.url = urlInput.value;
            if (altInput) block.content.alt = altInput.value;
        }
        
        if (block.type === 'button') {
            const textInput = settingsDiv.querySelector('#blockContentButtonText');
            const urlInput = settingsDiv.querySelector('#blockContentButtonUrl');
            const styleInput = settingsDiv.querySelector('#blockContentButtonStyle');
            if (textInput) block.content.text = textInput.value;
            if (urlInput) block.content.url = urlInput.value;
            if (styleInput) block.content.style = styleInput.value;
        }
        
        if (block.type === 'spacer') {
            const heightInput = settingsDiv.querySelector('#blockContentSpacerHeight');
            if (heightInput) block.content.height = heightInput.value + 'px';
        }
        
        if (block.type === 'hero') {
            const titleInput = settingsDiv.querySelector('#blockContentHeroTitle');
            const subtitleInput = settingsDiv.querySelector('#blockContentHeroSubtitle');
            const bgInput = settingsDiv.querySelector('#blockContentHeroBg');
            const btnTextInput = settingsDiv.querySelector('#blockContentHeroButtonText');
            const btnUrlInput = settingsDiv.querySelector('#blockContentHeroButtonUrl');
            const overlayInput = settingsDiv.querySelector('#blockContentHeroOverlay');
            if (titleInput) block.content.title = titleInput.value;
            if (subtitleInput) block.content.subtitle = subtitleInput.value;
            if (bgInput) block.content.backgroundImage = bgInput.value;
            if (btnTextInput) block.content.buttonText = btnTextInput.value;
            if (btnUrlInput) block.content.buttonUrl = btnUrlInput.value;
            if (overlayInput) block.content.overlay = overlayInput.checked;
        }
        
        // Column blocks are managed separately via addColumnBlock/removeColumnBlock functions
        
        if (block.type === 'video') {
            const platformInput = settingsDiv.querySelector('#blockContentVideoPlatform');
            const urlInput = settingsDiv.querySelector('#blockContentVideoUrl');
            const autoplayInput = settingsDiv.querySelector('#blockContentVideoAutoplay');
            if (platformInput) block.content.platform = platformInput.value;
            if (urlInput) block.content.url = urlInput.value;
            if (autoplayInput) block.content.autoplay = autoplayInput.checked;
        }
        
        if (block.type === 'icon-box') {
            const iconInput = settingsDiv.querySelector('#blockContentIconBoxIcon');
            const titleInput = settingsDiv.querySelector('#blockContentIconBoxTitle');
            const textInput = settingsDiv.querySelector('#blockContentIconBoxText');
            const colorInput = settingsDiv.querySelector('#blockContentIconBoxColor');
            if (iconInput) block.content.icon = iconInput.value;
            if (titleInput) block.content.title = titleInput.value;
            if (textInput) block.content.text = textInput.value;
            if (colorInput) block.content.iconColor = colorInput.value;
        }
        
        if (block.type === 'progress-bar') {
            const labelInput = settingsDiv.querySelector('#blockContentProgressLabel');
            const valueInput = settingsDiv.querySelector('#blockContentProgressValue');
            const colorInput = settingsDiv.querySelector('#blockContentProgressColor');
            const showPercentInput = settingsDiv.querySelector('#blockContentProgressShowPercent');
            if (labelInput) block.content.label = labelInput.value;
            if (valueInput) block.content.value = parseInt(valueInput.value) || 0;
            if (colorInput) block.content.color = colorInput.value;
            if (showPercentInput) block.content.showPercentage = showPercentInput.checked;
        }
        
        if (block.type === 'social-share') {
            const checkedPlatforms = Array.from(settingsDiv.querySelectorAll('input[type="checkbox"][id^="sharePlatform"]:checked')).map(cb => cb.value);
            const showLabelsInput = settingsDiv.querySelector('#blockContentSocialShowLabels');
            block.content.platforms = checkedPlatforms;
            if (showLabelsInput) block.content.showLabels = showLabelsInput.checked;
        }
        
        // Update styles
        const textAlignInput = settingsDiv.querySelector('#blockStyleTextAlign');
        const bgColorInput = settingsDiv.querySelector('#blockStyleBackgroundColor');
        const colorInput = settingsDiv.querySelector('#blockStyleColor');
        
        if (textAlignInput) block.styles.textAlign = textAlignInput.value;
        if (bgColorInput) block.styles.backgroundColor = bgColorInput.value;
        if (colorInput) block.styles.color = colorInput.value;
        
        updateCanvas();
        selectBlock(selectedBlockIndex);
    }

    // Save page builder
    document.getElementById('savePageBuilder').addEventListener('click', function() {
        const useCustomPage = document.getElementById('useCustomPage').checked;
        
        fetch('{{ route("admin.products.page-builder.save", $product) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                page_builder_data: blocks,
                use_custom_page: useCustomPage
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Page builder saved successfully!',
                    confirmButtonColor: '#667eea',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error saving page builder',
                    confirmButtonColor: '#667eea'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error saving page builder',
                confirmButtonColor: '#667eea'
            });
        });
    });

    // Column block management
    let currentColumnBlockIndex = null;
    let currentColumnName = null;
    
    window.showColumnBlockSelector = function(columnName) {
        if (selectedBlockIndex === null) return;
        currentColumnBlockIndex = selectedBlockIndex;
        currentColumnName = columnName;
        
        // Show modal or dropdown to select block type
        const blockTypes = ['text', 'heading', 'image', 'button', 'icon-box', 'features-list', 'spacer', 'divider', 'video', 'progress-bar'];
        let optionsHtml = blockTypes.map(type => 
            `<button type="button" class="btn btn-sm btn-outline-primary w-100 mb-2" onclick="addColumnBlock('${type}')">${type.charAt(0).toUpperCase() + type.slice(1).replace('-', ' ')}</button>`
        ).join('');
        
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Block to ${columnName}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        ${optionsHtml}
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        modal.addEventListener('hidden.bs.modal', () => modal.remove());
    };
    
    window.addColumnBlock = function(blockType) {
        if (currentColumnBlockIndex === null || !currentColumnName) return;
        const block = blocks[currentColumnBlockIndex];
        if (!block.content) block.content = {};
        if (!block.content[currentColumnName]) block.content[currentColumnName] = { blocks: [] };
        if (!block.content[currentColumnName].blocks) block.content[currentColumnName].blocks = [];
        
        const newBlock = {
            id: Date.now(),
            type: blockType,
            content: getDefaultContent(blockType),
            styles: getDefaultStyles(blockType)
        };
        block.content[currentColumnName].blocks.push(newBlock);
        
        updateCanvas();
        selectBlock(currentColumnBlockIndex);
        
        // Close modal
        const modal = document.querySelector('.modal.show');
        if (modal) {
            const bsModal = bootstrap.Modal.getInstance(modal);
            if (bsModal) bsModal.hide();
        }
    };
    
    window.removeColumnBlock = function(blockIndex, columnName, blockIdx) {
        if (blockIndex === null) return;
        const block = blocks[blockIndex];
        if (block.content && block.content[columnName] && block.content[columnName].blocks) {
            block.content[columnName].blocks.splice(blockIdx, 1);
            updateCanvas();
            selectBlock(blockIndex);
        }
    };

    // Initial render
    updateCanvas();
});
</script>
@endpush
@endsection

