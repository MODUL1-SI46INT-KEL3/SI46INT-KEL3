@extends('admins.index')
@section('content')
<h1>Edit Doctor Schedule</h1>
<form action="{{ route('adminschedules.update', $schedule->schedule_id) }}" method="POST">
    @csrf @method('PUT')
    @include('admins.adminSchedule.partials.form', ['schedule' => $schedule])
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
