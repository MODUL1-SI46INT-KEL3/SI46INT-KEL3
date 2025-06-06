<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'specialization_symptom');
    }
}