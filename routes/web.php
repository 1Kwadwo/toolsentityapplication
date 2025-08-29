<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Health check route for debugging
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'app_name' => config('app.name'),
        'app_env' => config('app.env'),
        'database' => config('database.default'),
    ]);
});

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tools Management
    Route::resource('tools', ToolController::class);

    // Suppliers Management
    Route::resource('suppliers', SupplierController::class);

    // Customers Management
    Route::resource('customers', CustomerController::class);

    // Sales Management
    Route::resource('sales', SaleController::class);

    // Rentals Management
    Route::resource('rentals', RentalController::class);
    Route::patch('/rentals/{rental}/return', [RentalController::class, 'return'])->name('rentals.return');

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/sales', [ReportController::class, 'sales'])->name('sales');
        Route::get('/rentals', [ReportController::class, 'rentals'])->name('rentals');
        Route::get('/inventory', [ReportController::class, 'inventory'])->name('inventory');
        Route::get('/customers', [ReportController::class, 'customers'])->name('customers');
        Route::get('/analytics', [ReportController::class, 'analytics'])->name('analytics');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
