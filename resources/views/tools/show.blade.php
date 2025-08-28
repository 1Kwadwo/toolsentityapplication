<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tool Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('tools.edit', $tool) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit Tool
                </a>
                <a href="{{ route('tools.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tool Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ $tool->name }}</h3>
                        @if($tool->isLowStock())
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Low Stock
                            </span>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Basic Information -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">Basic Information</h4>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Category</p>
                                <p class="text-sm text-gray-900">{{ $tool->category }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Description</p>
                                <p class="text-sm text-gray-900">{{ $tool->description ?? 'No description available' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Condition</p>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($tool->condition === 'new') bg-green-100 text-green-800
                                    @elseif($tool->condition === 'good') bg-blue-100 text-blue-800
                                    @elseif($tool->condition === 'fair') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($tool->condition) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Purchase Date</p>
                                <p class="text-sm text-gray-900">{{ $tool->purchase_date->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <!-- Stock Information -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">Stock Information</h4>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Current Stock</p>
                                <p class="text-sm text-gray-900">{{ $tool->stock_quantity }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Minimum Stock Level</p>
                                <p class="text-sm text-gray-900">{{ $tool->min_stock_level }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Available for Rental</p>
                                <p class="text-sm text-gray-900">{{ $tool->getAvailableForRental() }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                @if($tool->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Pricing Information -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">Pricing Information</h4>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Purchase Price</p>
                                <p class="text-sm text-gray-900">${{ number_format($tool->purchase_price, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Selling Price</p>
                                <p class="text-sm text-gray-900">${{ number_format($tool->selling_price, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Rental Price (per day)</p>
                                <p class="text-sm text-gray-900">${{ number_format($tool->rental_price ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Barcode</p>
                            <p class="text-sm text-gray-900">{{ $tool->barcode ?? 'Not specified' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">SKU</p>
                            <p class="text-sm text-gray-900">{{ $tool->sku ?? 'Not specified' }}</p>
                        </div>
                    </div>

                    <!-- Supplier Information -->
                    <div class="mt-6">
                        <h4 class="text-md font-medium text-gray-700 mb-3">Supplier Information</h4>
                        @if($tool->supplier)
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Supplier Name</p>
                                        <p class="text-sm text-gray-900">{{ $tool->supplier->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Contact Person</p>
                                        <p class="text-sm text-gray-900">{{ $tool->supplier->contact_person ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Email</p>
                                        <p class="text-sm text-gray-900">{{ $tool->supplier->email ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Phone</p>
                                        <p class="text-sm text-gray-900">{{ $tool->supplier->phone ?? 'Not specified' }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500">No supplier information available.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sales History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Sales History</h3>
                    @if($tool->sales->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($tool->sales as $sale)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sale->created_at->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sale->customer->name ?? 'Unknown' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sale->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($sale->unit_price, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($sale->total_amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No sales history available for this tool.</p>
                    @endif
                </div>
            </div>

            <!-- Rental History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Rental History</h3>
                    @if($tool->rentals->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rental Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Return Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Daily Rate</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($tool->rentals as $rental)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $rental->rental_date->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $rental->return_date ? $rental->return_date->format('M d, Y') : 'Not returned' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $rental->customer->name ?? 'Unknown' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $rental->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($rental->daily_rate, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($rental->total_amount, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($rental->status === 'active') bg-blue-100 text-blue-800
                                                    @elseif($rental->status === 'returned') bg-green-100 text-green-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst($rental->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No rental history available for this tool.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
