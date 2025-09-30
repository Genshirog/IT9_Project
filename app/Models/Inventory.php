<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';
    protected $primaryKey = 'InventoryID';
    protected $fillable = [
        'ProductID',
        'quantity',
        'status',
        'lastUpdated'
    ];

    public $timestamps = false;

    public function products(){
        return $this->belongsTo(Product::class, 'ProductID');
    }

    public function movements(){
        return $this->hasMany(Movement::class, 'InventoryID');
    }    
}
