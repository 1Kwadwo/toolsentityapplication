<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_id',
        'customer_id',
        'user_id',
        'rental_date',
        'due_date',
        'return_date',
        'rental_fee',
        'late_fee',
        'total_fee',
        'status',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'rental_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
        'rental_fee' => 'decimal:2',
        'late_fee' => 'decimal:2',
        'total_fee' => 'decimal:2',
    ];

    /**
     * Get the tool for this rental
     */
    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    /**
     * Get the customer for this rental
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user who processed this rental
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if rental is overdue
     */
    public function isOverdue(): bool
    {
        return $this->status === 'active' && $this->due_date->isPast();
    }

    /**
     * Calculate late fee
     */
    public function calculateLateFee(): float
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        $daysOverdue = Carbon::now()->diffInDays($this->due_date);
        return $daysOverdue * ($this->rental_fee * 0.1); // 10% of rental fee per day
    }

    /**
     * Mark rental as returned
     */
    public function markAsReturned(): void
    {
        $this->update([
            'status' => 'returned',
            'return_date' => Carbon::now(),
            'late_fee' => $this->calculateLateFee(),
            'total_fee' => $this->rental_fee + $this->calculateLateFee(),
        ]);
    }
}
