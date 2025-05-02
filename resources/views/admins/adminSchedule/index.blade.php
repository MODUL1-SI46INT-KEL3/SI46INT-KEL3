@extends('admins.index')
@section('content')
@include('admins.adminSchedule.partials.table-style')
@include('admins.adminSchedule.partials.sweetalert')
<div class="container">
    <div class="header">
        <h1>Schedule List</h1>
        <a href="{{ route('adminschedules.create') }}" class="btn btn-primary">Add Schedule</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor</th>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $index => $schedule)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $schedule->doctor->name }}</td>
                <td>{{ $schedule->patient->patient_name }}</td>
                <td>{{ $schedule->date }}</td>
                <td>{{ $schedule->time }}</td>
                <td>{{ $schedule->status }}</td>
                <td>
                    <a href="{{ route('adminschedules.edit', $schedule->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('adminschedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="confirmDelete(event)">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
