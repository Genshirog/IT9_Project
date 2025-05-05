<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $primaryKey = 'CartItemID';
    protected $fillable = [
        'CartID',
        'ProductID',
        'quantity',
        'subTotal'
    ];

    public $timestamps = false;
    
    public function carts(){
        return $this->belongsTo(Cart::class, 'CartID');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
