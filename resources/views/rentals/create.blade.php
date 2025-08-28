<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Rental') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('rentals.store') }}" method="POST">
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
                                            data-price="{{ $tool->rental_price }}" data-available="{{ $tool->getAvailableForRental() }}">
                                            {{ $tool->name }} - Available: {{ $tool->getAvailableForRental() }} - ${{ number_format($tool->rental_price, 2) }}/day
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

                            <!-- Rental Date -->
                            <div>
                                <label for="rental_date" class="block text-sm font-medium text-gray-700">Rental Date *</label>
                                <input type="date" name="rental_date" id="rental_date" value="{{ old('rental_date', date('Y-m-d')) }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('rental_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Due Date -->
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date *</label>
                                <input type="date" name="due_date" id="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('due_date')
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

                        <!-- Rental Summary -->
                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Rental Summary</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-500">Daily Rate:</span>
                                    <span id="daily-rate" class="font-medium">$0.00</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Rental Days:</span>
                                    <span id="rental-days" class="font-medium">0</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Total Fee:</span>
                                    <span id="total-fee" class="font-medium text-lg text-green-600">$0.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end space-x-3">
                            <a href="{{ route('rentals.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg border-2 border-emerald-500 text-lg">
                                ✅ CREATE RENTAL
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Rental calculation functionality
        function updateRentalSummary() {
            const toolSelect = document.getElementById('tool_id');
            const rentalDateInput = document.getElementById('rental_date');
            const dueDateInput = document.getElementById('due_date');
            
            const selectedOption = toolSelect.options[toolSelect.selectedIndex];
            const dailyRate = selectedOption ? parseFloat(selectedOption.dataset.price) : 0;
            const rentalDate = new Date(rentalDateInput.value);
            const dueDate = new Date(dueDateInput.value);
            
            const rentalDays = Math.ceil((dueDate - rentalDate) / (1000 * 60 * 60 * 24));
            const totalFee = dailyRate * rentalDays;
            
            document.getElementById('daily-rate').textContent = `$${dailyRate.toFixed(2)}`;
            document.getElementById('rental-days').textContent = rentalDays > 0 ? rentalDays : 0;
            document.getElementById('total-fee').textContent = `$${totalFee.toFixed(2)}`;
        }
        
        document.getElementById('tool_id').addEventListener('change', updateRentalSummary);
        document.getElementById('rental_date').addEventListener('change', updateRentalSummary);
        document.getElementById('due_date').addEventListener('change', updateRentalSummary);
        
        // Initialize summary
        updateRentalSummary();
    </script>
</x-app-layout>
