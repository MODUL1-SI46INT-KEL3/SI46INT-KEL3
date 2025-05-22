@extends('admins.index')
@section('content')
    <h1>Edit Payment</h1>
    <form action="{{ route('adminpayments.update', $payment->payment_id) }}" method="POST">
        @csrf @method('PUT')
        @include('admins.adminPayment.partials.form')
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
