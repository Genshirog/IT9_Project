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
    
    public function cart(){
        return $this->belongsTo(Cart::class, 'CartID');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
