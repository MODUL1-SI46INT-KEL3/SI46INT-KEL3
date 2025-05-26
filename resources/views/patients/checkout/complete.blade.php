@extends('patients.checkout.partials.app')

@section('content')
<div style="max-width: 1000px; margin: 40px auto; padding: 30px 40px; background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(255, 0, 0, 0.1); display: flex; gap: 40px;">

    <!--Purchase Details -->
    <div style="flex: 1;">
        <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">Purchase Complete</h2>
        <p style="margin-bottom: 20px;">Thank you, and get well soon!</p>
        
        <hr style="margin: 20px 0;">

        <h4 style="margin-bottom: 10px; font-weight: 600;">Purchase details</h4>

        <table style="width: 100%; font-size: 14px;">
            <tr>
                <td>Cost (Item purchased)</td>
                <td style="text-align: right;">Rp{{ number_format($grandTotal ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Service Fee (included)</td>
                <td style="text-align: right;">Rp500</td>
            </tr>
            <tr>
                <td>Service Fee 2 (included)</td>
                <td style="text-align: right;">Rp500</td>
            </tr>
            <tr style="font-weight: bold;">
                <td>Total Payment</td>
                <td style="text-align: right;">Rp{{ number_format($grandTotal ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px;"><strong>Paid via:</strong> {{ $paymentMethod }}</p>
    </div>

    <!-- Review 
    <div style="flex: 1; background: #f9f9f9; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: center; text-align: center;">
        <h4 style="margin-bottom: 10px;">Review us!</h4>
        <p style="margin-bottom: 20px;">How was your experience shopping with us?</p>


        <div style="background: white; border-radius: 10px; padding: 20px; border: 1px solid #ddd; min-height: 180px;">

            <div style="font-size: 24px; color: #ffc107; margin-bottom: 10px;">
                ★ ★ ★ ★ ★
            </div>

            <textarea disabled placeholder="Sleek UI, thank you!" 
                style="width: 100%; border: none; background: #f2f2f2; padding: 10px; border-radius: 8px; resize: none;" 
                rows="4"></textarea>

            <button disabled style="margin-top: 15px; width: 100%; padding: 10px; background-color: #b30000; color: white; border: none; border-radius: 8px; font-weight: bold;">Submit Review</button>
        </div>

        <a href="{{ route('patients.index') }}" style="margin-top: 20px; display: inline-block; background: #a00; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;">Back to Home</a>
    </div>-->

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

