@extends('appointments.layout')

@section('content')
<h2>Appointment Confirmed!</h2>

<p><strong>Booking ID:</strong> {{ $appointment->booking_id }}</p>

<h3>Patient Information</h3>
<ul>
    <li>Name: {{ $patient->patient_name }}</li>
    <li>Date of Birth: {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') }}</li>
    <li>Phone: {{ $patient->phone }}</li>
    <li>Email: {{ $patient->email }}</li>
</ul>

<h3>Appointment Details</h3>
<ul>
    <li>Doctor: {{ $appointment->doctor->name }}</li>
    <li>Specialization: {{ $appointment->doctor->specialization->name }}</li>
    <li>
        Date: 
        @if($appointment->schedule)
            {{ \Carbon\Carbon::parse($appointment->schedule->available_date)->format('D, M j, Y') }}
        @else
            N/A
        @endif
    </li>
    <li>
        Time: 
        @if($appointment->schedule && $appointment->schedule->start_time && $appointment->schedule->end_time)
            {{ date('H:i', strtotime($appointment->schedule->start_time)) }} - {{ date('H:i', strtotime($appointment->schedule->end_time)) }}
        @else
            N/A
        @endif
    </li>
</ul>

<p>Thank you for booking your appointment!</p>
@endsection
