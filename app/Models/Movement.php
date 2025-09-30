<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'Movement';
    protected $primaryKey = 'MovementID';
    protected $fillable = [
        'InventoryID',
        'changeType',
        'quantityChange',
        'reason',
        'dateTime'
    ];    

    public $timestamps = false;

    public function inventory(){
        return $this->belongsTo(Inventory::class, 'InventoryID');
    }

    public function order(){
        return $this->hasMany(Movement::class, 'InventoryID');
    }
}
