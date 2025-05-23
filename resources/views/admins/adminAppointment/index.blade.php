@extends('admins.index')

@section('content')

<style>
    .table th {
        background-color: #851216;
        color: white;
    }

    .search-bar {
        margin: 5px;
    }

    .search_button, .clearsearch_button {
        border: 2px solid rgb(26, 26, 26);
        background-color:rgb(237, 237, 237);
        border-radius: 10px;
        padding: 5px 10px;
        color: black;
        text-decoration: none;
    }

    .search_button:hover {
        background-color: #851216;
        border: 2px solid white;
        color: white;
    }

    .clearsearch_button:hover {
        background-color:rgb(83, 83, 83);
        border: 2px solid white;
        color: white;
    }

</style>
<div class="container" style="margin:50px 0px;">

    <div class="header" style="display:flex; justify-content: space-between;">
        <h1>{{ $nav }}</h1>

        <div>
            <a href="{{ route('adminAppointment.create') }}" class="btn btn-primary">Add Appointment</a>
            <a href="{{ route('adminPatient.appointment_export') }}" class="btn btn-secondary">Export PDF</a>
        </div>
    </div>

    <form class="search-bar" action="{{ route('adminAppointment.index') }}" method="GET" style="margin-bottom: 20px;">
            <div>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search patient..." 
                    value="{{ request('search') }}" 
                    style="padding: 8px; width: 300px; border-radius: 10px; border: 1px solid #ccc;"
                >
                <button type="submit" class="search_button">Search</button>
            </div>
        @if(request('search'))
            <a href="{{ route('adminAppointment.index') }}" class="clearsearch_button">Clear</a>
        @endif
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Schedule</th>
                <th>Status</th>
                <th>Booking ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $index => $appointment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $appointment->patient->patient_name ?? '-' }}</td>
                    <td>{{ $appointment->doctor->name ?? '-' }}</td>
                    <td>
                        @if($appointment->schedule)
                            {{ \Carbon\Carbon::parse($appointment->schedule->available_date)->format('D Y-m-d') }}
                            ({{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }})
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <span class="badge 
                            @switch($appointment->status)
                                @case('pending') bg-warning @break
                                @case('canceled') bg-danger @break
                                @case('done') bg-success @break
                                @case('no show') bg-secondary @break
                            @endswitch">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td>{{ $appointment->booking_id }}</td>
                    <td>
                        <a href="{{ route('adminAppointment.edit', $appointment->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('adminAppointment.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No appointments found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection