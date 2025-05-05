<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Show all schedules
    public function index()
    {
        $schedules = Schedule::with('doctor', 'patient')->get();
        return view('admins.adminSchedule.index', compact('schedules'));
    }

    // Show create form
    public function create()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admins.adminSchedule.create', compact('doctors', 'patients'));
    }

    // Store new schedule
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctor,id',
            'patient_id' => 'required|exists:patient,id',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|string'
        ]);

        Schedule::create($validated);
        return redirect()->route('adminschedules.index')->with('success', 'Schedule created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admins.adminSchedule.edit', compact('schedule', 'doctors', 'patients'));
    }

    // Update existing schedule
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctor,id',
            'patient_id' => 'required|exists:patient,id',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|string'
        ]);

        $schedule->update($validated);
        return redirect()->route('adminschedules.index')->with('success', 'Schedule updated successfully.');
    }

    // Delete a schedule
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('adminschedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
