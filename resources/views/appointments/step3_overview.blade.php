@extends('appointments.layout')

@section('content')
<h2>Review Appointment Details</h2>

<h3>Patient Information</h3>
<ul>
    <li>Name: {{ $patient->patient_name }}</li>
    <li>Date of Birth: {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') }}</li>
    <li>Phone: {{ $patient->phone }}</li>
    <li>Email: {{ $patient->email }}</li>
</ul>

<h3>Doctor & Appointment</h3>
<ul>
    <li>Doctor: {{ $doctor->name }}</li>
    <li>Specialization: {{ $doctor->specialization->name }}</li>
    <li>Date: {{ \Carbon\Carbon::parse($schedule->date)->format('D, M j, Y') }}</li>
    <li>Time: {{ date('H:i', strtotime($schedule->start_time)) }} - {{ date('H:i', strtotime($schedule->end_time)) }}</li>
</ul>

<form method="POST" action="{{ route('appointments.step3_overview') }}">
    @csrf
    <button type="submit">Confirm Appointment</button>
</form>
@endsection
