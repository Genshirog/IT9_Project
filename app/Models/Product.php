<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'ProductID';
    protected $fillable = [
        'productName',
        'category',
        'price',
        'productDescription',
        'image'
    ];

    public $timestamps = false;
    
    public function order_items(){
        return $this->hasMany(OrderItem::class, 'ProductID');
    }
}
