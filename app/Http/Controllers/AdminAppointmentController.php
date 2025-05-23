<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $nav = 'Appointments';

        $appointments = Appointment::with(['patient', 'doctor', 'schedule'])
            ->when($request->search, function ($query, $search) {
                $query->whereHas('patient', function($q) use ($search) {
                    $q->where('patient_name', 'like', "%$search%");
                });
            })
            ->get();

        return view('admins.adminAppointment.index', compact('appointments', 'nav'));
    }

    public function create()
    {
        $nav = 'Add Appointment';

        $patients = Patient::all();
        $doctors = Doctor::all();
        $schedules = Schedule::where('is_available', true)->get();

        return view('admins.adminAppointment.create', compact('nav', 'patients', 'doctors', 'schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patient,id',
            'doctor_id' => 'required|exists:doctor,id',
            'schedule_id' => 'required|exists:schedules,schedule_id',
        ]);

        // Check if schedule is available
        $schedule = Schedule::findOrFail($validated['schedule_id']);
        if (!$schedule->is_available) {
            return back()->withErrors(['schedule_id' => 'Selected schedule is not available'])->withInput();
        }

        $appointment = Appointment::create($validated);

        // Mark schedule as unavailable
        $schedule->update(['is_available' => false]);

        return redirect()->route('adminAppointment.index')->with('success', 'Appointment created successfully.');
    }

    public function edit($id)
    {
        $nav = 'Edit Appointment';

        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        $schedules = Schedule::where(function ($query) use ($appointment) {
            $query->where('is_available', true)
                  ->orWhere('schedule_id', $appointment->schedule_id);
        })->get();

        return view('admins.adminAppointment.edit', compact('nav', 'appointment', 'patients', 'doctors', 'schedules'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patient,id',
            'doctor_id' => 'required|exists:doctor,id',
            'schedule_id' => 'required|exists:schedules,schedule_id',
            'status' => 'required|in:pending,canceled,done,no show',
        ]);

        // Handle schedule availability if schedule or status changed
        if ($appointment->schedule_id != $validated['schedule_id'] || $appointment->status != $validated['status']) {
            // If schedule changed, mark old schedule available and new schedule unavailable
            if ($appointment->schedule_id != $validated['schedule_id']) {
                $oldSchedule = Schedule::find($appointment->schedule_id);
                if ($oldSchedule) {
                    $oldSchedule->update(['is_available' => true]);
                }

                $newSchedule = Schedule::findOrFail($validated['schedule_id']);
                if (!$newSchedule->is_available) {
                    return back()->withErrors(['schedule_id' => 'Selected schedule is not available'])->withInput();
                }
                $newSchedule->update(['is_available' => false]);
            }

            // If status changed to canceled, mark schedule available
            if ($appointment->status != 'canceled' && $validated['status'] == 'canceled') {
                $schedule = Schedule::find($appointment->schedule_id);
                if ($schedule) {
                    $schedule->update(['is_available' => true]);
                }
            }

            // If status changed from canceled to something else, mark schedule unavailable
            if ($appointment->status == 'canceled' && $validated['status'] != 'canceled') {
                $schedule = Schedule::find($validated['schedule_id']);
                if ($schedule && $schedule->is_available) {
                    $schedule->update(['is_available' => false]);
                }
            }
        }

        $appointment->update($validated);

        return redirect()->route('adminAppointment.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Mark schedule available again
        $schedule = Schedule::find($appointment->schedule_id);
        if ($schedule) {
            $schedule->update(['is_available' => true]);
        }

        $appointment->delete();

        return redirect()->route('adminAppointment.index')->with('success', 'Appointment deleted successfully.');
    }
}
