<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OredrSupport extends Model
{
    protected $table='oredr_supports';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','order_id','message'];


    
}
