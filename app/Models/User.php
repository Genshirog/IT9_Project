<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'UserID';
    protected $fillable =[
        'firstname',
        'lastname',
        'username',
        'password',
        'address',
        'RoleID',
        'email',
        'contactNumber',
        'birthday',
        'image'
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
