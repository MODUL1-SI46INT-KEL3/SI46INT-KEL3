<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; 
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; 

class Patient extends Model implements Authenticatable 
{
    use AuthenticatableTrait;
    
    protected $table = 'patient';

    protected $fillable = [
        'patient_name',
        'date_of_birth',
        'gender',
        'email',
        'phone',
        'address',
        'id_card',
        'password',
    ];
}
