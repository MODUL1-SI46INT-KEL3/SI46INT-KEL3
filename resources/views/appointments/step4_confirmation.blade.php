@extends('appointments.layout')

@section('content')

<style>
    h2{
        font-size: 1.5rem;
        font-weight: 600; 
        margin-bottom: 30px;
    }

    .appoint_details {
        border: 2px solid gray;
        padding: 20px;
    }

    .info_title {
        height: 30px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 4px 0;
        margin-bottom: 10px;
    }

    .label {
        font-weight: 600;
    }

    .buttons {
        display:flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .buttons a.finish-button {
        font-family: 'Poppins', serif;
        font-weight: 500;
        width: 150px;
        border: 2px solid #851216;
        background-color: #851216;
        font-size: 1rem;
        padding: 10px 0;
        text-align: center;
        display: inline-block;
        cursor: pointer;
        border-radius: 30px;
        color: white;
        text-decoration: none;
        box-sizing: border-box;
    }

    .box_title {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        gap: 10px;
    }

    .box_title img{
        width: 70px;

    }
</style>

<div class="box_title">
    <h2>Appointment Confirmed!</h2>
    <div>
        <img src="{{ asset('icons/check.png') }}" alt="Telkomedika">
    </div>
</div>

<div class="appoint_details">

    <div class="info-row">
        <span class="label">Booking ID:</span>
        <span class="value">{{ $appointment->booking_id }}</span>
    </div>

    <div class="info_title"></div>

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

    <div class="info_title"></div>

    <div class="appoint_info">
        <div class="info-row">
            <span class="label">Doctor:</span>
            <span class="value">{{ $appointment->doctor->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Specialization:</span>
            <span class="value">{{ $appointment->doctor->specialization->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Date:</span>
            <span class="value">
                @if($appointment->schedule)
                    {{ \Carbon\Carbon::parse($appointment->schedule->available_date)->format('D, M j, Y') }}
                @else
                    N/A
                @endif
            </span>
        </div>
        <div class="info-row">
            <span class="label">Time:</span>
            <span class="value">
                @if($appointment->schedule && $appointment->schedule->start_time && $appointment->schedule->end_time)
                    {{ date('H:i', strtotime($appointment->schedule->start_time)) }} - {{ date('H:i', strtotime($appointment->schedule->end_time)) }}
                @else
                    N/A
                @endif
            </span>
        </div>
    </div>

</div>

<div class="buttons">
    <a href="{{ route('patients.index') }}" class="finish-button">Finish</a>
</div>

@endsection
