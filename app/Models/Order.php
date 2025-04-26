<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'UserID',
        'status',
        'deliveryType',
        'totalPrice'
    ];

    public $timestamps = false;
    
    public function users(){
        return $this->belongsTo(User::class, 'UserID');
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class, 'OrderID');
    }
}
