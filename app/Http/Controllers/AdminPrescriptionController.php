<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPrescriptionController extends Controller
{
    /**
     * Display a listing of all prescriptions.
     */
    public function index(Request $request)
    {
        $prescriptions = Prescription::with(['patient', 'doctor']);
        $nav = 'Prescriptions';
        $search = $request->input('search');

        if ($search) {
            $prescriptions->whereHas('patient', function($query) use ($search) {
                $query->where('patient_name', 'like', "%{$search}%");
            });
        }

        $prescriptions = $prescriptions->orderBy('issue_date', 'desc')
            ->get();
        
        return view('admins.adminPrescription.index', compact('prescriptions', 'nav', 'search'));
    }

    /**
     * Display the specified prescriptions for a patient.
     */
    public function show($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $prescriptions = Prescription::where('PatientUser_id', $patientId)
            ->with('doctor')
            ->orderBy('issue_date', 'desc')
            ->get();
        $nav = 'Patient Prescriptions';
        
        return view('admins.adminPrescription.show', compact('patient', 'prescriptions', 'nav'));
    }

    /**
     * View a specific prescription.
     */
    public function view($id)
    {
        $prescription = Prescription::with(['patient', 'doctor'])->findOrFail($id);
        $nav = 'View Prescription';
        
        return view('admins.adminPrescription.view', compact('prescription', 'nav'));
    }

    /**
     * Download the prescription file.
     */
    public function downloadFile($id)
    {
        $prescription = Prescription::findOrFail($id);
        
        if (!$prescription->prescription_file) {
            return back()->with('error', 'No file attached to this prescription.');
        }
        
        if (!Storage::disk('public')->exists($prescription->prescription_file)) {
            return back()->with('error', 'File not found.');
        }
        
        return Storage::disk('public')->download($prescription->prescription_file);
    }

    /**
     * Print the prescription as a report.
     */
    public function printReport($id)
    {
        $prescription = Prescription::with(['patient', 'doctor'])->findOrFail($id);
        
        return view('admins.adminPrescription.print', compact('prescription'));
    }
}
