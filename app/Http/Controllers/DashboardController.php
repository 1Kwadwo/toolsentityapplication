<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Sale;
use App\Models\Rental;
use App\Models\Customer;
use App\Models\Supplier;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get quick stats
        $stats = [
            'total_tools' => Tool::count(),
            'low_stock_tools' => Tool::where('stock_quantity', '<=', 'min_stock_level')->count(),
            'total_sales_today' => Sale::whereDate('created_at', Carbon::today())->sum('final_amount'),
            'active_rentals' => Rental::where('status', 'active')->count(),
            'overdue_rentals' => Rental::where('status', 'active')
                ->where('due_date', '<', Carbon::today())
                ->count(),
            'total_customers' => Customer::count(),
            'total_suppliers' => Supplier::count(),
        ];

        // Get low stock alerts
        $lowStockTools = Tool::where('stock_quantity', '<=', 'min_stock_level')
            ->with('supplier')
            ->get();

        // Get recent sales
        $recentSales = Sale::with(['tool', 'customer', 'user'])
            ->latest()
            ->take(5)
            ->get();

        // Get overdue rentals
        $overdueRentals = Rental::where('status', 'active')
            ->where('due_date', '<', Carbon::today())
            ->with(['tool', 'customer'])
            ->get();

        // Get top selling tools
        $topSellingTools = Tool::withCount('sales')
            ->orderBy('sales_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'stats',
            'lowStockTools',
            'recentSales',
            'overdueRentals',
            'topSellingTools'
        ));
    }
}
