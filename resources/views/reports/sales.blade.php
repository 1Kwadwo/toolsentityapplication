<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center">
                <div class="w-3 h-3 bg-gradient-to-r from-green-500 to-green-600 rounded-full mr-3"></div>
                {{ __('Sales Reports') }}
            </h2>
            <a href="{{ route('reports.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">
                ← Back to Reports
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Date Filter -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20 mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter by Date Range</h3>
                    <form method="GET" class="flex flex-wrap gap-4 items-end">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" 
                                   class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-xl shadow-lg bg-white/80 backdrop-blur-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" 
                                   class="border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-xl shadow-lg bg-white/80 backdrop-blur-sm">
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-200">
                            Filter
                        </button>
                    </form>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
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
                                <p class="text-sm font-medium text-green-100">Total Sales</p>
                                <p class="text-2xl font-bold text-white">${{ number_format($totalSales, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

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
                                <p class="text-sm font-medium text-blue-100">Items Sold</p>
                                <p class="text-2xl font-bold text-white">{{ $totalItems }}</p>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-purple-100">Average Sale</p>
                                <p class="text-2xl font-bold text-white">${{ number_format($averageSale, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Sales by Payment Method -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            Sales by Payment Method
                        </h3>
                        @if($salesByPayment->count() > 0)
                            <div class="space-y-3">
                                @foreach($salesByPayment as $method => $data)
                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl border border-green-200">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ ucfirst($method) }}</p>
                                            <p class="text-sm text-green-600">{{ $data['count'] }} transactions</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-green-600">${{ number_format($data['total'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No payment method data available</p>
                        @endif
                    </div>
                </div>

                <!-- Top Selling Tools -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                            Top Selling Tools
                        </h3>
                        @if($topSellingTools->count() > 0)
                            <div class="space-y-3">
                                @foreach($topSellingTools as $toolData)
                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $toolData['tool']->name }}</p>
                                            <p class="text-sm text-blue-600">{{ $toolData['quantity'] }} units sold</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-blue-600">${{ number_format($toolData['revenue'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No sales data available</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sales Details Table -->
            <div class="mt-8 bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                        Sales Details
                    </h3>
                    @if($sales->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-purple-50 to-purple-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Tool</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Payment</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 divide-y divide-gray-200">
                                    @foreach($sales as $sale)
                                        <tr class="hover:bg-purple-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $sale->created_at->format('M d, Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $sale->tool->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $sale->customer->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $sale->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">${{ number_format($sale->final_amount, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300">
                                                    {{ ucfirst($sale->payment_method) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No sales found for the selected date range</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
