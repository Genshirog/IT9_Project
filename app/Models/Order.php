<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'OrderID';
    protected $fillable = [
        'UserID',
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
