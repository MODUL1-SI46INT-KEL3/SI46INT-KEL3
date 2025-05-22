@extends('appointments.layout')

@section('content')

<style>
    h2{
        font-size: 1.5rem;
        font-weight: 600; 
        margin-bottom: 30px;
    }
 
    .select {
        border: 2px solid gray;
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 15px;
    }

    .select:hover{
        cursor: pointer;
        background-color: #ffff;
        border: 2px solid gray;
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 15px;
    }

    .dot.dot-1, .dot.dot-2, .dot.dot-3 {
        background-color: #851216;
        border: 2px solid #851216;
    }

    .line1, .line2, .line3{
        border-top:3px solid #851216;
    }

    .appoint_details {
        border: 2px solid gray;
        padding: 20px;
    }

    .info_title {
        font-weight: 600;
        text-decoration: underline;
        text-align: center;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 4px 0;
        margin-bottom: 10px
    }


    .buttons {
        display:flex;
        justify-content: space-between;
    }

    .buttons a.back-button,
    .buttons button.confirm {
        font-family: 'Poppins', serif;
        font-weight: 500;
        width: 150px;
        border: 2px solid gray;
        background-color: white;
        font-size: 1rem;
        padding: 10px 0;
        text-align: center;
        display: inline-block;
        cursor: pointer;
        border-radius: 30px;
        color: black;
        text-decoration: none;
        box-sizing: border-box;
    }

    .buttons button.confirm {
        width: 210px;
        background-color: #851216;
        border: 2px solid #851216;
        color: white;
        padding: 10px 0;
    }

    .buttons button.next:disabled {
        background-color: gray;
        border-color: gray;
        color: #ddd;
        cursor: not-allowed;
    }


</style>

<h2>Review Appointment Details</h2>

<div class="appoint_details">

    <h3 class="info_title">Patient Information</h3>

    <div class="patient_info">
        <div class="info-row">
            <span class="label">Name:</span>
            <span class="value">{{ $patient->patient_name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Date of Birth:</span>
            <span class="value">{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('M d, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Phone:</span>
            <span class="value">{{ $patient->phone }}</span>
        </div>
        <div class="info-row">
            <span class="label">Email:</span>
            <span class="value">{{ $patient->email }}</span>
        </div>
    </div>

    <h3 class="info_title">Appointment Information</h3>

    <div class="appoint_info">
        <div class="info-row">
            <span class="label">Doctor:</span>
            <span class="value">{{ $doctor->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Specialization:</span>
            <span class="value">{{ $doctor->specialization->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Appointment Date:</span>
            <span class="value">{{ \Carbon\Carbon::parse($schedule->available_date)->format('D, M j, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Appointment Time:</span>
            <span class="value">{{ date('H:i', strtotime($schedule->start_time)) }} - {{ date('H:i', strtotime($schedule->end_time)) }}</span>
        </div>
    </div>

</div>

<form method="POST" action="{{ route('appointments.step3_overview') }}">
    @csrf

    <div class="buttons" style="margin-top: 20px;">
        <a href="{{ route('appointments.step2_time') }}" class="back-button">Back</a>
        <button class="confirm" type="submit">Confirm Appointment</button>
    </div>
</form>
@endsection
