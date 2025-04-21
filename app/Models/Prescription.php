<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescription';
    protected $primaryKey = 'prescription_id';
    public $timestamps = true;

    protected $fillable = [
        'dosage',
        'instructions',
        'issue_date',
        'PatientUser_id',
        'DoctorUser_id',
        'MedicinePrescription_id',
        'prescription_file',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    /**
     * Get the patient that owns the prescription.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatientUser_id');
    }

    /**
     * Get the doctor that created the prescription.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'DoctorUser_id');
    }
}
