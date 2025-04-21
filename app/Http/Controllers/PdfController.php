<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Doctor;
use App\Models\Symptom;
use App\Models\Appointment;
use PDF;

class PdfController extends Controller
{
    public function patient_exportPdf() 
    {
        $patients = Patient::all();
        $nav = 'Patient List';

        $pdf = PDF::loadView('admins.adminPatient.pdf', compact('patients', 'nav'));

        return $pdf->download('patient_list.pdf');
    }

    public function doctor_exportPdf() 
    {
        $doctors = Doctor::all();
        $nav = 'Doctor List';

        $pdf = PDF::loadView('admins.admindoctors.pdf', compact('doctors', 'nav'));

        return $pdf->download('Doctor_List.pdf');
    }

    public function symptom_exportPdf() 
    {
        $symptoms =Symptom::all();
        $nav = 'Symptom List';

        $pdf = PDF::loadView('admins.adminsymptoms.pdf', compact('symptoms', 'nav'));

        return $pdf->download('symptoms_list.pdf');
    }

    public function medicine_exportPdf() 
    {
        $medicines =Medicine::all();
        $nav = 'Medicine List';
        $pdf = PDF::loadView('admins.adminmedicine.pdf', compact('medicines', 'nav'));
        return $pdf->download('medicine_list.pdf');
    }

    public function appointments_exportPdf() 
    {
        $appointments = Appointment::all();
        $nav = 'Appointments List';

        $pdf = PDF::loadView('admins.adminappointments.pdf', compact('appointments', 'nav'));

        return $pdf->download('Appointment_List.pdf');
    }
}