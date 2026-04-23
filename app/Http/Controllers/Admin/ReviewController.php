<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductReview::with(['product', 'user', 'order'])
            ->latest();

        // Filter by approval status
        if ($request->has('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('comment', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhereHas('product', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $reviews = $query->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(ProductReview $review)
    {
        $review->update(['is_approved' => true]);
        return back()->with('success', 'Review approved successfully.');
    }

    public function reject(ProductReview $review)
    {
        $review->update(['is_approved' => false]);
        return back()->with('success', 'Review rejected.');
    }

    public function destroy(ProductReview $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully.');
    }
}
