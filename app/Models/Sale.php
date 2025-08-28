<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_id',
        'customer_id',
        'user_id',
        'quantity',
        'unit_price',
        'total_amount',
        'discount',
        'final_amount',
        'payment_method',
        'receipt_number',
        'notes',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the sale date (alias for created_at)
     */
    public function getSaleDateAttribute()
    {
        return $this->created_at;
    }

    /**
     * Get the tool for this sale
     */
    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    /**
     * Get the customer for this sale
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user who made this sale
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
