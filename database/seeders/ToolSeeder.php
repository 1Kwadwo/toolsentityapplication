<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tool;
use App\Models\Supplier;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = Supplier::all();

        // Power Tools
        Tool::create([
            'name' => 'Cordless Drill',
            'category' => 'Power Tools',
            'description' => '18V Cordless Drill with 2 batteries',
            'stock_quantity' => 15,
            'min_stock_level' => 5,
            'purchase_price' => 89.99,
            'selling_price' => 129.99,
            'rental_price' => 15.00,
            'barcode' => 'TOOL001',
            'sku' => 'DRL-001',
            'condition' => 'new',
            'purchase_date' => now()->subDays(30),
            'supplier_id' => $suppliers->first()->id,
            'is_active' => true,
        ]);

        Tool::create([
            'name' => 'Circular Saw',
            'category' => 'Power Tools',
            'description' => '7-1/4 inch Circular Saw',
            'stock_quantity' => 8,
            'min_stock_level' => 3,
            'purchase_price' => 149.99,
            'selling_price' => 199.99,
            'rental_price' => 25.00,
            'barcode' => 'TOOL002',
            'sku' => 'CSW-001',
            'condition' => 'new',
            'purchase_date' => now()->subDays(25),
            'supplier_id' => $suppliers->first()->id,
            'is_active' => true,
        ]);

        // Hand Tools
        Tool::create([
            'name' => 'Hammer Set',
            'category' => 'Hand Tools',
            'description' => '3-piece hammer set (16oz, 20oz, 24oz)',
            'stock_quantity' => 25,
            'min_stock_level' => 10,
            'purchase_price' => 29.99,
            'selling_price' => 49.99,
            'rental_price' => 8.00,
            'barcode' => 'TOOL003',
            'sku' => 'HAM-001',
            'condition' => 'new',
            'purchase_date' => now()->subDays(20),
            'supplier_id' => $suppliers->get(1)->id,
            'is_active' => true,
        ]);

        Tool::create([
            'name' => 'Screwdriver Set',
            'category' => 'Hand Tools',
            'description' => '12-piece precision screwdriver set',
            'stock_quantity' => 30,
            'min_stock_level' => 15,
            'purchase_price' => 19.99,
            'selling_price' => 34.99,
            'rental_price' => 5.00,
            'barcode' => 'TOOL004',
            'sku' => 'SCR-001',
            'condition' => 'new',
            'purchase_date' => now()->subDays(15),
            'supplier_id' => $suppliers->get(1)->id,
            'is_active' => true,
        ]);

        // Garden Tools
        Tool::create([
            'name' => 'Lawn Mower',
            'category' => 'Garden Tools',
            'description' => 'Self-propelled lawn mower 21-inch',
            'stock_quantity' => 5,
            'min_stock_level' => 2,
            'purchase_price' => 299.99,
            'selling_price' => 399.99,
            'rental_price' => 45.00,
            'barcode' => 'TOOL005',
            'sku' => 'LM-001',
            'condition' => 'new',
            'purchase_date' => now()->subDays(10),
            'supplier_id' => $suppliers->get(2)->id,
            'is_active' => true,
        ]);

        Tool::create([
            'name' => 'Garden Shovel',
            'category' => 'Garden Tools',
            'description' => 'Heavy-duty garden shovel with wooden handle',
            'stock_quantity' => 20,
            'min_stock_level' => 8,
            'purchase_price' => 24.99,
            'selling_price' => 39.99,
            'rental_price' => 6.00,
            'barcode' => 'TOOL006',
            'sku' => 'GSH-001',
            'condition' => 'new',
            'purchase_date' => now()->subDays(5),
            'supplier_id' => $suppliers->get(2)->id,
            'is_active' => true,
        ]);

        // Low stock items for testing alerts
        Tool::create([
            'name' => 'Welding Machine',
            'category' => 'Welding Equipment',
            'description' => 'Arc welding machine 200A',
            'stock_quantity' => 2,
            'min_stock_level' => 3,
            'purchase_price' => 399.99,
            'selling_price' => 599.99,
            'rental_price' => 75.00,
            'barcode' => 'TOOL007',
            'sku' => 'WEL-001',
            'condition' => 'good',
            'purchase_date' => now()->subDays(60),
            'supplier_id' => $suppliers->first()->id,
            'is_active' => true,
        ]);
    }
}
