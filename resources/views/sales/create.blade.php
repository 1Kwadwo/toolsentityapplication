<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Sale') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tool Selection -->
                            <div>
                                <label for="tool_id" class="block text-sm font-medium text-gray-700">Tool *</label>
                                <select name="tool_id" id="tool_id" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select a tool</option>
                                    @foreach($tools as $tool)
                                        <option value="{{ $tool->id }}" {{ old('tool_id') == $tool->id ? 'selected' : '' }}
                                            data-price="{{ $tool->selling_price }}" data-stock="{{ $tool->stock_quantity }}">
                                            {{ $tool->name }} - Stock: {{ $tool->stock_quantity }} - ${{ number_format($tool->selling_price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tool_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Customer Selection -->
                            <div>
                                <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer *</label>
                                <select name="customer_id" id="customer_id" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select a customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} ({{ $customer->loyalty_points }} points)
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity *</label>
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('quantity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Payment Method -->
                            <div>
                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method *</label>
                                <select name="payment_method" id="payment_method" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select payment method</option>
                                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Card</option>
                                    <option value="mobile_money" {{ old('payment_method') == 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                                </select>
                                @error('payment_method')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discount -->
                            <div>
                                <label for="discount" class="block text-sm font-medium text-gray-700">Discount ($)</label>
                                <input type="number" name="discount" id="discount" value="{{ old('discount', 0) }}" min="0" step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('discount')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                <textarea name="notes" id="notes" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Price Summary -->
                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Price Summary</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-500">Unit Price:</span>
                                    <span id="unit-price" class="font-medium">$0.00</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Quantity:</span>
                                    <span id="display-quantity" class="font-medium">0</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Subtotal:</span>
                                    <span id="subtotal" class="font-medium">$0.00</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Final Total:</span>
                                    <span id="final-total" class="font-medium text-lg text-green-600">$0.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end space-x-3">
                            <a href="{{ route('sales.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg border-2 border-emerald-500 text-lg">
                                ✅ COMPLETE SALE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Price calculation functionality
        function updatePrices() {
            const toolSelect = document.getElementById('tool_id');
            const quantityInput = document.getElementById('quantity');
            const discountInput = document.getElementById('discount');
            
            const selectedOption = toolSelect.options[toolSelect.selectedIndex];
            const unitPrice = selectedOption ? parseFloat(selectedOption.dataset.price) : 0;
            const quantity = parseInt(quantityInput.value) || 0;
            const discount = parseFloat(discountInput.value) || 0;
            
            const subtotal = unitPrice * quantity;
            const finalTotal = subtotal - discount;
            
            document.getElementById('unit-price').textContent = `$${unitPrice.toFixed(2)}`;
            document.getElementById('display-quantity').textContent = quantity;
            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('final-total').textContent = `$${finalTotal.toFixed(2)}`;
        }
        
        document.getElementById('tool_id').addEventListener('change', updatePrices);
        document.getElementById('quantity').addEventListener('input', updatePrices);
        document.getElementById('discount').addEventListener('input', updatePrices);
        
        // Initialize prices
        updatePrices();
    </script>
</x-app-layout>
