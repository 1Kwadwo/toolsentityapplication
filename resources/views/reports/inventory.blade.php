<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center">
                <div class="w-3 h-3 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full mr-3"></div>
                {{ __('Inventory Reports') }}
            </h2>
            <a href="{{ route('reports.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">
                ← Back to Reports
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
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
                                <p class="text-sm font-medium text-purple-100">Total Tools</p>
                                <p class="text-2xl font-bold text-white">{{ $tools->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

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
                                <p class="text-sm font-medium text-red-100">Low Stock</p>
                                <p class="text-2xl font-bold text-white">{{ $lowStockTools->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-white/20 rounded-xl">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-yellow-100">Out of Stock</p>
                                <p class="text-2xl font-bold text-white">{{ $outOfStockTools->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

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
                                <p class="text-sm font-medium text-green-100">Total Value</p>
                                <p class="text-2xl font-bold text-white">${{ number_format($totalValue, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Tools by Category -->
                <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                            Tools by Category
                        </h3>
                        @if($toolsByCategory->count() > 0)
                            <div class="space-y-3">
                                @foreach($toolsByCategory as $category => $data)
                                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl border border-purple-200">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $category }}</p>
                                            <p class="text-sm text-purple-600">{{ $data['count'] }} tools</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-purple-600">{{ $data['total_stock'] }} in stock</p>
                                            <p class="font-bold text-purple-600">${{ number_format($data['total_value'], 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No category data available</p>
                        @endif
                    </div>
                </div>

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
                                        <a href="{{ route('tools.edit', $tool) }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                            Update
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">No low stock alerts</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Inventory Details Table -->
            <div class="mt-8 bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        Inventory Details
                    </h3>
                    @if($tools->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-green-50 to-green-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Tool</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Category</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Stock</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Min Level</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Purchase Price</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Stock Value</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 divide-y divide-gray-200">
                                    @foreach($tools as $tool)
                                        <tr class="hover:bg-green-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $tool->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $tool->category }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $tool->stock_quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $tool->min_stock_level }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${{ number_format($tool->purchase_price, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">${{ number_format($tool->stock_quantity * $tool->purchase_price, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($tool->stock_quantity == 0)
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300">
                                                        Out of Stock
                                                    </span>
                                                @elseif($tool->stock_quantity <= $tool->min_stock_level)
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-300">
                                                        Low Stock
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                        In Stock
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No tools found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
