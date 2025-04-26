<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'productName',
        'category',
        'price',
        'description',
        'image'
    ];

    public $timestamps = false;
    
    public function order_items(){
        return $this->hasMany(OrderItem::class, 'ProductID');
    }
}
