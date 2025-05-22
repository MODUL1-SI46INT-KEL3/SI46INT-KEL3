@extends('admins.index')
@section('content')
@include('admins.adminPayment.partials.table-style')
    <div class="d-flex justify-content-between mb-3">
        <h1>Payment List</h1>
        <a href="{{ route('adminpayments.create') }}" class="btn btn-success">Add Payment</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Item</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->payment_id }}</td>
                    <td>{{ $payment->patient->patient_name ?? 'N/A' }}</td>
                    <td>{{ $payment->item }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ $payment->payment_status }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>
                        <a href="{{ route('adminpayments.edit', $payment->payment_id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('adminpayments.destroy', $payment->payment_id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this payment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
