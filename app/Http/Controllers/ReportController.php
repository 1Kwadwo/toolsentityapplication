<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Rental;
use App\Models\Tool;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function sales(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        $sales = Sale::with(['tool', 'customer', 'user'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSales = $sales->sum('final_amount');
        $totalItems = $sales->sum('quantity');
        $averageSale = $sales->count() > 0 ? $totalSales / $sales->count() : 0;

        // Sales by payment method
        $salesByPayment = $sales->groupBy('payment_method')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'total' => $group->sum('final_amount')
                ];
            });

        // Top selling tools
        $topSellingTools = $sales->groupBy('tool_id')
            ->map(function ($group) {
                return [
                    'tool' => $group->first()->tool,
                    'quantity' => $group->sum('quantity'),
                    'revenue' => $group->sum('final_amount')
                ];
            })
            ->sortByDesc('revenue')
            ->take(10);

        return view('reports.sales', compact(
            'sales',
            'totalSales',
            'totalItems',
            'averageSale',
            'salesByPayment',
            'topSellingTools',
            'startDate',
            'endDate'
        ));
    }

    public function rentals(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        $rentals = Rental::with(['tool', 'customer', 'user'])
            ->whereBetween('rental_date', [$startDate, $endDate])
            ->orderBy('rental_date', 'desc')
            ->get();

        $totalRevenue = $rentals->sum('total_fee');
        $activeRentals = $rentals->where('status', 'active')->count();
        $returnedRentals = $rentals->where('status', 'returned')->count();
        $overdueRentals = $rentals->where('status', 'active')
            ->where('due_date', '<', Carbon::today())
            ->count();

        // Rental revenue by tool
        $rentalRevenueByTool = $rentals->groupBy('tool_id')
            ->map(function ($group) {
                return [
                    'tool' => $group->first()->tool,
                    'rentals' => $group->count(),
                    'revenue' => $group->sum('total_fee')
                ];
            })
            ->sortByDesc('revenue')
            ->take(10);

        return view('reports.rentals', compact(
            'rentals',
            'totalRevenue',
            'activeRentals',
            'returnedRentals',
            'overdueRentals',
            'rentalRevenueByTool',
            'startDate',
            'endDate'
        ));
    }

    public function inventory()
    {
        $tools = Tool::with('supplier')
            ->orderBy('stock_quantity')
            ->get();

        $lowStockTools = $tools->where('stock_quantity', '<=', 'min_stock_level');
        $outOfStockTools = $tools->where('stock_quantity', 0);
        $totalValue = $tools->sum(function ($tool) {
            return $tool->stock_quantity * $tool->purchase_price;
        });

        // Tools by category
        $toolsByCategory = $tools->groupBy('category')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'total_stock' => $group->sum('stock_quantity'),
                    'total_value' => $group->sum(function ($tool) {
                        return $tool->stock_quantity * $tool->purchase_price;
                    })
                ];
            });

        return view('reports.inventory', compact(
            'tools',
            'lowStockTools',
            'outOfStockTools',
            'totalValue',
            'toolsByCategory'
        ));
    }

    public function customers()
    {
        $customers = Customer::withCount(['sales', 'rentals'])
            ->withSum('sales', 'final_amount')
            ->orderBy('sales_count', 'desc')
            ->get();

        $totalCustomers = $customers->count();
        $activeCustomers = $customers->where('sales_count', '>', 0)->count();
        $totalRevenue = $customers->sum('sales_final_amount_sum');

        // Top customers by revenue
        $topCustomers = $customers->where('sales_final_amount_sum', '>', 0)
            ->sortByDesc('sales_final_amount_sum')
            ->take(10);

        return view('reports.customers', compact(
            'customers',
            'totalCustomers',
            'activeCustomers',
            'totalRevenue',
            'topCustomers'
        ));
    }

    public function analytics()
    {
        // Monthly sales for the last 12 months
        $monthlySales = Sale::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(final_amount) as total')
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Monthly rental revenue for the last 12 months
        $monthlyRentals = Rental::selectRaw('MONTH(rental_date) as month, YEAR(rental_date) as year, SUM(total_fee) as total')
            ->where('rental_date', '>=', Carbon::now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Top performing tools
        $topSellingTools = Tool::withCount('sales')
            ->withSum('sales', 'final_amount')
            ->orderBy('sales_count', 'desc')
            ->take(10)
            ->get();

        $topRentalTools = Tool::withCount('rentals')
            ->withSum('rentals', 'total_fee')
            ->orderBy('rentals_count', 'desc')
            ->take(10)
            ->get();

        return view('reports.analytics', compact(
            'monthlySales',
            'monthlyRentals',
            'topSellingTools',
            'topRentalTools'
        ));
    }
}
