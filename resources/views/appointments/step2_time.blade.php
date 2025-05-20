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

    .dot.dot-1, .dot.dot-2 {
        background-color: #851216;
        border: 2px solid #851216;
    }

    .line1, .line2{
        border-top:3px solid #851216;
    }

    .select label {
        cursor: pointer;
    }


    .buttons {
        display:flex;
        justify-content: space-between;
    }

    .buttons a.back-button,
    .buttons button.next {
        width: 150px;
        border: 2px solid gray;
        background-color: white;
        font-size: 1rem;
        padding: 7px 0;
        text-align: center;
        display: inline-block;
        cursor: pointer;
        border-radius: 20px;
        color: black;
        text-decoration: none;
        box-sizing: border-box;
    }

    .buttons button.next {
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

<h2>Select Date & Time</h2>

<form method="POST" action="{{ route('appointments.step2_time') }}">
    @csrf

    @if($availableSlots->isEmpty())
        <p>No available appointment slots for this doctor.</p>
    @else
        <div>
            @foreach($availableSlots as $slot)
            <div class="select">
                <label>
                    <input type="radio" name="schedule_id" value="{{ $slot->schedule_id }}" required>
                    {{ \Carbon\Carbon::parse($slot->available_date)->format('D, M j, Y') }}
                    at {{ date('H:i', strtotime($slot->start_time)) }} - {{ date('H:i', strtotime($slot->end_time)) }}
                </label>
            </div>
            @endforeach
        </div>
    @endif

    @error('schedule_id')
        <div class="error" style="color:red;">{{ $message }}</div>
    @enderror

    <div class="buttons" style="margin-top: 20px;">
        <a href="{{ route('appointments.step1_specialist') }}" class="back-button">Back</a>
        <button class="next" type="submit" id="submit-btn" disabled>Next</button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="schedule_id"]');
    const submitBtn = document.getElementById('submit-btn');

    radios.forEach(function(radio) {
        radio.addEventListener('change', function () {
            submitBtn.disabled = false;
        });
    });
});
</script>
@endsection
