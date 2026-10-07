<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceBreakDown extends Model
{
    protected $table = 'price_breakdowns';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'material',
        'material_price',
        'making',
        'making_price',
        'brdiscount',
        'tax'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
