<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('doctor')->get();
        return view('admins.adminSchedule.index', compact('schedules'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('admins.adminSchedule.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctor,id',
            'available_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'is_available' => 'required|boolean'
        ]);

        Schedule::create($validated);
        return redirect()->route('adminschedules.index')->with('success', 'Schedule created.');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $doctors = Doctor::all();
        return view('admins.adminSchedule.edit', compact('schedule', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctor,id',
            'available_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'is_available' => 'required|boolean'
        ]);

        $schedule->update($validated);
        return redirect()->route('adminschedules.index')->with('success', 'Schedule updated.');
    }

    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return redirect()->route('adminschedules.index')->with('success', 'Schedule deleted.');
    }
    
    public function export()
    {
        $schedules = Schedule::with('doctor', 'patient')->get();
        $pdf = Pdf::loadView('admins.adminSchedule.pdf', compact('schedules'));
        return $pdf->download('schedules.pdf');
    }
}
 


