<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getPriceAttribute(): float
    {
        return $this->product->selling_price;
    }

    public function getTotalAttribute(): float
    {
        return ($this->price * $this->quantity);
    }
}
