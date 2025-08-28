<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@toolstore.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Manager User
        User::create([
            'name' => 'Store Manager',
            'email' => 'manager@toolstore.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        // Create Cashier User
        User::create([
            'name' => 'Cashier Staff',
            'email' => 'cashier@toolstore.com',
            'password' => Hash::make('password'),
            'role' => 'cashier',
        ]);
    }
}
