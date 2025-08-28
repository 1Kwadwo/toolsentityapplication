<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rental Details') }}
            </h2>
            <div class="flex space-x-2">
                @if($rental->status === 'active')
                    <form action="{{ route('rentals.return', $rental->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Mark as Returned
                        </button>
                    </form>
                    <a href="{{ route('rentals.edit', $rental) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Edit Rental
                    </a>
                @endif
                <a href="{{ route('rentals.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Rental Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Rental Agreement</h3>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Status</p>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                @if($rental->status === 'active') bg-blue-100 text-blue-800
                                @elseif($rental->status === 'returned') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Rental Details -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">Rental Information</h4>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Rental Date</p>
                                <p class="text-sm text-gray-900">{{ $rental->rental_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Due Date</p>
                                <p class="text-sm text-gray-900">{{ $rental->due_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Return Date</p>
                                <p class="text-sm text-gray-900">{{ $rental->return_date ? $rental->return_date->format('M d, Y') : 'Not returned yet' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Payment Method</p>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($rental->payment_method === 'cash') bg-green-100 text-green-800
                                    @elseif($rental->payment_method === 'card') bg-blue-100 text-blue-800
                                    @else bg-purple-100 text-purple-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $rental->payment_method)) }}
                                </span>
                            </div>
                        </div>

                        <!-- Tool Information -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">Tool Information</h4>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Tool Name</p>
                                <p class="text-sm text-gray-900">{{ $rental->tool->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Category</p>
                                <p class="text-sm text-gray-900">{{ $rental->tool->category }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Daily Rate</p>
                                <p class="text-sm text-gray-900">${{ number_format($rental->tool->rental_price, 2) }}</p>
                            </div>
                        </div>

                        <!-- Customer Information -->
                        <div class="space-y-4">
                            <h4 class="text-md font-medium text-gray-700">Customer Information</h4>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Customer Name</p>
                                <p class="text-sm text-gray-900">{{ $rental->customer->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone</p>
                                <p class="text-sm text-gray-900">{{ $rental->customer->phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Loyalty Points</p>
                                <p class="text-sm text-gray-900">{{ $rental->customer->loyalty_points }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($rental->notes)
                        <div class="mt-6">
                            <h4 class="text-md font-medium text-gray-700 mb-2">Notes</h4>
                            <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded">{{ $rental->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rental Summary -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Rental Summary</h3>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Daily Rate:</span>
                                <span class="font-medium">${{ number_format($rental->tool->rental_price, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Rental Days:</span>
                                <span class="font-medium">{{ $rental->rental_date->diffInDays($rental->due_date) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total Fee:</span>
                                <span class="font-medium">${{ number_format($rental->total_fee, 2) }}</span>
                            </div>
                            @if($rental->return_date)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Actual Rental Days:</span>
                                    <span class="font-medium">{{ $rental->rental_date->diffInDays($rental->return_date) }}</span>
                                </div>
                            @endif
                            <hr class="border-gray-300">
                            <div class="flex justify-between text-lg font-bold">
                                <span class="text-gray-800">Total Amount:</span>
                                <span class="text-green-600">${{ number_format($rental->total_fee, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
