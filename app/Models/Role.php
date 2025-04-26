<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'roleName',
        'roleDescription'
    ];

    public $timestamps = false;
    public function user(){
        return $this->hasMany(User::class, 'RoleID');
    }
}
