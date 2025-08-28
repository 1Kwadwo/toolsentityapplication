<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Tool;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Str;

class SaleSeeder extends Seeder
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

        $sales = [
            [
                'tool_id' => $tools->first()->id,
                'customer_id' => $customers->first()->id,
                'user_id' => $users->first()->id,
                'quantity' => 1,
                'unit_price' => $tools->first()->selling_price,
                'total_amount' => $tools->first()->selling_price,
                'discount' => 0,
                'final_amount' => $tools->first()->selling_price,
                'payment_method' => 'cash',
                'receipt_number' => 'RCP-' . date('Ymd') . '-' . Str::random(6),
                'notes' => 'Sample sale transaction',
            ],
            [
                'tool_id' => $tools->skip(1)->first()->id,
                'customer_id' => $customers->skip(1)->first()->id,
                'user_id' => $users->first()->id,
                'quantity' => 2,
                'unit_price' => $tools->skip(1)->first()->selling_price,
                'total_amount' => $tools->skip(1)->first()->selling_price * 2,
                'discount' => 10.00,
                'final_amount' => ($tools->skip(1)->first()->selling_price * 2) - 10.00,
                'payment_method' => 'card',
                'receipt_number' => 'RCP-' . date('Ymd') . '-' . Str::random(6),
                'notes' => 'Bulk purchase with discount',
            ],
        ];

        foreach ($sales as $saleData) {
            Sale::create($saleData);
        }
    }
}
