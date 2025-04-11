<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctor'; 

    protected $fillable = [
        'name', 'email', 'working_hours', 'password', 'specialization_id', 'phone', 'license_number'
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}