@php
$breadcrumbs = null;

try {
    $routeName = Route::currentRouteName();
    
    if (!$routeName) {
        $breadcrumbs = [['label' => 'Admin', 'url' => null]];
    } else {
        $labelMap = [
            'categories' => 'Categories',
            'products' => 'Products',
            'orders' => 'Orders',
            'users' => 'Users',
            'media' => 'Media Library',
            'roles' => 'Roles',
            'permissions' => 'Permissions',
            'coupons' => 'Coupons',
            'newsletter' => 'Newsletter',
            'currencies' => 'Currencies',
            'admins' => 'Administrators',
            'email-settings' => 'Email Settings',
            'site-settings' => 'Site Settings',
            'shipping-settings' => 'Shipping Settings',
            'otp-settings' => 'OTP Settings',
            'coin-settings' => 'Coin Settings',
            'payment-gateways' => 'Payment Gateways',
            'activities' => 'Activities',
        ];
        
        if ($routeName === 'admin.dashboard') {
            $breadcrumbs = [['label' => 'Dashboard', 'url' => null]];
        } elseif (str_starts_with($routeName, 'admin.')) {
            $parts = explode('.', str_replace('admin.', '', $routeName));
            try {
                $breadcrumbs = [['label' => 'Dashboard', 'url' => route('admin.dashboard')]];
            } catch (\Exception $e) {
                $breadcrumbs = [['label' => 'Dashboard', 'url' => null]];
            }
            
            $resource = null;
            $settingsFound = false;
            
            // Check for settings routes first
            foreach ($parts as $index => $part) {
                if ($part === 'settings' && isset($parts[$index - 1])) {
                    $settingType = $parts[$index - 1];
                    $fullSetting = $settingType . '-settings';
                    if (isset($labelMap[$fullSetting])) {
                        $breadcrumbs[] = ['label' => $labelMap[$fullSetting], 'url' => null];
                        $settingsFound = true;
                        break;
                    }
                }
            }
            
            // Check for activities routes
            if (!$settingsFound && in_array('activities', $parts)) {
                $activityIndex = array_search('activities', $parts);
                $activityType = $parts[$activityIndex + 1] ?? null;
                if ($activityType) {
                    $breadcrumbs[] = ['label' => 'Activities', 'url' => null];
                    $activityLabels = [
                        'carts' => 'Cart Activity',
                        'wishlists' => 'Wishlist Activity',
                        'sessions' => 'Login Activity',
                    ];
                    $breadcrumbs[] = ['label' => $activityLabels[$activityType] ?? ucfirst($activityType), 'url' => null];
                }
            } elseif (!$settingsFound) {
                // Find resource name
                foreach ($parts as $part) {
                    if (isset($labelMap[$part])) {
                        $resource = $part;
                        break;
                    }
                }
                
                // Handle resource routes
                if ($resource) {
                    try {
                        $indexRoute = route('admin.' . $resource . '.index');
                        $breadcrumbs[] = ['label' => $labelMap[$resource], 'url' => $indexRoute];
                    } catch (\Exception $e) {
                        $breadcrumbs[] = ['label' => $labelMap[$resource], 'url' => null];
                    }
                    
                    // Handle actions
                    if (in_array('create', $parts)) {
                        $breadcrumbs[] = ['label' => 'Create', 'url' => null];
                    } elseif (in_array('edit', $parts)) {
                        $breadcrumbs[] = ['label' => 'Edit', 'url' => null];
                    } elseif (in_array('show', $parts)) {
                        $breadcrumbs[] = ['label' => 'View', 'url' => null];
                    } elseif (in_array('invoice', $parts)) {
                        $breadcrumbs[] = ['label' => 'Invoice', 'url' => null];
                    }
                }
            }
            
            // Special cases
            if ($routeName === 'admin.orders.create') {
                try {
                    $breadcrumbs = [
                        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                        ['label' => 'Orders', 'url' => route('admin.orders.index')],
                        ['label' => 'Create Order', 'url' => null]
                    ];
                } catch (\Exception $e) {
                    $breadcrumbs = [
                        ['label' => 'Dashboard', 'url' => null],
                        ['label' => 'Orders', 'url' => null],
                        ['label' => 'Create Order', 'url' => null]
                    ];
                }
            }
        }
    }
} catch (\Exception $e) {
    // Fallback to simple breadcrumb
    $breadcrumbs = [['label' => 'Admin', 'url' => null]];
}
@endphp

@if(!empty($breadcrumbs))
<div class="content-header mb-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h4 m-0">@yield('page_title', end($breadcrumbs)['label'] ?? 'Admin')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    @foreach($breadcrumbs as $crumb)
                        @if(isset($crumb['url']) && $crumb['url'] && !$loop->last)
                            <li class="breadcrumb-item"><a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a></li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">{{ $crumb['label'] }}</li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
@endif

