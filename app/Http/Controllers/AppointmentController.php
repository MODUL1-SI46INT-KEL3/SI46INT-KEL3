<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Step 1: Select Specialization and Doctor
    public function createStep1()
    {
        $specializations = Specialization::with('doctor')->get();

        return view('appointments.step1_specialist', compact('specializations'));
    }

    public function postStep1(Request $request)
    {
        $request->validate([
            'specialization_id' => 'required|exists:specializations,id',
            'doctor_id' => 'required|exists:doctor,id', // assuming your table is 'doctor'
        ]);

        session([
            'appointment.specialization_id' => $request->specialization_id,
            'appointment.doctor_id' => $request->doctor_id,
        ]);

        return redirect()->route('appointments.step2_time');
    }

    // Step 2: Select Available Schedule Slot
    public function createStep2()
    {
        $doctorId = session('appointment.doctor_id');

        if (!$doctorId) {
            return redirect()->route('appointments.step1_specialist')->withErrors('Please select a doctor first.');
        }

        $availableSlots = Schedule::where('doctor_id', $doctorId)
            ->where('is_available', true)
            ->where('available_date', '>=', now()->toDateString())
            ->orderBy('available_date')
            ->orderBy('start_time')
            ->get();

        return view('appointments.step2_time', compact('availableSlots'));
    }

    public function postStep2(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,schedule_id',
        ]);

        $schedule = Schedule::findOrFail($request->schedule_id);

        if ($schedule->doctor_id != session('appointment.doctor_id')) {
            return back()->withErrors('Selected schedule does not match the chosen doctor.');
        }

        session(['appointment.schedule_id' => $request->schedule_id]);

        return redirect()->route('appointments.step3_overview');
    }

    // Step 3: Overview and Confirm Appointment
    public function createStep3()
    {
        $patient = Auth::user();
        $appointmentData = session('appointment');

        if (empty($appointmentData['doctor_id']) || empty($appointmentData['schedule_id'])) {
            return redirect()->route('appointments.step1_specialist')->withErrors('Incomplete appointment data.');
        }

        $doctor = Doctor::with('specialization')->findOrFail($appointmentData['doctor_id']);
        $schedule = Schedule::findOrFail($appointmentData['schedule_id']);

        return view('appointments.step3_overview', compact('patient', 'doctor', 'schedule'));
    }

    public function postStep3(Request $request)
    {
        // You can add validation or additional logic here if needed

        return redirect()->route('appointments.step4_confirmation');
    }

    // Step 4: Final Confirmation and Save Appointment
    public function createStep4()
    {
        $appointmentData = session('appointment');
        $patient = Auth::user();

        if (empty($appointmentData['doctor_id']) || empty($appointmentData['schedule_id'])) {
            return redirect()->route('appointments.step1_specialist')->withErrors('Incomplete appointment data.');
        }

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $appointmentData['doctor_id'],
            'schedule_id' => $appointmentData['schedule_id'],
            'booking_id' => \Illuminate\Support\Str::uuid()->toString(),
        ]);

        // Mark schedule as unavailable
        $schedule = Schedule::find($appointmentData['schedule_id']);
        if ($schedule) {
            $schedule->is_available = false;
            $schedule->save();
        }

        session()->forget('appointment');

        $appointment->load('doctor.specialization', 'schedule');

        return view('appointments.step4_confirmation', compact('appointment', 'patient'));
    }

    public function getDoctorsBySpecialization($id)
    {   
        $doctors = Doctor::where('specialization_id', $id)->get(['id', 'name']);
        return response()->json($doctors);
    }
}
