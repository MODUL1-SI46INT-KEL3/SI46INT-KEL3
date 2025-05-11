<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; 
use Illuminate\Auth\Authenticatable as AuthenticatableTrait; 

class Doctor extends Model implements Authenticatable 
{
    use AuthenticatableTrait;

    protected $table = 'doctor'; 

    protected $fillable = [
         'name', 'email', 'working_hours', 'password', 'specialization_id', 'phone', 'license_number', 'photo'
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
    
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}