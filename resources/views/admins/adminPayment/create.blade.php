@extends('admins.index')
@section('content')
    <h1>Add Payment</h1>
    <form action="{{ route('adminpayments.store') }}" method="POST">
        @csrf
        @include('admins.adminPayment.partials.form')
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
