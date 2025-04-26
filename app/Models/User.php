<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable =[
        'firstname',
        'lastname',
        'username',
        'password',
        'address',
        'RoleID',
        'email',
        'contactNumber'
    ];

    public $timestamps = false;
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'RoleID');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'UserID');
    }
}
