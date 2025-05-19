@extends('appointments.layout')

@section('content')
<h2>Select Date & Time</h2>

<form method="POST" action="{{ route('appointments.step2_time') }}">
    @csrf

    @if($availableSlots->isEmpty())
        <p>No available appointment slots for this doctor.</p>
    @else
        <div>
            @foreach($availableSlots as $slot)
                <label>
                    <input type="radio" name="schedule_id" value="{{ $slot->id }}" required>
                    {{ \Carbon\Carbon::parse($slot->date)->format('D, M j, Y') }} at {{ date('H:i', strtotime($slot->start_time)) }} - {{ date('H:i', strtotime($slot->end_time)) }}
                </label><br>
            @endforeach
        </div>
    @endif

    @error('schedule_id')
        <div class="error">{{ $message }}</div>
    @enderror

    <div class="buttons">
        <a href="{{ route('patients.index') }}" class="back-button">Back</a>
        <button class="next" type="submit" id="submit-btn" disabled>Next</button>
    </div>
</form>
@endsection
