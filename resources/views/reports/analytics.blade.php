<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center">
                <div class="w-3 h-3 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-full mr-3"></div>
                {{ __('Analytics') }}
            </h2>
            <a href="{{ route('reports.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">
                ← Back to Reports
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-white/20 rounded-xl">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-yellow-100">Business Analytics</p>
                                <p class="text-2xl font-bold text-white">Comprehensive</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-purple-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-white/20 rounded-xl">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-purple-100">Performance Metrics</p>
                                <p class="text-2xl font-bold text-white">Real-time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Top Selling Tools -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            Top Selling Tools
                        </h3>
                        @if($topSellingTools->count() > 0)
                            <div class="space-y-3">
                                @foreach($topSellingTools as $tool)
                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl border border-green-200">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $tool->name }}</p>
                                            <p class="text-sm text-green-600">{{ $tool->sales_count }} sales</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-green-600">${{ number_format($tool->sales_final_amount_sum ?? 0, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No sales data available</p>
                        @endif
                    </div>
                </div>

                <!-- Top Rental Tools -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                            Top Rental Tools
                        </h3>
                        @if($topRentalTools->count() > 0)
                            <div class="space-y-3">
                                @foreach($topRentalTools as $tool)
                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $tool->name }}</p>
                                            <p class="text-sm text-blue-600">{{ $tool->rentals_count }} rentals</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-blue-600">${{ number_format($tool->rentals_total_fee_sum ?? 0, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No rental data available</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Monthly Trends -->
            <div class="mt-8 bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                        Monthly Revenue Trends (Last 12 Months)
                    </h3>
                    
                    @if($monthlySales->count() > 0 || $monthlyRentals->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Sales Trends -->
                            <div>
                                <h4 class="text-md font-semibold text-gray-700 mb-3">Sales Revenue</h4>
                                <div class="space-y-2">
                                    @foreach($monthlySales as $sale)
                                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border border-green-200">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ \Carbon\Carbon::createFromDate($sale->year, $sale->month, 1)->format('M Y') }}
                                            </span>
                                            <span class="text-sm font-bold text-green-600">
                                                ${{ number_format($sale->total, 2) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Rental Trends -->
                            <div>
                                <h4 class="text-md font-semibold text-gray-700 mb-3">Rental Revenue</h4>
                                <div class="space-y-2">
                                    @foreach($monthlyRentals as $rental)
                                        <div class="flex items-center justify-between p-3 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border border-blue-200">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ \Carbon\Carbon::createFromDate($rental->year, $rental->month, 1)->format('M Y') }}
                                            </span>
                                            <span class="text-sm font-bold text-blue-600">
                                                ${{ number_format($rental->total, 2) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No trend data available</p>
                    @endif
                </div>
            </div>

            <!-- Business Insights -->
            <div class="mt-8 bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></div>
                        Business Insights
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Sales Performance -->
                        <div class="p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl border border-green-200">
                            <h4 class="font-semibold text-gray-800 mb-2">Sales Performance</h4>
                            <p class="text-sm text-green-600">
                                @if($monthlySales->count() > 0)
                                    Total sales revenue over the last 12 months: ${{ number_format($monthlySales->sum('total'), 2) }}
                                @else
                                    No sales data available
                                @endif
                            </p>
                        </div>

                        <!-- Rental Performance -->
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                            <h4 class="font-semibold text-gray-800 mb-2">Rental Performance</h4>
                            <p class="text-sm text-blue-600">
                                @if($monthlyRentals->count() > 0)
                                    Total rental revenue over the last 12 months: ${{ number_format($monthlyRentals->sum('total'), 2) }}
                                @else
                                    No rental data available
                                @endif
                            </p>
                        </div>

                        <!-- Tool Performance -->
                        <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl border border-purple-200">
                            <h4 class="font-semibold text-gray-800 mb-2">Tool Performance</h4>
                            <p class="text-sm text-purple-600">
                                @if($topSellingTools->count() > 0)
                                    {{ $topSellingTools->first()->name }} is the top performing tool
                                @else
                                    No tool performance data available
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
