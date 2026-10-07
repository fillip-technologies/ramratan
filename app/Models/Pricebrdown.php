<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricebrdown extends Model
{
    protected $table = 'pricebrdowns';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'material',
        'material_price',
        'making_price',
        'brdiscount',
        'tax'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
