@extends('admins.index')
@section('content')
@include('admins.adminSchedule.partials.table-style')
<div class="form-container">
    <h1>Edit Schedule</h1>
    <form action="{{ route('adminschedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admins.adminSchedule.partials.form', ['schedule' => $schedule])
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
