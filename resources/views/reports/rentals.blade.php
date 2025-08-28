<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center">
                <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full mr-3"></div>
                {{ __('Rental Reports') }}
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
                                   class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-lg bg-white/80 backdrop-blur-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" 
                                   class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-lg bg-white/80 backdrop-blur-sm">
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-200">
                            Filter
                        </button>
                    </form>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
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
                                <p class="text-sm font-medium text-blue-100">Total Revenue</p>
                                <p class="text-2xl font-bold text-white">${{ number_format($totalRevenue, 2) }}</p>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-green-100">Active Rentals</p>
                                <p class="text-2xl font-bold text-white">{{ $activeRentals }}</p>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-purple-100">Returned</p>
                                <p class="text-2xl font-bold text-white">{{ $returnedRentals }}</p>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-red-100">Overdue</p>
                                <p class="text-2xl font-bold text-white">{{ $overdueRentals }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rental Revenue by Tool -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20 mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                        Rental Revenue by Tool
                    </h3>
                    @if($rentalRevenueByTool->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($rentalRevenueByTool as $toolData)
                                <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-blue-200 hover:shadow-lg transition-all duration-200">
                                    <h4 class="font-semibold text-gray-800">{{ $toolData['tool']->name }}</h4>
                                    <p class="text-sm text-blue-600 font-medium">{{ $toolData['rentals'] }} rentals</p>
                                    <p class="text-sm font-bold text-blue-600">${{ number_format($toolData['revenue'], 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No rental data available</p>
                    @endif
                </div>
            </div>

            <!-- Rental Details Table -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                        Rental Details
                    </h3>
                    @if($rentals->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-purple-50 to-purple-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Rental Date</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Tool</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Due Date</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Fee</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-purple-800 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 divide-y divide-gray-200">
                                    @foreach($rentals as $rental)
                                        <tr class="hover:bg-purple-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $rental->rental_date->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $rental->tool->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $rental->customer->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $rental->due_date->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600">${{ number_format($rental->total_fee, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($rental->status === 'active')
                                                    @if($rental->due_date < now())
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-300">
                                                            Overdue
                                                        </span>
                                                    @else
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                            Active
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300">
                                                        Returned
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No rentals found for the selected date range</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
