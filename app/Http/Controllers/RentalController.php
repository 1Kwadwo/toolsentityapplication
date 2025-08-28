<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Tool;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentals = Rental::with(['tool', 'customer', 'user'])
            ->latest()
            ->paginate(15);

        return view('rentals.index', compact('rentals'));
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

        return view('rentals.create', compact('tools', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'customer_id' => 'required|exists:customers,id',
            'rental_date' => 'required|date|after_or_equal:today',
            'due_date' => 'required|date|after:rental_date',
            'payment_method' => 'required|in:cash,card,mobile_money',
            'notes' => 'nullable|string',
        ]);

        $tool = Tool::findOrFail($validated['tool_id']);
        
        // Check if tool is available for rental
        if ($tool->getAvailableForRental() <= 0) {
            return back()->withErrors(['tool_id' => 'Tool is not available for rental.']);
        }

        // Calculate rental fee
        $rentalDays = Carbon::parse($validated['rental_date'])->diffInDays($validated['due_date']);
        $rentalFee = $tool->rental_price * $rentalDays;

        DB::transaction(function () use ($validated, $tool, $rentalFee) {
            // Create rental record
            Rental::create([
                'tool_id' => $validated['tool_id'],
                'customer_id' => $validated['customer_id'],
                'user_id' => auth()->id(),
                'rental_date' => $validated['rental_date'],
                'due_date' => $validated['due_date'],
                'rental_fee' => $rentalFee,
                'total_fee' => $rentalFee,
                'payment_method' => $validated['payment_method'],
                'notes' => $validated['notes'],
            ]);
        });

        return redirect()->route('rentals.index')
            ->with('success', 'Rental created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rental = Rental::with(['tool', 'customer', 'user'])->findOrFail($id);
        return view('rentals.show', compact('rental'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rental = Rental::findOrFail($id);
        
        // Only allow editing if rental is still active
        if ($rental->status !== 'active') {
            return redirect()->route('rentals.show', $rental->id)
                ->with('error', 'Cannot edit returned or overdue rentals.');
        }

        $tools = Tool::where('is_active', true)->orderBy('name')->get();
        $customers = Customer::where('is_active', true)->orderBy('name')->get();

        return view('rentals.edit', compact('rental', 'tools', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rental = Rental::findOrFail($id);
        
        // Only allow updating if rental is still active
        if ($rental->status !== 'active') {
            return redirect()->route('rentals.show', $rental->id)
                ->with('error', 'Cannot edit returned or overdue rentals.');
        }

        $validated = $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'customer_id' => 'required|exists:customers,id',
            'rental_date' => 'required|date',
            'due_date' => 'required|date|after:rental_date',
            'payment_method' => 'required|in:cash,card,mobile_money',
            'notes' => 'nullable|string',
        ]);

        $tool = Tool::findOrFail($validated['tool_id']);
        
        // Check if tool is available for rental (considering current rental)
        if ($validated['tool_id'] != $rental->tool_id) {
            if ($tool->getAvailableForRental() <= 0) {
                return back()->withErrors(['tool_id' => 'Tool is not available for rental.']);
            }
        }

        // Calculate rental fee
        $rentalDays = Carbon::parse($validated['rental_date'])->diffInDays($validated['due_date']);
        $rentalFee = $tool->rental_price * $rentalDays;

        $rental->update([
            'tool_id' => $validated['tool_id'],
            'customer_id' => $validated['customer_id'],
            'rental_date' => $validated['rental_date'],
            'due_date' => $validated['due_date'],
            'rental_fee' => $rentalFee,
            'total_fee' => $rentalFee,
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('rentals.index')
            ->with('success', 'Rental updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rental = Rental::findOrFail($id);
        
        // Only allow deletion if rental is still active
        if ($rental->status !== 'active') {
            return redirect()->route('rentals.show', $rental->id)
                ->with('error', 'Cannot delete returned or overdue rentals.');
        }

        $rental->delete();

        return redirect()->route('rentals.index')
            ->with('success', 'Rental deleted successfully.');
    }

    /**
     * Mark rental as returned
     */
    public function return(string $id)
    {
        $rental = Rental::findOrFail($id);
        
        if ($rental->status !== 'active') {
            return redirect()->route('rentals.show', $rental->id)
                ->with('error', 'Rental is already returned.');
        }

        $rental->markAsReturned();

        return redirect()->route('rentals.show', $rental->id)
            ->with('success', 'Rental returned successfully.');
    }
}
