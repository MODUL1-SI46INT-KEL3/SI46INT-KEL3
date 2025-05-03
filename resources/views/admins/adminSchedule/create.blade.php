@extends('admins.index')
@section('content')
@include('admins.adminSchedule.partials.table-style')
<div class="form-container">
    <h1>Create Schedule</h1>
    <form action="{{ route('adminschedules.store') }}" method="POST">
        @csrf
        @include('admins.adminSchedule.partials.form')
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
