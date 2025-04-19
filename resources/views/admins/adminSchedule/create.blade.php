@extends('admins.index')
@section('content')
@include('admins.schedule.partials.style')
<div class="form-container">
    <h1>Create Schedule</h1>
    <form action="{{ route('schedules.store') }}" method="POST">
        @csrf
        @include('admins.schedule.partials.form')
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
