<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'OrderID',
        'ProductID',
        'quantity',
        'subTotal'
    ];

    public $timestamps = false;
    
    public function orders(){
        return $this->belongsTo(Order::class, 'OrderID');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'ProductID');
    }
}
