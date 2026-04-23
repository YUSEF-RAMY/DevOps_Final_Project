<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class DataTableController extends Controller
{
    public function handle(string $resource, Request $request)
    {
        try {
            $draw = (int) $request->input('draw', 0);
            $start = (int) $request->input('start', 0);
            $length = (int) $request->input('length', 10);
            $search = (string) data_get($request->input('search', []), 'value', '');

            $handlerMethod = 'resource' . Str::studly(Str::singular($resource));
            if (!method_exists($this, $handlerMethod)) {
                return response()->json([
                    'draw' => $draw,
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'error' => 'Handler not found for resource: ' . $resource
                ]);
            }

            return $this->{$handlerMethod}($request, $draw, $start, $length, $search);
        } catch (\Exception $e) {
            Log::error('DataTable error: ' . $e->getMessage(), [
                'resource' => $resource,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'draw' => (int) $request->input('draw', 0),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
                'error' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    protected function resourceProduct(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\Product::query()->with(['category.parent', 'images']);

        $recordsTotal = (clone $query)->count();

        // Filters - Category and Subcategory
        if ($request->filled('subcategory_id')) {
            // If subcategory is selected, filter by subcategory only
            $query->where('category_id', (int) $request->input('subcategory_id'));
        } elseif ($request->filled('category_id')) {
            // If only parent category is selected, include parent and all its subcategories
            $categoryId = (int) $request->input('category_id');
            $subcategoryIds = \App\Models\Category::where('parent_id', $categoryId)->pluck('id');
            if ($subcategoryIds->isNotEmpty()) {
                $query->where(function($q) use ($categoryId, $subcategoryIds) {
                    $q->where('category_id', $categoryId)
                      ->orWhereIn('category_id', $subcategoryIds);
                });
            } else {
                // No subcategories, just filter by parent
                $query->where('category_id', $categoryId);
            }
        }
        
        if ($request->filled('stock')) {
            $stockFilter = $request->input('stock');
            if ($stockFilter === 'in_stock') {
                $query->where('stock', '>', 0);
            } elseif ($stockFilter === 'out_of_stock') {
                $query->where('stock', '<=', 0);
            } elseif ($stockFilter === 'low_stock') {
                $query->where('stock', '>', 0)->where('stock', '<', 10);
            }
        }
        
        if ($request->filled('is_featured')) {
            $query->where('is_featured', (int) $request->input('is_featured'));
        }
        
        if ($request->filled('on_sale')) {
            if ($request->input('on_sale') == '1') {
                $query->whereNotNull('compare_at_price')
                      ->whereColumn('price', '<', 'compare_at_price');
            } else {
                $query->where(function($q) {
                    $q->whereNull('compare_at_price')
                      ->orWhereColumn('price', '>=', 'compare_at_price');
                });
            }
        }
        
        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float) $request->input('price_min'));
        }
        
        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float) $request->input('price_max'));
        }
        
        if ($request->filled('is_active')) {
            $query->where('is_active', (int) $request->input('is_active'));
        }
        
        // Product ID filter (from Select2 product name search)
        if ($request->filled('product_id')) {
            $productId = $request->input('product_id');
            // If it's numeric, treat as ID
            if (is_numeric($productId)) {
                $query->where('id', (int) $productId);
            }
        }
        
        // Search
        if ($search !== '') {
            // If search_only is 'name', only search by name
            if ($request->input('search_only') === 'name') {
                $query->where('name', 'like', "%{$search}%");
            } else {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%");
                });
            }
        }

        $recordsFiltered = (clone $query)->count();

        // Ordering
        $order = $this->extractOrdering($request, ['name', 'category', 'price', 'stock', 'compare_at_price', 'is_active']);
        if ($order) {
            $hasCategoryJoin = false;
            foreach ($order as [$col, $dir]) {
                if ($col === 'category') {
                    if (!$hasCategoryJoin) {
                        $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
                        $hasCategoryJoin = true;
                    }
                    $query->orderBy('categories.name', $dir);
                } else {
                    $query->orderBy('products.' . $col, $dir);
                }
            }
        } else {
            $query->latest('products.id');
        }

        $items = $query->select('products.*')->skip($start)->take($length)->get();

        $data = $items->map(function ($p) {
            $category = $p->category;
            $parentCategory = $category && $category->parent ? $category->parent : null;
            $subcategory = $category && $category->parent_id ? $category : null;
            
            // Determine category and subcategory display
            $categoryName = '-';
            $subcategoryName = '-';
            
            if ($subcategory) {
                // Product is assigned to a subcategory
                $categoryName = e($parentCategory->name ?? '-');
                $subcategoryName = e($subcategory->name);
            } elseif ($category && !$category->parent_id) {
                // Product is assigned to a parent category
                $categoryName = e($category->name);
                $subcategoryName = '-';
            }
            
            // Get product image
            $imageHtml = '<div class="text-center" style="width: 100%;">';
            if ($p->images && $p->images->count() > 0) {
                $firstImage = $p->images->sortBy('position')->first();
                $imagePath = $firstImage->image_path ?? $firstImage->path;
                $imageUrl = asset('storage/' . $imagePath);
                $imageHtml .= '<div class="d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; margin: 0 auto;">';
                $imageHtml .= '<img src="' . e($imageUrl) . '" alt="' . e($p->name) . '" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover; padding: 2px;">';
                $imageHtml .= '</div>';
            } else {
                $imageHtml .= '<div class="d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; margin: 0 auto;">';
                $imageHtml .= '<i class="bi bi-image text-muted" style="font-size: 1.5rem;"></i>';
                $imageHtml .= '</div>';
            }
            $imageHtml .= '</div>';
            
            return [
                'image' => $imageHtml,
                'name' => e($p->name),
                'category' => $categoryName,
                'subcategory' => $subcategoryName,
                'price' => '<div class="text-center">৳' . number_format((float) $p->price, 2) . '</div>',
                'stock' => '<span class="badge ' . (($p->stock > 0) ? 'text-bg-success' : 'text-bg-danger') . '">' . number_format((int) $p->stock) . '</span>',
                'compare_at_price' => $p->compare_at_price ? '<div class="text-center">৳' . number_format((float) $p->compare_at_price, 2) . '</div>' : '<div class="text-center"><span class="text-muted">—</span></div>',
                'is_active' => $p->is_active ? '<span class="badge text-bg-success">Yes</span>' : '<span class="badge text-bg-secondary">No</span>',
                'actions' => $this->safeRenderView('admin.products._dt_actions', compact('p')),
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    protected function resourceCategory(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\Category::query()->with('parent');
        $recordsTotal = (clone $query)->count();

        if ($request->filled('is_active')) {
            $query->where('is_active', (int) $request->input('is_active'));
        }
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }
        $recordsFiltered = (clone $query)->count();

        $order = $this->extractOrdering($request, ['name', 'is_active']);
        if ($order) {
            foreach ($order as [$col, $dir]) { $query->orderBy($col, $dir); }
        } else {
            $query->orderBy('parent_id')->orderBy('name');
        }

        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function ($c) {
            $nameDisplay = e($c->name);
            if ($c->parent_id) {
                $nameDisplay = '<span class="text-muted">└─</span> ' . $nameDisplay;
            }
            return [
                'name' => $nameDisplay,
                'parent' => $c->parent ? '<span class="badge text-bg-info">' . e($c->parent->name) . '</span>' : '<span class="text-muted">—</span>',
                'is_active' => $c->is_active ? '<span class="badge text-bg-success">Yes</span>' : '<span class="badge text-bg-secondary">No</span>',
                'actions' => $this->safeRenderView('admin.categories._dt_actions', compact('c')),
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    protected function resourceOrder(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\Order::query()->with('user');
        $recordsTotal = (clone $query)->count();

        if ($request->filled('status')) { $query->where('status', $request->string('status')); }
        if ($request->filled('payment_status')) { $query->where('payment_status', $request->string('payment_status')); }
        if ($request->filled('from')) { $query->whereDate('created_at', '>=', $request->date('from')); }
        if ($request->filled('to')) { $query->whereDate('created_at', '<=', $request->date('to')); }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $recordsFiltered = (clone $query)->count();

        $order = $this->extractOrdering($request, ['number', 'customer', 'status', 'payment_status', 'shipping_status', 'grand_total', 'created_at']);
        if ($order) {
            foreach ($order as [$col, $dir]) {
                $col = $col === 'customer' ? 'id' : $col; // keep deterministic
                $query->orderBy($col, $dir);
            }
        } else { $query->latest('id'); }

        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function ($o) {
            $statusClass = match($o->status){ 'pending'=>'warning','processing'=>'info','cancelled'=>'danger','delivered'=>'success', default=>'secondary' };
            $payClass = $o->payment_status === 'paid' ? 'success' : ($o->payment_status === 'refunded' ? 'secondary' : 'warning');
            $shipClass = match($o->shipping_status){ 'unshipped'=>'secondary','shipped'=>'info','delivered'=>'success','returned'=>'danger', default=>'warning' };
            return [
                'number' => e($o->number),
                'customer' => e(optional($o->user)->name ?? 'Guest') . '<br><small class="text-muted">' . e(optional($o->user)->email ?? '') . '</small>',
                'status' => '<span class="badge text-bg-' . $statusClass . '">' . e(ucfirst($o->status)) . '</span>',
                'payment_status' => '<span class="badge text-bg-' . $payClass . '">' . e(ucfirst($o->payment_status)) . '</span>',
                'shipping_status' => '<span class="badge text-bg-' . $shipClass . '">' . e(ucfirst($o->shipping_status)) . '</span>',
                'grand_total' => '$' . number_format((float) $o->grand_total, 2),
                'created_at' => \App\Support\DateHelper::format($o->created_at),
                'actions' => '<div class="btn-group" role="group"><a href="' . route('admin.orders.show', $o) . '" class="btn btn-sm btn-outline-primary" title="View"><i class="bi bi-eye"></i></a></div>',
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    protected function resourceUser(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\User::query()->withCount(['addresses', 'orders']);
        $recordsTotal = (clone $query)->count();

        if ($request->filled('from')) { $query->whereDate('created_at', '>=', $request->date('from')); }
        if ($request->filled('to')) { $query->whereDate('created_at', '<=', $request->date('to')); }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $recordsFiltered = (clone $query)->count();

        $order = $this->extractOrdering($request, ['id','name','email','phone','addresses_count','orders_count','created_at']);
        if ($order) { foreach ($order as [$c,$d]) { $query->orderBy($c,$d); } } else { $query->latest('id'); }

        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function ($u) {
            return [
                'id' => $u->id,
                'name' => e($u->name),
                'email' => e($u->email),
                'phone' => e($u->phone ?? 'N/A'),
                'addresses_count' => '<span class="badge text-bg-info">' . (int) $u->addresses_count . '</span>',
                'orders_count' => '<span class="badge text-bg-success">' . (int) $u->orders_count . '</span>',
                'created_at' => \App\Support\DateHelper::format($u->created_at),
                'actions' => $this->safeRenderView('admin.users._dt_actions', compact('u')),
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    protected function resourceRole(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \Spatie\Permission\Models\Role::query()->where('guard_name', 'admin');
        $recordsTotal = (clone $query)->count();
        if ($search !== '') { $query->where('name', 'like', "%{$search}%"); }
        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['name']);
        if ($order) { foreach ($order as [$c,$d]) { $query->orderBy($c,$d); } }
        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function ($r) { return [ 'name' => e($r->name), 'actions' => $this->safeRenderView('admin.roles._dt_actions', compact('r')) ]; })->all();
        return response()->json(['draw'=>$draw,'recordsTotal'=>$recordsTotal,'recordsFiltered'=>$recordsFiltered,'data'=>$data]);
    }

    protected function resourcePermission(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \Spatie\Permission\Models\Permission::query()->where('guard_name', 'admin');
        $recordsTotal = (clone $query)->count();
        if ($search !== '') { $query->where('name', 'like', "%{$search}%"); }
        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['name']);
        if ($order) { foreach ($order as [$c,$d]) { $query->orderBy($c,$d); } }
        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function ($p) { return [ 'name' => e($p->name), 'actions' => $this->safeRenderView('admin.permissions._dt_actions', compact('p')) ]; })->all();
        return response()->json(['draw'=>$draw,'recordsTotal'=>$recordsTotal,'recordsFiltered'=>$recordsFiltered,'data'=>$data]);
    }

    protected function resourceCoupon(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\Coupon::query()->withCount('usages');
        $recordsTotal = (clone $query)->count();
        if ($request->filled('type')) { $query->where('type', $request->string('type')); }
        if ($request->filled('is_active')) { $query->where('is_active', (int) $request->input('is_active')); }
        if ($search !== '') { $query->where(function($q) use($search){ $q->where('code','like',"%{$search}%")->orWhere('name','like',"%{$search}%"); }); }
        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['code','name','type','value','usages_count','is_active','expires_at']);
        if ($order) { foreach ($order as [$c,$d]) { $query->orderBy($c,$d); } } else { $query->latest('id'); }
        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function($c){
            $typeBadge = $c->type === 'percentage' ? 'text-bg-info' : 'text-bg-success';
            return [
                'code' => '<code class="bg-light px-2 py-1 rounded">' . e($c->code) . '</code>',
                'name' => e($c->name),
                'type' => '<span class="badge ' . $typeBadge . '">' . e(ucfirst($c->type)) . '</span>',
                'value' => $c->type === 'percentage' ? (int) $c->value . '%' : '$' . number_format((float) $c->value, 2),
                'usages_count' => (int) $c->usages_count . ($c->usage_limit ? (' / ' . (int) $c->usage_limit) : ''),
                'is_active' => $c->is_active ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-secondary">Inactive</span>',
                'expires_at' => $c->expires_at ? $c->expires_at->format('M d, Y') : '<span class="text-muted">Never</span>',
                'actions' => $this->safeRenderView('admin.coupons._dt_actions', compact('c')),
            ];
        })->all();
        return response()->json(['draw'=>$draw,'recordsTotal'=>$recordsTotal,'recordsFiltered'=>$recordsFiltered,'data'=>$data]);
    }

    protected function resourceNewsletter(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\NewsletterSubscriber::query();
        $recordsTotal = (clone $query)->count();
        if ($request->filled('status')) { $query->where('status', $request->string('status')); }
        if ($search !== '') { $query->where(function($q) use($search){ $q->where('email','like',"%{$search}%")->orWhere('name','like',"%{$search}%"); }); }
        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['email','name','status','source','subscribed_at']);
        if ($order) { foreach ($order as [$c,$d]) { $query->orderBy($c,$d); } } else { $query->latest('id'); }
        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function($s){
            $statusBadge = $s->status === 'subscribed' ? 'text-bg-success' : 'text-bg-secondary';
            return [
                'email' => e($s->email),
                'name' => e($s->name ?? '-'),
                'status' => '<span class="badge ' . $statusBadge . '">' . e(ucfirst($s->status)) . '</span>',
                'source' => '<span class="badge text-bg-info">' . e($s->source ?? '-') . '</span>',
                'subscribed_at' => $s->subscribed_at ? $s->subscribed_at->format('M d, Y') : '-',
                'actions' => $this->safeRenderView('admin.newsletter._dt_actions', compact('s')),
            ];
        })->all();
        return response()->json(['draw'=>$draw,'recordsTotal'=>$recordsTotal,'recordsFiltered'=>$recordsFiltered,'data'=>$data]);
    }

    protected function resourceCurrency(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\Currency::query();
        $recordsTotal = (clone $query)->count();
        if ($request->filled('is_active')) { $query->where('is_active', (int) $request->input('is_active')); }
        if ($search !== '') { $query->where(function($q) use($search){ $q->where('code','like',"%{$search}%")->orWhere('name','like',"%{$search}%"); }); }
        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['code','name','symbol','is_active','is_default']);
        if ($order) { foreach ($order as [$c,$d]) { $query->orderBy($c,$d); } } else { $query->latest('id'); }
        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function($c){
            return [
                'code' => '<code>' . e($c->code) . '</code>',
                'name' => e($c->name),
                'symbol' => e($c->symbol),
                'is_active' => $c->is_active ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-secondary">Inactive</span>',
                'is_default' => $c->is_default ? '<span class="badge text-bg-primary">Default</span>' : '',
                'actions' => $this->safeRenderView('admin.currencies._dt_actions', compact('c')),
            ];
        })->all();
        return response()->json(['draw'=>$draw,'recordsTotal'=>$recordsTotal,'recordsFiltered'=>$recordsFiltered,'data'=>$data]);
    }

    protected function resourceAdmin(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\Admin::query()->with('roles');
        $recordsTotal = (clone $query)->count();
        if ($search !== '') { $query->where(function($q) use($search){ $q->where('name','like',"%{$search}%")->orWhere('email','like',"%{$search}%"); }); }
        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['id','name','email']);
        if ($order) { foreach ($order as [$c,$d]) { $query->orderBy($c,$d); } } else { $query->latest('id'); }
        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function($a){
            $roles = $a->roles->map(fn($r) => '<span class="badge text-bg-secondary">' . e($r->name) . '</span>')->implode(' ');
            return [
                'id' => $a->id,
                'name' => e($a->name),
                'email' => e($a->email),
                'roles' => $roles,
                'actions' => $this->safeRenderView('admin.admins._dt_actions', compact('a')),
            ];
        })->all();
        return response()->json(['draw'=>$draw,'recordsTotal'=>$recordsTotal,'recordsFiltered'=>$recordsFiltered,'data'=>$data]);
    }

    protected function resourcePage(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\Page::query();
        $recordsTotal = (clone $query)->count();

        if ($request->filled('is_active')) {
            $query->where('is_active', (int) $request->input('is_active'));
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $recordsFiltered = (clone $query)->count();

        $order = $this->extractOrdering($request, ['title', 'slug', 'is_active', 'sort_order']);
        if ($order) {
            foreach ($order as [$col, $dir]) {
                $query->orderBy($col, $dir);
            }
        } else {
            $query->orderBy('sort_order', 'asc')->orderBy('title', 'asc');
        }

        $items = $query->skip($start)->take($length)->get();
        $data = $items->map(function ($p) {
            return [
                'title' => e($p->title),
                'slug' => '<code class="bg-light px-2 py-1 rounded">' . e($p->slug) . '</code>',
                'is_active' => $p->is_active ? '<span class="badge text-bg-success">Active</span>' : '<span class="badge text-bg-secondary">Inactive</span>',
                'sort_order' => (int) $p->sort_order,
                'actions' => $this->safeRenderView('admin.pages._dt_actions', compact('p')),
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    protected function resourceReview(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\ProductReview::query()->with(['product', 'user', 'order']);
        $recordsTotal = (clone $query)->count();

        if ($request->filled('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('comment', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhereHas('product', function ($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['product', 'user', 'rating', 'review', 'status', 'created_at']);
        if ($order) {
            foreach ($order as [$col, $dir]) {
                if ($col === 'product') {
                    $query->leftJoin('products', 'products.id', '=', 'product_reviews.product_id');
                    $query->orderBy('products.name', $dir);
                } elseif ($col === 'user') {
                    $query->leftJoin('users', 'users.id', '=', 'product_reviews.user_id');
                    $query->orderBy('users.name', $dir);
                } elseif ($col === 'review') {
                    $query->orderBy('product_reviews.title', $dir);
                } else {
                    $query->orderBy('product_reviews.' . $col, $dir);
                }
            }
        } else {
            $query->latest('product_reviews.id');
        }

        $items = $query->select('product_reviews.*')->skip($start)->take($length)->get();
        $data = $items->map(function ($r) {
            $stars = '';
            for ($i = 1; $i <= 5; $i++) {
                $stars .= '<i class="bi bi-star' . ($i <= $r->rating ? '-fill text-warning' : '') . '"></i>';
            }
            $stars .= '<span class="ms-1">(' . $r->rating . ')</span>';

            $reviewText = '';
            if ($r->title) {
                $reviewText .= '<strong>' . e($r->title) . '</strong><br>';
            }
            $reviewText .= '<small class="text-muted">' . e(\Str::limit($r->comment, 100)) . '</small>';

            $statusBadge = $r->is_approved 
                ? '<span class="badge text-bg-success">Approved</span>' 
                : '<span class="badge text-bg-warning text-dark">Pending</span>';

            $userName = $r->user ? e($r->user->name) : 'Anonymous';
            if ($r->is_verified_purchase) {
                $userName .= ' <span class="badge text-bg-success ms-1" title="Verified Purchase"><i class="bi bi-check-circle"></i></span>';
            }

            $actions = '<div class="btn-group btn-group-sm">';
            if (!$r->is_approved) {
                $actions .= '<form action="' . route('admin.reviews.approve', $r) . '" method="POST" class="d-inline">';
                $actions .= csrf_field();
                $actions .= '<button type="submit" class="btn btn-success" title="Approve"><i class="bi bi-check"></i></button>';
                $actions .= '</form>';
            } else {
                $actions .= '<form action="' . route('admin.reviews.reject', $r) . '" method="POST" class="d-inline">';
                $actions .= csrf_field();
                $actions .= '<button type="submit" class="btn btn-warning" title="Reject"><i class="bi bi-x"></i></button>';
                $actions .= '</form>';
            }
            $actions .= '<form action="' . route('admin.reviews.destroy', $r) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Delete this review?\')">';
            $actions .= csrf_field();
            $actions .= method_field('DELETE');
            $actions .= '<button type="submit" class="btn btn-danger" title="Delete"><i class="bi bi-trash"></i></button>';
            $actions .= '</form>';
            $actions .= '</div>';

            return [
                'product' => $r->product 
                    ? '<a href="' . route('products.show', $r->product->slug) . '" target="_blank">' . e($r->product->name) . '</a>'
                    : '-',
                'user' => $userName,
                'rating' => $stars,
                'review' => $reviewText,
                'status' => $statusBadge,
                'created_at' => \App\Support\DateHelper::format($r->created_at),
                'actions' => $actions,
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    protected function resourceCart(Request $request, int $draw, int $start, int $length, string $search)
    {
        $ids = \DB::table('cart_items')
            ->join('carts', 'cart_items.cart_id', '=', 'carts.id')
            ->whereNotNull('carts.user_id')
            ->select(\DB::raw('MAX(cart_items.id) as id'))
            ->groupBy('carts.user_id', 'cart_items.product_id')
            ->pluck('id');

        $query = \App\Models\CartItem::query()->with(['product', 'cart.user'])->whereIn('id', $ids);
        $recordsTotal = (clone $query)->count();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->whereHas('product', function ($pq) use ($search) {
                    $pq->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('cart.user', function ($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }

        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['user', 'email', 'phone', 'product', 'quantity', 'created_at']);
        if ($order) {
            foreach ($order as [$col, $dir]) {
                if ($col === 'user' || $col === 'email' || $col === 'phone') {
                    $query->leftJoin('carts', 'carts.id', '=', 'cart_items.cart_id')
                          ->leftJoin('users', 'users.id', '=', 'carts.user_id');
                    $query->orderBy('users.' . $col, $dir);
                } elseif ($col === 'product') {
                    $query->leftJoin('products', 'products.id', '=', 'cart_items.product_id');
                    $query->orderBy('products.name', $dir);
                } else {
                    $query->orderBy('cart_items.' . $col, $dir);
                }
            }
        } else {
            $query->orderByDesc('cart_items.created_at');
        }

        $items = $query->select('cart_items.*')->skip($start)->take($length)->get();
        $data = $items->map(function ($item) {
            $user = optional($item->cart->user);
            $userName = $user->name ?? '—';
            if (empty($user->email) && empty($user->phone)) {
                $userName .= ' <span class="badge text-bg-secondary ms-1">Guest</span>';
            }

            return [
                'user' => $userName,
                'email' => $user->email ?? '—',
                'phone' => $user->phone ?? '—',
                'product' => $item->product 
                    ? '<a href="' . route('products.show', $item->product->slug) . '" target="_blank">' . e($item->product->name) . '</a>'
                    : '<span class="text-muted">(deleted product)</span>',
                'quantity' => (int) $item->quantity,
                'created_at' => \App\Support\DateHelper::format($item->created_at),
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    protected function resourceWishlist(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\Wishlist::query()->with(['product', 'user']);
        $recordsTotal = (clone $query)->count();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->whereHas('product', function ($pq) use ($search) {
                    $pq->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }

        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['user', 'email', 'phone', 'product', 'created_at']);
        if ($order) {
            foreach ($order as [$col, $dir]) {
                if ($col === 'user' || $col === 'email' || $col === 'phone') {
                    $query->leftJoin('users', 'users.id', '=', 'wishlists.user_id');
                    $query->orderBy('users.' . $col, $dir);
                } elseif ($col === 'product') {
                    $query->leftJoin('products', 'products.id', '=', 'wishlists.product_id');
                    $query->orderBy('products.name', $dir);
                } else {
                    $query->orderBy('wishlists.' . $col, $dir);
                }
            }
        } else {
            $query->orderByDesc('wishlists.created_at');
        }

        $items = $query->select('wishlists.*')->skip($start)->take($length)->get();
        $data = $items->map(function ($it) {
            $user = optional($it->user);
            $userName = $user->name ?? '—';
            if (empty($user->email) && empty($user->phone)) {
                $userName .= ' <span class="badge text-bg-secondary ms-1">Guest</span>';
            }

            return [
                'user' => $userName,
                'email' => $user->email ?? '—',
                'phone' => $user->phone ?? '—',
                'product' => $it->product 
                    ? '<a href="' . route('products.show', $it->product->slug) . '" target="_blank">' . e($it->product->name) . '</a>'
                    : '<span class="text-muted">(deleted product)</span>',
                'created_at' => \App\Support\DateHelper::format($it->created_at),
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    protected function resourceGuestWishlist(Request $request, int $draw, int $start, int $length, string $search)
    {
        $guestIds = \DB::table('guest_wishlists')
            ->select(\DB::raw('MAX(id) as id'))
            ->groupBy('session_id', 'product_id')
            ->pluck('id');

        $query = \App\Models\GuestWishlist::query()->with(['product'])->whereIn('id', $guestIds);
        $recordsTotal = (clone $query)->count();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('session_id', 'like', "%{$search}%")
                  ->orWhereHas('product', function ($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['user', 'email', 'phone', 'product', 'session', 'created_at']);
        if ($order) {
            foreach ($order as [$col, $dir]) {
                if ($col === 'product') {
                    $query->leftJoin('products', 'products.id', '=', 'guest_wishlists.product_id');
                    $query->orderBy('products.name', $dir);
                } else {
                    $query->orderBy('guest_wishlists.' . $col, $dir);
                }
            }
        } else {
            $query->orderByDesc('guest_wishlists.created_at');
        }

        $items = $query->select('guest_wishlists.*')->skip($start)->take($length)->get();
        $data = $items->map(function ($g) {
            return [
                'user' => '<span class="badge text-bg-secondary">Guest</span>',
                'email' => '<span class="badge text-bg-secondary">Guest</span>',
                'phone' => '<span class="badge text-bg-secondary">Guest</span>',
                'product' => $g->product 
                    ? '<a href="' . route('products.show', $g->product->slug) . '" target="_blank">' . e($g->product->name) . '</a>'
                    : '<span class="text-muted">(deleted product)</span>',
                'session' => '<code class="small text-muted">' . e($g->session_id) . '</code>',
                'created_at' => \App\Support\DateHelper::format($g->created_at),
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    protected function resourceSession(Request $request, int $draw, int $start, int $length, string $search)
    {
        $query = \App\Models\SessionEntry::query()->with('user');
        $recordsTotal = (clone $query)->count();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('user_agent', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $recordsFiltered = (clone $query)->count();
        $order = $this->extractOrdering($request, ['user', 'email', 'phone', 'ip_address', 'user_agent', 'last_activity', 'id']);
        if ($order) {
            foreach ($order as [$col, $dir]) {
                if ($col === 'user' || $col === 'email' || $col === 'phone') {
                    $query->leftJoin('users', 'users.id', '=', 'sessions.user_id');
                    $query->orderBy('users.' . $col, $dir);
                } else {
                    $query->orderBy('sessions.' . $col, $dir);
                }
            }
        } else {
            $query->orderByDesc('sessions.last_activity');
        }

        $items = $query->select('sessions.*')->skip($start)->take($length)->get();
        $data = $items->map(function ($s) {
            $u = optional($s->user);
            $userName = $u->name ?? '—';
            if (!$s->user_id) {
                $userName .= ' <span class="badge text-bg-secondary ms-1">Guest</span>';
            }

            $actions = '<form action="' . route('admin.activities.sessions.destroy', $s->id) . '" method="post" onsubmit="return confirm(\'Destroy this session?\')" class="d-inline">';
            $actions .= csrf_field();
            $actions .= method_field('DELETE');
            $actions .= '<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>';
            $actions .= '</form>';

            return [
                'user' => $userName,
                'email' => $u->email ?? '—',
                'phone' => $u->phone ?? '—',
                'ip_address' => '<code>' . e($s->ip_address ?? '—') . '</code>',
                'user_agent' => '<span class="small" title="' . e($s->user_agent) . '">' . e(\Str::limit($s->user_agent, 60)) . '</span>',
                'last_activity' => \Carbon\Carbon::createFromTimestamp($s->last_activity)->format('Y-m-d H:i'),
                'id' => '<code class="small">' . e($s->id) . '</code>',
                'actions' => $actions,
            ];
        })->all();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ]);
    }

    /**
     * Extract ordering from DataTables request.
     * @return array<int, array{0:string,1:string}>
     */
    protected function extractOrdering(Request $request, array $columns): array
    {
        $orders = [];
        foreach ((array) $request->input('order', []) as $order) {
            $idx = (int) data_get($order, 'column', 0);
            $dir = data_get($order, 'dir', 'asc') === 'desc' ? 'desc' : 'asc';
            $col = $columns[$idx] ?? null;
            if ($col) { $orders[] = [$col, $dir]; }
        }
        return $orders;
    }

    /**
     * Safely render a view, returning empty string on error
     */
    protected function safeRenderView(string $view, array $data = []): string
    {
        try {
            return view($view, $data)->render();
        } catch (\Exception $e) {
            Log::error('View render error: ' . $e->getMessage(), ['view' => $view]);
            return '';
        }
    }
}


