<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'loyalty_points',
        'is_active',
    ];

    protected $casts = [
        'loyalty_points' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get sales for this customer
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get rentals for this customer
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    /**
     * Add loyalty points
     */
    public function addLoyaltyPoints(int $points): void
    {
        $this->increment('loyalty_points', $points);
    }

    /**
     * Get total spent by customer
     */
    public function getTotalSpent(): float
    {
        return $this->sales()->sum('final_amount');
    }
}
