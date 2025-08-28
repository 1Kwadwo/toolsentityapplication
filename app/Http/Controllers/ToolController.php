<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Supplier;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tools = Tool::with('supplier')
            ->orderBy('name')
            ->paginate(15);

        return view('tools.index', compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where('is_active', true)->get();
        return view('tools.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock_quantity' => 'required|integer|min:0',
            'min_stock_level' => 'required|integer|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'rental_price' => 'nullable|numeric|min:0',
            'barcode' => 'nullable|string|unique:tools,barcode',
            'sku' => 'nullable|string|unique:tools,sku',
            'condition' => 'required|in:new,good,fair,poor',
            'purchase_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        Tool::create($validated);

        return redirect()->route('tools.index')
            ->with('success', 'Tool created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tool = Tool::with(['supplier', 'sales', 'rentals'])->findOrFail($id);
        return view('tools.show', compact('tool'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tool = Tool::findOrFail($id);
        $suppliers = Supplier::where('is_active', true)->get();
        return view('tools.edit', compact('tool', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tool = Tool::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock_quantity' => 'required|integer|min:0',
            'min_stock_level' => 'required|integer|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'rental_price' => 'nullable|numeric|min:0',
            'barcode' => 'nullable|string|unique:tools,barcode,' . $id,
            'sku' => 'nullable|string|unique:tools,sku,' . $id,
            'condition' => 'required|in:new,good,fair,poor',
            'purchase_date' => 'required|date',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $tool->update($validated);

        return redirect()->route('tools.index')
            ->with('success', 'Tool updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tool = Tool::findOrFail($id);
        $tool->delete();

        return redirect()->route('tools.index')
            ->with('success', 'Tool deleted successfully.');
    }
}
