<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceSetting extends Model
{
    protected $table = 'price_settings';
    protected $id = 'id';
    protected $fillable = ['name','gst','making_charges','price','purity'];
}
