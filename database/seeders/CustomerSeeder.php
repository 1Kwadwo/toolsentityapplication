<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@email.com',
                'phone' => '+1 (555) 123-4567',
                'address' => '123 Main Street, Anytown, CA 90210',
                'loyalty_points' => 150,
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@email.com',
                'phone' => '+1 (555) 234-5678',
                'address' => '456 Oak Avenue, Somewhere, NY 10001',
                'loyalty_points' => 75,
                'is_active' => true,
            ],
            [
                'name' => 'Mike Davis',
                'email' => 'mike.davis@email.com',
                'phone' => '+1 (555) 345-6789',
                'address' => '789 Pine Road, Elsewhere, TX 75001',
                'loyalty_points' => 200,
                'is_active' => true,
            ],
            [
                'name' => 'Lisa Wilson',
                'email' => 'lisa.wilson@email.com',
                'phone' => '+1 (555) 456-7890',
                'address' => '321 Elm Street, Nowhere, FL 33101',
                'loyalty_points' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'David Brown',
                'email' => 'david.brown@email.com',
                'phone' => '+1 (555) 567-8901',
                'address' => '654 Maple Drive, Anywhere, WA 98101',
                'loyalty_points' => 300,
                'is_active' => true,
            ],
        ];

        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }
    }
}
