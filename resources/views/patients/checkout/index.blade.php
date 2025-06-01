@extends('patients.checkout.partials.app')
@section('content')
<div style="max-width: 800px; margin: 40px auto; padding: 30px; background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(255, 0, 0, 0.1);">
    <h2 style="text-align: left; font-size: 28px; font-weight: bold; margin-bottom: 20px;">Checkout</h2>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
            <tr style="border-bottom: 2px solid #ccc;">
                <th style="text-align: left; padding: 12px;">Item</th>
                <th style="text-align: center; padding: 12px;">Qty</th>
                <th style="text-align: right; padding: 12px;">Price</th>
                <th style="text-align: right; padding: 12px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px;">{{ $item->medicine->medicine_name }}</td>
                <td style="text-align: center; padding: 12px;">{{ $item->quantity }}</td>
                <td style="text-align: right; padding: 12px;">Rp{{ number_format($item->medicine->price, 0, ',', '.') }}</td>
                <td style="text-align: right; padding: 12px;">Rp{{ number_format($item->medicine->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px;">Service Fee</td>
                <td style="text-align: center; padding: 12px;">-</td>
                <td style="text-align: right; padding: 12px;">Rp 500</td>
                <td style="text-align: right; padding: 12px;">Rp 500</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px;">Service Fee 2</td>
                <td style="text-align: center; padding: 12px;">-</td>
                <td style="text-align: right; padding: 12px;">Rp 500</td>
                <td style="text-align: right; padding: 12px;">Rp 500</td>
            </tr>
        </tbody>
    </table>

    <div style="border-top: 1px solid #ccc; padding-top: 15px; margin-top: 10px; text-align: right;">
        <p style="font-size: 20px; font-weight: bold;">Total: Rp{{ number_format($grandTotal, 0, ',', '.') }}</p>
    </div>

    <form method="POST" action="{{ route('checkout.pay') }}" style="margin-top: 30px;">
        @csrf

        <label for="payment_method" style="font-weight: 600;">Payment Method:</label>
        <select name="payment_method" id="payment_method" required
            style="width: 100%; padding: 10px; margin-top: 8px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 8px;">
            <option value="">-- Select --</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Debit Card">Debit Card</option>
            <option value="Cash">Cash</option>
            <option value="Insurance">Insurance</option>
            <option value="Online Payment">Online Payment</option>
        </select>

        <button type="submit" style="
            width: 100%;
            background-color: #b30000;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        ">Pay</button>
    </form>
</div>
@endsection

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
