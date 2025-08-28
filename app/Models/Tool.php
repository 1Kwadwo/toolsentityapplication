<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'stock_quantity',
        'min_stock_level',
        'purchase_price',
        'selling_price',
        'rental_price',
        'barcode',
        'sku',
        'condition',
        'purchase_date',
        'supplier_id',
        'is_active',
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'rental_price' => 'decimal:2',
        'purchase_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the supplier for this tool
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get sales for this tool
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Get rentals for this tool
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    /**
     * Check if tool is low in stock
     */
    public function isLowStock(): bool
    {
        return $this->stock_quantity <= $this->min_stock_level;
    }

    /**
     * Check if tool is out of stock
     */
    public function isOutOfStock(): bool
    {
        return $this->stock_quantity <= 0;
    }

    /**
     * Get available quantity for rental
     */
    public function getAvailableForRental(): int
    {
        $rentedQuantity = $this->rentals()->where('status', 'active')->sum('quantity');
        return $this->stock_quantity - $rentedQuantity;
    }
}
