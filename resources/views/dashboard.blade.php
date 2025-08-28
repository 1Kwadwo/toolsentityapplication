<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center">
            <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mr-3"></div>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Tools -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-white/20 rounded-xl">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-blue-100">Total Tools</p>
                                <p class="text-2xl font-bold text-white">{{ $stats['total_tools'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Alerts -->
                <div class="bg-gradient-to-br from-red-500 to-red-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-white/20 rounded-xl">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-red-100">Low Stock Alerts</p>
                                <p class="text-2xl font-bold text-white">{{ $stats['low_stock_tools'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Sales -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-white/20 rounded-xl">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-green-100">Today's Sales</p>
                                <p class="text-2xl font-bold text-white">${{ number_format($stats['total_sales_today'], 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Overdue Rentals -->
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-white/20 rounded-xl">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-yellow-100">Overdue Rentals</p>
                                <p class="text-2xl font-bold text-white">{{ $stats['overdue_rentals'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Low Stock Alerts -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                            Low Stock Alerts
                        </h3>
                        @if($lowStockTools->count() > 0)
                            <div class="space-y-3">
                                @foreach($lowStockTools as $tool)
                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-red-50 to-red-100 rounded-xl border border-red-200">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $tool->name }}</p>
                                            <p class="text-sm text-red-600">Stock: {{ $tool->stock_quantity }} (Min: {{ $tool->min_stock_level }})</p>
                                        </div>
                                        <a href="{{ route('tools.edit', $tool) }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">Update</a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No low stock alerts</p>
                        @endif
                    </div>
                </div>

                <!-- Overdue Rentals -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                            Overdue Rentals
                        </h3>
                        @if($overdueRentals->count() > 0)
                            <div class="space-y-3">
                                @foreach($overdueRentals as $rental)
                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-xl border border-yellow-200">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $rental->tool->name }}</p>
                                            <p class="text-sm text-yellow-600">Due: {{ $rental->due_date->format('M d, Y') }}</p>
                                            <p class="text-sm text-yellow-600">Customer: {{ $rental->customer->name }}</p>
                                        </div>
                                        <a href="{{ route('rentals.show', $rental) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">View</a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No overdue rentals</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Sales -->
            <div class="mt-8 bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        Recent Sales
                    </h3>
                    @if($recentSales->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-green-50 to-green-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Tool</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 divide-y divide-gray-200">
                                    @foreach($recentSales as $sale)
                                        <tr class="hover:bg-green-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $sale->tool->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $sale->customer->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">${{ number_format($sale->final_amount, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sale->created_at->format('M d, Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No recent sales</p>
                    @endif
                </div>
            </div>

            <!-- Top Selling Tools -->
            <div class="mt-8 bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                        Top Selling Tools
                    </h3>
                    @if($topSellingTools->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($topSellingTools as $tool)
                                <div class="p-4 bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl hover:shadow-lg transition-all duration-200">
                                    <h4 class="font-semibold text-gray-800">{{ $tool->name }}</h4>
                                    <p class="text-sm text-purple-600 font-medium">{{ $tool->sales_count }} sales</p>
                                    <p class="text-sm text-gray-600">Stock: {{ $tool->stock_quantity }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No sales data available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
