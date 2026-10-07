<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;
    protected $fillable = ['tenant_id','name','email','password','phone','address'];
    protected $hidden = ['password'];

    public function tenant() { return $this->belongsTo(Tenant::class); }
    public function orders() { return $this->hasMany(Order::class); }
    public function cartItems() { return $this->hasMany(CartItem::class); }
    public function reviews() { return $this->hasMany(Review::class); }
}
