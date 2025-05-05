<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'CartID';
    protected $fillable = [
        'UserID',
        'totalPrice'
    ];

    public $timestamps = false;
    
    public function users(){
        return $this->belongsTo(User::class, 'UserID');
    }

    public function cart_items(){
        return $this->hasMany(CartItem::class, 'CartItemID');
    }
}
