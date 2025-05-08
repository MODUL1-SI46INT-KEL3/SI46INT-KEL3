@extends('admins.index')
@section('content')
<h1>Create Doctor Schedule</h1>
<form action="{{ route('adminschedules.store') }}" method="POST">
    @csrf
    @include('admins.adminSchedule.partials.form')
    <button type="submit" class="btn btn-success">Submit</button>
</form>
@endsection
