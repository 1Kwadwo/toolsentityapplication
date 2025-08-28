<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rental;
use App\Models\Tool;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tools = Tool::all();
        $customers = Customer::all();
        $users = User::all();

        if ($tools->isEmpty() || $customers->isEmpty() || $users->isEmpty()) {
            return;
        }

        $rentals = [
            [
                'tool_id' => $tools->first()->id,
                'customer_id' => $customers->first()->id,
                'user_id' => $users->first()->id,
                'rental_date' => Carbon::now()->subDays(5),
                'due_date' => Carbon::now()->addDays(2),
                'rental_fee' => $tools->first()->rental_price * 7,
                'total_fee' => $tools->first()->rental_price * 7,
                'payment_method' => 'cash',
                'status' => 'active',
                'notes' => 'Sample active rental',
            ],
            [
                'tool_id' => $tools->skip(1)->first()->id,
                'customer_id' => $customers->skip(1)->first()->id,
                'user_id' => $users->first()->id,
                'rental_date' => Carbon::now()->subDays(10),
                'due_date' => Carbon::now()->subDays(3),
                'return_date' => Carbon::now()->subDays(3),
                'rental_fee' => $tools->skip(1)->first()->rental_price * 7,
                'total_fee' => $tools->skip(1)->first()->rental_price * 7,
                'payment_method' => 'card',
                'status' => 'returned',
                'notes' => 'Sample returned rental',
            ],
        ];

        foreach ($rentals as $rentalData) {
            Rental::create($rentalData);
        }
    }
}
