<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'patient_id',
        'item',
        'amount',
        'payment_method',
        'payment_status',
        'payment_date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
