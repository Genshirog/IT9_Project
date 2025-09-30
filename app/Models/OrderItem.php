<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $primaryKey = 'OrderItemID';
    protected $fillable = [
        'OrderID',
        'MovementID',
        'quantity',
        'subTotal'
    ];

    public $timestamps = false;
    
    public function orders(){
        return $this->belongsTo(Order::class, 'OrderID');
    }

    public function movements(){
        return $this->belongsTo(Movement::class, 'MovementID');
    }
}
