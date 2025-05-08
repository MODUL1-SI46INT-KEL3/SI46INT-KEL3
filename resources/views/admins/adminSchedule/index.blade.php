@extends('admins.index')
@section('content')
@include('admins.adminSchedule.partials.table-style')
<h1>Doctor Schedules</h1>
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('adminschedules.create') }}" class="btn btn-primary mr-2">
        Add Schedule
    </a>
    <a href="{{ route('adminschedules.export') }}" class="btn btn-secondary mr-2">
        Export to PDF
    </a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Doctor</th>
            <th>Date</th>
            <th>Start</th>
            <th>End</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($schedules as $schedule)
        <tr>
            <td>{{ $schedule->schedule_id }}</td>
            <td>{{ $schedule->doctor->name }}</td>
            <td>{{ $schedule->available_date }}</td>
            <td>{{ $schedule->start_time }}</td>
            <td>{{ $schedule->end_time }}</td>
            <td>{{ $schedule->is_available ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('adminschedules.edit', $schedule->schedule_id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('adminschedules.destroy', $schedule->schedule_id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete this schedule?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
