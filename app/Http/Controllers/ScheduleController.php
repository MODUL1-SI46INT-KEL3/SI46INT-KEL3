<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('doctor', 'patient')->get();
        return view('admins.schedule.index', compact('schedules'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admins.schedule.create', compact('doctors', 'patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id_card',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|string'
        ]);
        Schedule::create($validated);
        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admins.schedule.edit', compact('schedule', 'doctors', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|string'
        ]);
        $schedule->update($validated);
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
