<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
	public function index(Request $request)
	{
		// Get date filters from request - if not provided, show all data
		$hasDateFilter = $request->has('date_from') || $request->has('date_to');
		
		if ($hasDateFilter) {
			$dateFrom = $request->input('date_from', now()->subDays(14)->format('Y-m-d'));
			$dateTo = $request->input('date_to', now()->format('Y-m-d'));
			
			// Parse dates
			$fromDate = \Carbon\Carbon::parse($dateFrom)->startOfDay();
			$toDate = \Carbon\Carbon::parse($dateTo)->endOfDay();
			
			// Base query for filtered orders
			$filteredOrdersQuery = Order::whereBetween('created_at', [$fromDate, $toDate]);
		} else {
			// No filter - show all data
			$dateFrom = null;
			$dateTo = null;
			$fromDate = null;
			$toDate = null;
			
			// Base query for all orders
			$filteredOrdersQuery = Order::query();
		}
		
		// Overall Statistics (all time - not filtered)
		$stats = [
			'total_orders' => Order::count(),
			'total_products' => Product::count(),
			'total_categories' => Category::count(),
			'total_customers' => User::count(),
			'total_revenue' => (float) Order::sum('grand_total'),
		];

		// Filtered Statistics (based on date range)
		$filteredStats = [
			'orders' => (clone $filteredOrdersQuery)->count(),
			'revenue' => (float) (clone $filteredOrdersQuery)->sum('grand_total'),
		];

		// Today's Statistics
		$todayStats = [
			'orders' => Order::whereDate('created_at', today())->count(),
			'revenue' => (float) Order::whereDate('created_at', today())->sum('grand_total'),
		];

		// This Month Statistics
		$monthStart = now()->startOfMonth();
		$monthStats = [
			'orders' => Order::where('created_at', '>=', $monthStart)->count(),
			'revenue' => (float) Order::where('created_at', '>=', $monthStart)->sum('grand_total'),
		];

		// Last Month Statistics (for comparison)
		$lastMonthStart = now()->subMonth()->startOfMonth();
		$lastMonthEnd = now()->subMonth()->endOfMonth();
		$lastMonthStats = [
			'orders' => Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count(),
			'revenue' => (float) Order::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('grand_total'),
		];

		// Order Status Breakdown (filtered)
		$orderStatusBreakdown = (clone $filteredOrdersQuery)
			->select('status', DB::raw('count(*) as count'))
			->groupBy('status')
			->get()
			->pluck('count', 'status')
			->toArray();

		// Pending Orders Count (filtered)
		$pendingOrders = (clone $filteredOrdersQuery)->where('status', 'pending')->count();

		// Sales Chart Data (based on date range or last 30 days if no filter)
		if ($hasDateFilter) {
			$series = (clone $filteredOrdersQuery)
				->selectRaw('DATE(created_at) as d, COUNT(*) as orders, SUM(grand_total) as revenue')
				->groupBy('d')
				->orderBy('d')
				->get();
			
			$labels = [];
			$ordersSeries = [];
			$revenueSeries = [];
			$cursor = (clone $fromDate)->startOfDay();
			$map = $series->keyBy('d');
			
			while ($cursor->lte($toDate)) {
				$key = $cursor->toDateString();
				$labels[] = $cursor->format('M d');
				$ordersSeries[] = (int) ($map[$key]->orders ?? 0);
				$revenueSeries[] = (float) ($map[$key]->revenue ?? 0);
				$cursor->addDay();
			}
		} else {
			// Show last 30 days by default for chart (even when showing all data)
			$chartFromDate = now()->subDays(30)->startOfDay();
			$chartToDate = now()->endOfDay();
			
			$series = Order::whereBetween('created_at', [$chartFromDate, $chartToDate])
				->selectRaw('DATE(created_at) as d, COUNT(*) as orders, SUM(grand_total) as revenue')
				->groupBy('d')
				->orderBy('d')
				->get();
			
			$labels = [];
			$ordersSeries = [];
			$revenueSeries = [];
			$cursor = (clone $chartFromDate)->startOfDay();
			$map = $series->keyBy('d');
			
			while ($cursor->lte($chartToDate)) {
				$key = $cursor->toDateString();
				$labels[] = $cursor->format('M d');
				$ordersSeries[] = (int) ($map[$key]->orders ?? 0);
				$revenueSeries[] = (float) ($map[$key]->revenue ?? 0);
				$cursor->addDay();
			}
		}

		// Recent Orders (filtered, with relationships)
		$recentOrders = (clone $filteredOrdersQuery)
			->with('user')
			->latest()
			->take(10)
			->get();

		// Low Stock Products (not filtered by date)
		$lowStock = Product::where('stock', '<=', 5)->orderBy('stock')->take(10)->get();

		// Top Selling Products (filtered by date range or all time)
		$topProductsQuery = DB::table('order_items')
			->join('orders', 'order_items.order_id', '=', 'orders.id')
			->join('products', 'order_items.product_id', '=', 'products.id');
		
		if ($hasDateFilter) {
			$topProductsQuery->whereBetween('orders.created_at', [$fromDate, $toDate]);
		}
		
		$topProducts = $topProductsQuery
			->select('products.id', 'products.name', 'products.price', DB::raw('SUM(order_items.quantity) as total_sold'), DB::raw('SUM(order_items.line_total) as total_revenue'))
			->groupBy('products.id', 'products.name', 'products.price')
			->orderByDesc('total_sold')
			->take(5)
			->get();

		// Revenue Growth Calculation (for filtered period vs previous period)
		$revenueGrowth = 0;
		$ordersGrowth = 0;
		
		if ($hasDateFilter) {
			$daysDiff = $fromDate->diffInDays($toDate);
			$previousFromDate = (clone $fromDate)->subDays($daysDiff + 1);
			$previousToDate = (clone $fromDate)->subDay()->endOfDay();
			
			$previousPeriodStats = [
				'orders' => Order::whereBetween('created_at', [$previousFromDate, $previousToDate])->count(),
				'revenue' => (float) Order::whereBetween('created_at', [$previousFromDate, $previousToDate])->sum('grand_total'),
			];
			
			if ($previousPeriodStats['revenue'] > 0) {
				$revenueGrowth = (($filteredStats['revenue'] - $previousPeriodStats['revenue']) / $previousPeriodStats['revenue']) * 100;
			}

			// Orders Growth Calculation
			if ($previousPeriodStats['orders'] > 0) {
				$ordersGrowth = (($filteredStats['orders'] - $previousPeriodStats['orders']) / $previousPeriodStats['orders']) * 100;
			}
		}

		return view('admin.dashboard', compact(
			'stats',
			'filteredStats',
			'todayStats',
			'monthStats',
			'lastMonthStats',
			'orderStatusBreakdown',
			'pendingOrders',
			'labels',
			'ordersSeries',
			'revenueSeries',
			'recentOrders',
			'lowStock',
			'topProducts',
			'revenueGrowth',
			'ordersGrowth',
			'dateFrom',
			'dateTo'
		));
	}
}
