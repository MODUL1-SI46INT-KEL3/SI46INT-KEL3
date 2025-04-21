@extends('admins.index')
@section('content')
@include('admins.schedule.partials.style')
<div class="form-container">
    <h1>Edit Schedule</h1>
    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admins.schedule.partials.form', ['schedule' => $schedule])
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
