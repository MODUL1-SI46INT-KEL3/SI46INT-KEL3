@extends('admins.index')

@section('content')
<div class="container mt-4">
    <h1>{{ $nav }}</h1>

    <form action="{{ route('adminAppointment.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="patient_id">Patient</label>
            <select name="patient_id" id="patient_id" class="form-control" required>
                <option value="">-- Select Patient --</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
                        {{ $patient->patient_name }}
                    </option>
                @endforeach
            </select>
            @error('patient_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="doctor_id">Doctor</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                <option value="">-- Select Doctor --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
            @error('doctor_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="schedule_id">Schedule</label>
            <select name="schedule_id" id="schedule_id" class="form-control" required>
                <option value="">-- Select Schedule --</option>
                @foreach($schedules as $schedule)
                    <option value="{{ $schedule->schedule_id }}" {{ old('schedule_id', $appointment->schedule_id) == $schedule->schedule_id ? 'selected' : '' }}>
                        {{ $schedule->available_date }} ({{ $schedule->start_time }} - {{ $schedule->end_time }})
                    </option>
                @endforeach
            </select>
            @error('schedule_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ old('status', $appointment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="canceled" {{ old('status', $appointment->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                <option value="done" {{ old('status', $appointment->status) == 'done' ? 'selected' : '' }}>Done</option>
                <option value="no show" {{ old('status', $appointment->status) == 'no show' ? 'selected' : '' }}>No Show</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Appointment</button>
        <a href="{{ route('adminAppointment.index') }}" class="btn btn-danger">Cancel</a>
    </form>
</div>
@endsection
