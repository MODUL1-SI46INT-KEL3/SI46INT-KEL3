<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; 
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; 

class Admin extends Model implements Authenticatable 
{
    use AuthenticatableTrait;
    
    protected $table = "admin";

    protected $fillable = [
        'username',
        'password',
    ];
}
