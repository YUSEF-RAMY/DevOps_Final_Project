<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $settings = SiteSetting::get();
        
        // Check if reviews are enabled
        if (!$settings->reviews_enabled) {
            $error = 'Reviews are currently disabled.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $error], 422);
            }
            return back()->with('error', $error);
        }

        // Check if user is authenticated (unless anonymous reviews are allowed)
        if (!$settings->reviews_allow_anonymous && !Auth::check()) {
            $error = 'Please login to submit a review.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $error], 401);
            }
            return back()->with('error', $error);
        }

        // If purchase is required, verify user has purchased the product
        if ($settings->reviews_require_purchase) {
            if (!Auth::check()) {
                $error = 'You must be logged in and have purchased this product to review it.';
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $error], 403);
                }
                return back()->with('error', $error);
            }
            
            $hasPurchased = ProductReview::hasPurchasedProduct(Auth::id(), $product->id);
            if (!$hasPurchased) {
                $error = 'You must purchase this product before you can review it.';
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $error], 403);
                }
                return back()->with('error', $error);
            }
        }

        // Check if user already reviewed this product (only for authenticated users)
        if (Auth::check()) {
            $existingReview = ProductReview::where('product_id', $product->id)
                ->where('user_id', Auth::id())
                ->first();
            
            if ($existingReview) {
                $error = 'You have already reviewed this product.';
                if ($request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $error], 422);
                }
                return back()->with('error', $error);
            }
        }

        try {
            $validated = $request->validate([
                'rating' => ['required', 'integer', 'min:1', 'max:5'],
                'title' => ['nullable', 'string', 'max:255'],
                'comment' => ['required', 'string', 'min:10', 'max:1000'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            return back()->withErrors($e->errors())->withInput();
        }

        // Check if user has purchased (for verified purchase badge)
        $isVerifiedPurchase = false;
        if (Auth::check()) {
            $isVerifiedPurchase = ProductReview::hasPurchasedProduct(Auth::id(), $product->id);
        }

        $review = ProductReview::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(), // Can be null if anonymous reviews are allowed
            'rating' => $validated['rating'],
            'title' => $validated['title'] ?? null,
            'comment' => $validated['comment'],
            'is_approved' => !$settings->reviews_require_approval, // Auto-approve if approval not required
            'is_verified_purchase' => $isVerifiedPurchase,
        ]);

        // Reload product to get updated stats
        $product->load('approvedReviews.user');
        
        $message = $settings->reviews_require_approval 
            ? 'Thank you for your review! It will be published after approval.'
            : 'Thank you for your review!';

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'review' => [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'title' => $review->title,
                    'comment' => $review->comment,
                    'user_name' => $review->user ? $review->user->name : 'Anonymous',
                    'is_verified_purchase' => $review->is_verified_purchase,
                    'created_at' => \App\Support\DateHelper::format($review->created_at),
                    'is_approved' => $review->is_approved,
                ],
                'stats' => [
                    'total_reviews' => $product->total_reviews,
                    'average_rating' => round($product->average_rating, 1),
                ]
            ]);
        }

        return back()->with('success', $message);
    }

    public function destroy(ProductReview $review)
    {
        // Only allow user to delete their own review
        if (Auth::check() && $review->user_id === Auth::id()) {
            $review->delete();
            return back()->with('success', 'Review deleted successfully.');
        }

        return back()->with('error', 'Unauthorized action.');
    }
}
