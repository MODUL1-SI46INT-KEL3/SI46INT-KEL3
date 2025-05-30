<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
        public function patient()
    {
        return $this->belongsTo(related: Patient::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    protected $fillable = ['patient_id', 'medicine_id', 'quantity', 'selected'];

}
