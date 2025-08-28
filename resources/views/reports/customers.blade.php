<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center">
                <div class="w-3 h-3 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full mr-3"></div>
                {{ __('Customer Reports') }}
            </h2>
            <a href="{{ route('reports.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">
                ← Back to Reports
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 overflow-hidden shadow-xl rounded-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="p-3 bg-white/20 rounded-xl">
                                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-indigo-100">Total Customers</p>
                                <p class="text-2xl font-bold text-white">{{ $totalCustomers }}</p>
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
                                <p class="text-sm font-medium text-green-100">Active Customers</p>
                                <p class="text-2xl font-bold text-white">{{ $activeCustomers }}</p>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-purple-100">Total Revenue</p>
                                <p class="text-2xl font-bold text-white">${{ number_format($totalRevenue, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Customers -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20 mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></div>
                        Top Customers by Revenue
                    </h3>
                    @if($topCustomers->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($topCustomers as $customer)
                                <div class="p-4 bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-xl border border-indigo-200 hover:shadow-lg transition-all duration-200">
                                    <h4 class="font-semibold text-gray-800">{{ $customer->name }}</h4>
                                    <p class="text-sm text-indigo-600">{{ $customer->sales_count }} purchases</p>
                                    <p class="text-sm font-bold text-indigo-600">${{ number_format($customer->sales_final_amount_sum, 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No customer data available</p>
                    @endif
                </div>
            </div>

            <!-- Customer Details Table -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl rounded-2xl border border-white/20">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                        Customer Details
                    </h3>
                    @if($customers->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-green-50 to-green-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Phone</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Purchases</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Rentals</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Total Spent</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/50 divide-y divide-gray-200">
                                    @foreach($customers as $customer)
                                        <tr class="hover:bg-green-50 transition-colors duration-200">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $customer->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $customer->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $customer->phone }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $customer->sales_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $customer->rentals_count }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">${{ number_format($customer->sales_final_amount_sum ?? 0, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($customer->sales_count > 0)
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-300">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-300">
                                                        Inactive
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No customers found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
