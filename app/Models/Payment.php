<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{   
    protected $primaryKey = 'PaymentID';
    protected $fillable = [
        'OrderID',
        'amountPayed',
        'amountChanged',
        'paymentMethod',
        'status'
    ];

    public $timestamps = false;
    
    public function orders(){
        return $this->hasOne(Order::class,'OrderID');
    }
}
