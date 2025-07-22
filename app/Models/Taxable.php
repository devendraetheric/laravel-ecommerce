<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Taxable extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $fillable = ['tax_id', 'taxable_type', 'taxable_id', 'tax_rate', 'base_amount', 'tax_amount'];

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function taxable()
    {
        return $this->morphTo();
    }
}
