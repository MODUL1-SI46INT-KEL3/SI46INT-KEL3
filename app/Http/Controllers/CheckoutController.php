<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('medicine')
            ->where('patient_id', Auth::id())
            ->where('selected', 1)
            ->get();

        $total = $cartItems->sum(fn($item) => $item->medicine->price * $item->quantity);
        $serviceFee = 1000; // example
        $grandTotal = $total + $serviceFee;

        return view('patients.checkout.index', compact('cartItems', 'total', 'serviceFee', 'grandTotal'));
    }


    public function pay(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:Credit Card,Debit Card,Cash,Insurance,Online Payment',
        ]);

        $patientId = Auth::id();
        $cartItems = CartItem::with('medicine')
            ->where('patient_id', $patientId)
            ->where('selected', 1)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'No selected items in cart.');
        }

        $total = $cartItems->sum(fn($item) => $item->medicine->price * $item->quantity);
        $serviceFee = 1000;
        $grandTotal = $total + $serviceFee;

        $itemsDescription = $cartItems->map(function ($item) {
            return $item->medicine->medicine_name . ' x ' . $item->quantity;
        })->implode(', ');

        $payment = DB::transaction(function () use ($patientId, $grandTotal, $request, $itemsDescription) {
            $payment = Payment::create([
                'patient_id'     => $patientId,
                'amount'         => $grandTotal,
                'payment_method' => $request->payment_method,
                'payment_status' => 'Completed',
                'item'           => $itemsDescription,
            ]);

            // Only delete the items that were selected
            CartItem::where('patient_id', $patientId)->where('selected', 1)->delete();

            return $payment;
        });

        return redirect()->route('checkout.complete', [
            'grandTotal' => $grandTotal,
            'payment_method' => $request->payment_method,
        ]);
    }

    public function complete(Request $request)
    {
        $grandTotal = $request->query('grandTotal');
        $paymentMethod = $request->query('payment_method');

        if (!$grandTotal || !$paymentMethod) {
            return redirect()->route('checkout')->with('error', 'Missing payment details.');
        }

        return view('patients.checkout.complete', compact('grandTotal', 'paymentMethod'));
    }

}
