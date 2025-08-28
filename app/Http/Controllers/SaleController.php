<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Tool;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['tool', 'customer', 'user'])
            ->latest()
            ->paginate(15);

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tools = Tool::where('is_active', true)
            ->where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get();
        
        $customers = Customer::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('sales.create', compact('tools', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:cash,card,mobile_money',
            'notes' => 'nullable|string',
        ]);

        $tool = Tool::findOrFail($validated['tool_id']);
        
        // Check stock availability
        if ($tool->stock_quantity < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Insufficient stock available.']);
        }

        // Calculate amounts
        $unitPrice = $tool->selling_price;
        $totalAmount = $unitPrice * $validated['quantity'];
        $discount = $validated['discount'] ?? 0;
        $finalAmount = $totalAmount - $discount;

        // Generate receipt number
        $receiptNumber = 'RCP-' . date('Ymd') . '-' . Str::random(6);

        DB::transaction(function () use ($validated, $tool, $unitPrice, $totalAmount, $discount, $finalAmount, $receiptNumber) {
            // Create sale record
            Sale::create([
                'tool_id' => $validated['tool_id'],
                'customer_id' => $validated['customer_id'],
                'user_id' => auth()->id(),
                'quantity' => $validated['quantity'],
                'unit_price' => $unitPrice,
                'total_amount' => $totalAmount,
                'discount' => $discount,
                'final_amount' => $finalAmount,
                'payment_method' => $validated['payment_method'],
                'receipt_number' => $receiptNumber,
                'notes' => $validated['notes'],
            ]);

            // Update stock
            $tool->decrement('stock_quantity', $validated['quantity']);

            // Add loyalty points to customer
            $customer = Customer::find($validated['customer_id']);
            $loyaltyPoints = (int)($finalAmount / 10); // 1 point per $10 spent
            $customer->addLoyaltyPoints($loyaltyPoints);
        });

        return redirect()->route('sales.show', Sale::where('receipt_number', $receiptNumber)->first()->id)
            ->with('success', 'Sale completed successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Sale::with(['tool', 'customer', 'user'])->findOrFail($id);
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sale = Sale::findOrFail($id);
        $tools = Tool::where('is_active', true)->orderBy('name')->get();
        $customers = Customer::where('is_active', true)->orderBy('name')->get();

        return view('sales.edit', compact('sale', 'tools', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sale = Sale::findOrFail($id);

        $validated = $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'customer_id' => 'required|exists:customers,id',
            'quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:cash,card,mobile_money',
            'notes' => 'nullable|string',
        ]);

        $tool = Tool::findOrFail($validated['tool_id']);
        
        // Check stock availability (considering current sale quantity)
        $availableStock = $tool->stock_quantity + $sale->quantity;
        if ($availableStock < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Insufficient stock available.']);
        }

        // Calculate amounts
        $unitPrice = $tool->selling_price;
        $totalAmount = $unitPrice * $validated['quantity'];
        $discount = $validated['discount'] ?? 0;
        $finalAmount = $totalAmount - $discount;

        DB::transaction(function () use ($sale, $validated, $tool, $unitPrice, $totalAmount, $discount, $finalAmount) {
            // Restore original stock
            $tool->increment('stock_quantity', $sale->quantity);

            // Update sale record
            $sale->update([
                'tool_id' => $validated['tool_id'],
                'customer_id' => $validated['customer_id'],
                'quantity' => $validated['quantity'],
                'unit_price' => $unitPrice,
                'total_amount' => $totalAmount,
                'discount' => $discount,
                'final_amount' => $finalAmount,
                'payment_method' => $validated['payment_method'],
                'notes' => $validated['notes'],
            ]);

            // Update stock with new quantity
            $tool->decrement('stock_quantity', $validated['quantity']);
        });

        return redirect()->route('sales.index')
            ->with('success', 'Sale updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale = Sale::findOrFail($id);

        DB::transaction(function () use ($sale) {
            // Restore stock
            $sale->tool->increment('stock_quantity', $sale->quantity);
            
            // Remove loyalty points
            $customer = $sale->customer;
            $loyaltyPoints = (int)($sale->final_amount / 10);
            $customer->decrement('loyalty_points', $loyaltyPoints);

            $sale->delete();
        });

        return redirect()->route('sales.index')
            ->with('success', 'Sale deleted successfully.');
    }
}
