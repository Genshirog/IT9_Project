<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{   
    protected $fillable = [
        'OrderID',
        'amountPayed',
        'amountChanged',
        'paymentMethod'
    ];

    public $timestamps = false;
    
    public function orders(){
        return $this->hasOne(Order::class,'OrderID');
    }
}
