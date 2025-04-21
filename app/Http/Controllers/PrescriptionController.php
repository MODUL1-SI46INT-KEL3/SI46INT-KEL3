<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the prescriptions.
     */
    // public function index()
    // {
    //     $prescriptions = Prescription::with('patient')
    //         ->where('DoctorUser_id', $doctor->id)
    //         ->orderBy('issue_date', 'desc')
    //         ->get();
        
    //     return view('doctors.prescriptions.index', compact('prescriptions', 'doctor'));
    // }

    // /**
    //  * Show the form for creating a new prescription.
    //  */
    // public function create(Request $request)
    // {
    //     // Check if patient_id is provided in the request
    //     if ($request->has('patient_id')) {
    //         $patient = Patient::findOrFail($request->patient_id);
    //         return view('doctors.prescriptions.create', compact('patient'));
    //     }
        
    //     // If no patient_id is provided, show all patients to select from
    //     $patients = Patient::all();
    //     return view('doctors.prescriptions.select_patient', compact('patients'));
    // }

    // /**
    //  * Store a newly created prescription in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'PatientUser_id' => 'required|exists:patient,id',
    //         'dosage' => 'required|string|max:255',
    //         'instructions' => 'required|string',
    //         'issue_date' => 'required|date',
    //         'prescription_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    //     ]);

    //     $doctor = Auth::guard('doctor')->user();
        
    //     $prescription = new Prescription([
    //         'PatientUser_id' => $request->PatientUser_id,
    //         'DoctorUser_id' => $doctor->id,
    //         'dosage' => $request->dosage,
    //         'instructions' => $request->instructions,
    //         'issue_date' => $request->issue_date,
    //     ]);

    //     // Handle file upload if provided
    //     if ($request->hasFile('prescription_file')) {
    //         $file = $request->file('prescription_file');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $path = $file->storeAs('prescriptions', $filename, 'public');
    //         $prescription->prescription_file = $path;
    //     }

    //     $prescription->save();

    //     return redirect()->route('prescriptions.index')
    //         ->with('success', 'Prescription created successfully.');
    // }

    // /**
    //  * Display the specified prescriptions for a patient.
    //  */
    // public function show($patientId)
    // {
    //     $patient = Patient::findOrFail($patientId);
    //     $prescriptions = Prescription::where('PatientUser_id', $patientId)
    //         ->orderBy('issue_date', 'desc')
    //         ->get();
        
    //     return view('doctors.prescriptions.show', compact('patient', 'prescriptions'));
    // }

    // /**
    //  * Show the form for editing the specified prescription.
    //  */
    // public function edit($id)
    // {
    //     $prescription = Prescription::findOrFail($id);
    //     $patient = Patient::findOrFail($prescription->PatientUser_id);
        
    //     return view('doctors.prescriptions.edit', compact('prescription', 'patient'));
    // }

    // /**
    //  * Update the specified prescription in storage.
    //  */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'dosage' => 'required|string|max:255',
    //         'instructions' => 'required|string',
    //         'issue_date' => 'required|date',
    //         'prescription_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    //     ]);

    //     $prescription = Prescription::findOrFail($id);
        
    //     $prescription->dosage = $request->dosage;
    //     $prescription->instructions = $request->instructions;
    //     $prescription->issue_date = $request->issue_date;

    //     // Handle file upload if provided
    //     if ($request->hasFile('prescription_file')) {
    //         // Delete old file if exists
    //         if ($prescription->prescription_file) {
    //             Storage::disk('public')->delete($prescription->prescription_file);
    //         }
            
    //         $file = $request->file('prescription_file');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $path = $file->storeAs('prescriptions', $filename, 'public');
    //         $prescription->prescription_file = $path;
    //     }

    //     $prescription->save();

    //     return redirect()->route('prescriptions.index')
    //         ->with('success', 'Prescription updated successfully.');
    // }

    // /**
    //  * Remove the specified prescription from storage.
    //  */
    // public function destroy($id)
    // {
    //     $prescription = Prescription::findOrFail($id);
    //     $patientId = $prescription->PatientUser_id;
        
    //     // Delete prescription file if exists
    //     if ($prescription->prescription_file) {
    //         Storage::disk('public')->delete($prescription->prescription_file);
    //     }
        
    //     $prescription->delete();

    //     return redirect()->route('prescriptions.index')
    //         ->with('success', 'Prescription deleted successfully.');
    // }

    // /**
    //  * View a specific prescription.
    //  */
    // public function view($id)
    // {
    //     $prescription = Prescription::with(['patient', 'doctor'])->findOrFail($id);
    //     return view('doctors.prescriptions.view', compact('prescription'));
    // }

    // /**
    //  * Upload a prescription file.
    //  */
    // public function upload(Request $request, $id)
    // {
    //     $request->validate([
    //         'prescription_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    //     ]);

    //     $prescription = Prescription::findOrFail($id);
        
    //     // Delete old file if exists
    //     if ($prescription->prescription_file) {
    //         Storage::disk('public')->delete($prescription->prescription_file);
    //     }
        
    //     $file = $request->file('prescription_file');
    //     $filename = time() . '_' . $file->getClientOriginalName();
    //     $path = $file->storeAs('prescriptions', $filename, 'public');
    //     $prescription->prescription_file = $path;
    //     $prescription->save();

    //     return redirect()->route('prescriptions.view', $prescription->prescription_id)
    //         ->with('success', 'Prescription file uploaded successfully.');
    // }
    
    // /**
    //  * Display prescriptions for the authenticated patient.
    //  */
    // public function patientPrescriptions()
    // {
    //     $patient = Auth::user();
    //     $prescriptions = Prescription::where('PatientUser_id', $patient->id)
    //         ->with('doctor')
    //         ->orderBy('issue_date', 'desc')
    //         ->get();
        
    //     return view('patients.prescriptions.index', compact('prescriptions', 'patient'));
    // }
}
