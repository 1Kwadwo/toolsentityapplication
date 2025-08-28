<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'ToolMaster Industries',
            'email' => 'sales@toolmaster.com',
            'phone' => '+1-555-0101',
            'address' => '123 Industrial Blvd, Tool City, TC 12345',
            'contact_person' => 'John Smith',
            'is_active' => true,
        ]);

        Supplier::create([
            'name' => 'ProTools Supply Co.',
            'email' => 'info@protools.com',
            'phone' => '+1-555-0202',
            'address' => '456 Hardware Lane, Tool Town, TT 67890',
            'contact_person' => 'Sarah Johnson',
            'is_active' => true,
        ]);

        Supplier::create([
            'name' => 'Quality Tools Ltd.',
            'email' => 'orders@qualitytools.com',
            'phone' => '+1-555-0303',
            'address' => '789 Equipment Drive, Tool Valley, TV 11111',
            'contact_person' => 'Mike Wilson',
            'is_active' => true,
        ]);
    }
}
