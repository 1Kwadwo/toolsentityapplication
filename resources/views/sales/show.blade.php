<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sale Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('sales.edit', $sale) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit Sale
                </a>
                <a href="{{ route('sales.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Sale Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Sale Receipt</h3>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Receipt #</p>
                            <p class="text-lg font-bold text-gray-900">{{ $sale->receipt_number }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Sale Details -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">Sale Information</h4>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Sale Date</p>
                                <p class="text-sm text-gray-900">{{ $sale->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Sold By</p>
                                <p class="text-sm text-gray-900">{{ $sale->user->name ?? 'Unknown' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Payment Method</p>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($sale->payment_method === 'cash') bg-green-100 text-green-800
                                    @elseif($sale->payment_method === 'card') bg-blue-100 text-blue-800
                                    @else bg-purple-100 text-purple-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $sale->payment_method)) }}
                                </span>
                            </div>
                        </div>

                        <!-- Tool Information -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">Tool Information</h4>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tool Name</p>
                                <p class="text-sm text-gray-900">{{ $sale->tool->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Category</p>
                                <p class="text-sm text-gray-900">{{ $sale->tool->category }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Quantity Sold</p>
                                <p class="text-sm text-gray-900">{{ $sale->quantity }}</p>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">Customer Information</h4>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Customer Name</p>
                                <p class="text-sm text-gray-900">{{ $sale->customer->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone</p>
                                <p class="text-sm text-gray-900">{{ $sale->customer->phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Loyalty Points</p>
                                <p class="text-sm text-gray-900">{{ $sale->customer->loyalty_points }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($sale->notes)
                        <div class="mt-6">
                            <h4 class="text-md font-medium text-gray-700 mb-2">Notes</h4>
                            <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded">{{ $sale->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Receipt Details -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Receipt Details</h3>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Unit Price:</span>
                                <span class="font-medium">${{ number_format($sale->unit_price, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Quantity:</span>
                                <span class="font-medium">{{ $sale->quantity }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal:</span>
                                <span class="font-medium">${{ number_format($sale->total_amount, 2) }}</span>
                            </div>
                            @if($sale->discount > 0)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Discount:</span>
                                    <span class="font-medium text-red-600">-${{ number_format($sale->discount, 2) }}</span>
                                </div>
                            @endif
                            <hr class="border-gray-300">
                            <div class="flex justify-between text-lg font-bold">
                                <span class="text-gray-800">Total Amount:</span>
                                <span class="text-green-600">${{ number_format($sale->final_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
