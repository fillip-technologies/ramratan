<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['tenant_id', 'name', 'slug', 'description'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcate()
    {
        return $this->hasMany(Subcategory::class);
    }
}
