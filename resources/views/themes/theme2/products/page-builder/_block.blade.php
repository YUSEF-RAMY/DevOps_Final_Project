@php
    $styles = $block['styles'] ?? [];
    $content = $block['content'] ?? [];
    $type = $block['type'] ?? 'text';
    
    $styleAttr = '';
    if (!empty($styles['padding'])) {
        $p = $styles['padding'];
        $styleAttr .= 'padding: ' . ($p['top'] ?? '1rem') . ' ' . ($p['right'] ?? '0') . ' ' . ($p['bottom'] ?? '1rem') . ' ' . ($p['left'] ?? '0') . '; ';
    }
    if (!empty($styles['margin'])) {
        $m = $styles['margin'];
        $styleAttr .= 'margin: ' . ($m['top'] ?? '0') . ' ' . ($m['right'] ?? '0') . ' ' . ($m['bottom'] ?? '0') . ' ' . ($m['left'] ?? '0') . '; ';
    }
    if (!empty($styles['backgroundColor'])) {
        $styleAttr .= 'background-color: ' . $styles['backgroundColor'] . '; ';
    }
    if (!empty($styles['textAlign'])) {
        $styleAttr .= 'text-align: ' . $styles['textAlign'] . '; ';
    }
    if (!empty($styles['color'])) {
        $styleAttr .= 'color: ' . $styles['color'] . '; ';
    }
    if (!empty($styles['fontSize'])) {
        $styleAttr .= 'font-size: ' . $styles['fontSize'] . '; ';
    }
@endphp

@switch($type)
    @case('text')
        <div style="{{ $styleAttr }}">{!! nl2br(e($content['text'] ?? '')) !!}</div>
        @break
    
    @case('heading')
        <h2 style="{{ $styleAttr }}">{{ $content['text'] ?? 'Heading' }}</h2>
        @break
    
    @case('image')
        @if(!empty($content['url']))
            <div style="{{ $styleAttr }}">
                <img src="{{ $content['url'] }}" alt="{{ $content['alt'] ?? '' }}" class="img-fluid" style="max-width: 100%; height: auto; {{ !empty($content['width']) ? 'width: ' . $content['width'] . ';' : '' }}">
            </div>
        @endif
        @break
    
    @case('button')
        <div style="{{ $styleAttr }}">
            <a href="{{ $content['url'] ?? '#' }}" class="btn btn-{{ $content['style'] ?? 'primary' }}">{{ $content['text'] ?? 'Button' }}</a>
        </div>
        @break
    
    @case('product-info')
        <div style="{{ $styleAttr }}">
            <h3>{{ $product->name }}</h3>
            @if($product->short_description)
                <p class="text-muted">{{ $product->short_description }}</p>
            @endif
            <div class="h4 text-primary">@currency($product->price)</div>
            @if($product->compare_at_price && $product->compare_at_price > $product->price)
                <div class="text-muted text-decoration-line-through">@currency($product->compare_at_price)</div>
            @endif
            @if($product->stock > 0)
                <p class="text-success"><i class="bi bi-check-circle me-1"></i>{{ $product->stock }} in stock</p>
            @else
                <p class="text-danger"><i class="bi bi-x-circle me-1"></i>Out of stock</p>
            @endif
        </div>
        @break
    
    @case('product-gallery')
        @if($product->images->count() > 0)
            <div style="{{ $styleAttr }}">
                <div class="row g-3">
                    @foreach($product->images as $image)
                        <div class="col-md-4">
                            <img src="{{ asset($image->path) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @break
    
    @case('buy-button')
        <div style="{{ $styleAttr }}">
            @if($product->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <i class="bi bi-cart-plus me-2"></i>Add to Cart - @currency($product->price)
                    </button>
                </form>
            @else
                <button class="btn btn-lg btn-secondary" disabled>
                    <i class="bi bi-x-circle me-2"></i>Out of Stock
                </button>
            @endif
        </div>
        @break
    
    @case('spacer')
        <div style="height: {{ $content['height'] ?? '50px' }};"></div>
        @break
    
    @case('divider')
        <hr style="border-top: 2px {{ $content['style'] ?? 'solid' }} {{ $content['color'] ?? '#dee2e6' }}; margin: {{ $styles['margin']['top'] ?? '1rem' }} 0 {{ $styles['margin']['bottom'] ?? '1rem' }} 0;">
        @break
    
    @case('hero')
        @php
            $heroBg = !empty($content['backgroundImage']) ? 'background-image: url(' . $content['backgroundImage'] . '); background-size: cover; background-position: center;' : '';
            $heroOverlay = !empty($content['overlay']) ? 'background-color: rgba(0,0,0,' . ($content['overlayOpacity'] ?? 0.5) . ');' : '';
        @endphp
        <div class="hero-section" style="{{ $heroBg }} {{ $heroOverlay }} padding: 4rem 2rem; text-align: center; color: white; min-height: 400px; display: flex; align-items: center; justify-content: center; flex-direction: column; {{ $styleAttr }}">
            <h1 style="font-size: 3rem; margin-bottom: 1rem;">{{ $content['title'] ?? 'Hero Title' }}</h1>
            <p style="font-size: 1.25rem; margin-bottom: 2rem;">{{ $content['subtitle'] ?? 'Hero Subtitle' }}</p>
            <a href="{{ $content['buttonUrl'] ?? '#' }}" class="btn btn-lg btn-light">{{ $content['buttonText'] ?? 'Get Started' }}</a>
        </div>
        @break
    
    @case('two-column')
        <div class="two-column-block" style="{{ $styleAttr }}">
            <div class="row g-4">
                <div class="col-md-6">
                    <div style="padding: 1rem;">
                        @if(!empty($content['left']['blocks']))
                            @foreach($content['left']['blocks'] as $nestedBlock)
                                @include('themes.theme2.products.page-builder._block', ['block' => $nestedBlock, 'product' => $product])
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1rem;">
                        @if(!empty($content['right']['blocks']))
                            @foreach($content['right']['blocks'] as $nestedBlock)
                                @include('themes.theme2.products.page-builder._block', ['block' => $nestedBlock, 'product' => $product])
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @break
    
    @case('three-column')
        <div class="three-column-block" style="{{ $styleAttr }}">
            <div class="row g-4">
                <div class="col-md-4">
                    <div style="padding: 1rem;">
                        @if(!empty($content['col1']['blocks']))
                            @foreach($content['col1']['blocks'] as $nestedBlock)
                                @include('themes.theme2.products.page-builder._block', ['block' => $nestedBlock, 'product' => $product])
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="padding: 1rem;">
                        @if(!empty($content['col2']['blocks']))
                            @foreach($content['col2']['blocks'] as $nestedBlock)
                                @include('themes.theme2.products.page-builder._block', ['block' => $nestedBlock, 'product' => $product])
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="padding: 1rem;">
                        @if(!empty($content['col3']['blocks']))
                            @foreach($content['col3']['blocks'] as $nestedBlock)
                                @include('themes.theme2.products.page-builder._block', ['block' => $nestedBlock, 'product' => $product])
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @break
    
    @case('tabs')
        @php $tabs = $content['tabs'] ?? []; @endphp
        @if(count($tabs) > 0)
            <div class="tabs-block" style="{{ $styleAttr }}">
                <ul class="nav nav-tabs mb-3" role="tablist">
                    @foreach($tabs as $index => $tab)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $block['id'] }}-{{ $index }}" type="button">
                                {{ $tab['title'] ?? 'Tab' }}
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($tabs as $index => $tab)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="tab-{{ $block['id'] }}-{{ $index }}">
                            {!! nl2br(e($tab['content'] ?? 'Tab content')) !!}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @break
    
    @case('video')
        @php
            $platform = $content['platform'] ?? 'youtube';
            $videoUrl = $content['url'] ?? '';
        @endphp
        @if(!empty($videoUrl))
            <div class="video-block" style="{{ $styleAttr }}">
                @if($platform === 'youtube')
                    @php
                        $videoId = '';
                        if (strpos($videoUrl, 'youtu.be/') !== false) {
                            $videoId = explode('youtu.be/', $videoUrl)[1];
                            $videoId = explode('?', $videoId)[0];
                        } elseif (strpos($videoUrl, 'youtube.com/watch?v=') !== false) {
                            $videoId = explode('v=', $videoUrl)[1];
                            $videoId = explode('&', $videoId)[0];
                        }
                    @endphp
                    @if($videoId)
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}{{ !empty($content['autoplay']) ? '?autoplay=1' : '' }}" allowfullscreen></iframe>
                        </div>
                    @endif
                @elseif($platform === 'vimeo')
                    @php
                        $videoId = '';
                        if (strpos($videoUrl, 'vimeo.com/') !== false) {
                            $videoId = explode('vimeo.com/', $videoUrl)[1];
                            $videoId = explode('?', $videoId)[0];
                        }
                    @endphp
                    @if($videoId)
                        <div class="ratio ratio-16x9">
                            <iframe src="https://player.vimeo.com/video/{{ $videoId }}{{ !empty($content['autoplay']) ? '?autoplay=1' : '' }}" allowfullscreen></iframe>
                        </div>
                    @endif
                @endif
            </div>
        @endif
        @break
    
    @case('image-gallery')
        @php $images = $content['images'] ?? []; @endphp
        @if(count($images) > 0)
            <div class="image-gallery-block" style="{{ $styleAttr }}">
                <div class="row g-2">
                    @foreach(array_slice($images, 0, 6) as $img)
                        <div class="col-md-4">
                            <img src="{{ $img['url'] ?? '' }}" alt="{{ $img['alt'] ?? '' }}" class="img-fluid rounded shadow-sm">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @break
    
    @case('icon-box')
        <div class="icon-box-block text-center" style="{{ $styleAttr }}">
            <i class="bi {{ $content['icon'] ?? 'bi-star' }}" style="font-size: 3rem; color: {{ $content['iconColor'] ?? '#0d6efd' }}; margin-bottom: 1rem;"></i>
            <h4>{{ $content['title'] ?? 'Feature Title' }}</h4>
            <p>{{ $content['text'] ?? 'Feature description' }}</p>
        </div>
        @break
    
    @case('features-list')
        @php $features = $content['features'] ?? []; @endphp
        @if(count($features) > 0)
            <div class="features-list-block" style="{{ $styleAttr }}">
                @foreach($features as $feature)
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi {{ $feature['icon'] ?? 'bi-check-circle' }} text-success me-2" style="font-size: 1.5rem;"></i>
                        <span>{!! nl2br(e($feature['text'] ?? 'Feature')) !!}</span>
                    </div>
                @endforeach
            </div>
        @endif
        @break
    
    @case('faq')
        @php $faqItems = $content['items'] ?? []; @endphp
        @if(count($faqItems) > 0)
            <div class="faq-block" style="{{ $styleAttr }}">
                <div class="accordion" id="faqAccordion{{ $block['id'] }}">
                    @foreach($faqItems as $index => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $block['id'] }}-{{ $index }}">
                                    {{ $item['question'] ?? 'Question?' }}
                                </button>
                            </h2>
                            <div id="faq{{ $block['id'] }}-{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion{{ $block['id'] }}">
                                <div class="accordion-body">
                                    {!! nl2br(e($item['answer'] ?? 'Answer')) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @break
    
    @case('testimonials')
        @php $testimonials = $content['testimonials'] ?? []; @endphp
        @if(count($testimonials) > 0)
            <div class="testimonials-block" style="{{ $styleAttr }}">
                <div class="row g-3">
                    @foreach($testimonials as $testimonial)
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="mb-2 text-warning">
                                        @for($i = 0; $i < ($testimonial['rating'] ?? 5); $i++)
                                            <i class="bi bi-star-fill"></i>
                                        @endfor
                                        @for($i = ($testimonial['rating'] ?? 5); $i < 5; $i++)
                                            <i class="bi bi-star"></i>
                                        @endfor
                                    </div>
                                    <p class="mb-2">"{{ $testimonial['text'] ?? 'Testimonial text' }}"</p>
                                    <strong>{{ $testimonial['name'] ?? 'Customer' }}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @break
    
    @case('stats')
        @php $stats = $content['stats'] ?? []; @endphp
        @if(count($stats) > 0)
            <div class="stats-block" style="{{ $styleAttr }}">
                <div class="row g-3">
                    @foreach($stats as $stat)
                        <div class="col-md-3 col-6 text-center">
                            <i class="bi {{ $stat['icon'] ?? 'bi-graph-up' }}" style="font-size: 2rem; color: #0d6efd;"></i>
                            <div class="h2 mt-2">{{ $stat['value'] ?? '0' }}</div>
                            <div class="text-muted">{{ $stat['label'] ?? 'Label' }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @break
    
    @case('progress-bar')
        <div class="progress-bar-block" style="{{ $styleAttr }}">
            <div class="d-flex justify-content-between mb-2">
                <span>{{ $content['label'] ?? 'Progress' }}</span>
                @if(!empty($content['showPercentage']))
                    <span>{{ $content['value'] ?? 0 }}%</span>
                @endif
            </div>
            <div class="progress" style="height: 25px;">
                <div class="progress-bar bg-{{ $content['color'] ?? 'primary' }}" role="progressbar" style="width: {{ $content['value'] ?? 0 }}%"></div>
            </div>
        </div>
        @break
    
    @case('social-share')
        @php 
            $platforms = $content['platforms'] ?? ['facebook', 'twitter'];
            $showLabels = $content['showLabels'] ?? true;
            $shareUrl = route('products.show', $product->slug);
            $shareText = $product->name;
        @endphp
        <div class="social-share-block" style="{{ $styleAttr }}">
            @if(in_array('facebook', $platforms))
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-facebook"></i> @if($showLabels) Facebook @endif
                </a>
            @endif
            @if(in_array('twitter', $platforms))
                <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($shareText) }}" target="_blank" class="btn btn-sm btn-outline-info me-2">
                    <i class="bi bi-twitter"></i> @if($showLabels) Twitter @endif
                </a>
            @endif
            @if(in_array('whatsapp', $platforms))
                <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $shareUrl) }}" target="_blank" class="btn btn-sm btn-outline-success me-2">
                    <i class="bi bi-whatsapp"></i> @if($showLabels) WhatsApp @endif
                </a>
            @endif
            @if(in_array('linkedin', $platforms))
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                    <i class="bi bi-linkedin"></i> @if($showLabels) LinkedIn @endif
                </a>
            @endif
            @if(in_array('pinterest', $platforms))
                <a href="https://pinterest.com/pin/create/button/?url={{ urlencode($shareUrl) }}&description={{ urlencode($shareText) }}" target="_blank" class="btn btn-sm btn-outline-danger me-2">
                    <i class="bi bi-pinterest"></i> @if($showLabels) Pinterest @endif
                </a>
            @endif
        </div>
        @break
    
    @case('product-reviews')
        <div class="product-reviews-block" style="{{ $styleAttr }}">
            <h5 class="mb-4">Customer Reviews</h5>
            @if($product->approvedReviews->count() > 0)
                <div class="row g-3">
                    @foreach($product->approvedReviews->take(6) as $review)
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>
                                            @if($review->order)
                                                <span class="badge bg-success ms-2">Verified Purchase</span>
                                            @endif
                                        </div>
                                        <div class="text-warning">
                                            @for($i = 0; $i < $review->rating; $i++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                            @for($i = $review->rating; $i < 5; $i++)
                                                <i class="bi bi-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mb-0">{{ $review->comment }}</p>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No reviews yet. Be the first to review this product!</p>
            @endif
        </div>
        @break
    
    @default
        <!-- Unknown block type: {{ $type }} -->
@endswitch

