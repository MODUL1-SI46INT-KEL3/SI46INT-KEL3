<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Patient;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('patient')->get();
        return view('admins.adminPayment.index', compact('payments'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('admins.adminPayment.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patient,id',
            'item' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:Credit Card,Debit Card,Cash,Insurance,Online Payment',
            'payment_status' => 'required|in:Pending,Completed,Failed,Refunded',
        ]);

        Payment::create($request->all());
        return redirect()->route('adminpayments.index')->with('success', 'Payment added successfully.');
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $patients = Patient::all();
        return view('admins.adminPayment.edit', compact('payment', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patient,id',
            'item' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:Credit Card,Debit Card,Cash,Insurance,Online Payment',
            'payment_status' => 'required|in:Pending,Completed,Failed,Refunded',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        return redirect()->route('adminpayments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();
        return redirect()->route('adminpayments.index')->with('success', 'Payment deleted successfully.');
    }
    public function showPaymentSuccess(Request $request)
{
    // Data yang sudah ada
    $grandTotal = $request->get('grandTotal');
    $paymentMethod = $request->get('paymentMethod');
    
    // Tambahkan reviews untuk medicine
    $medicineReviews = Review::where('category', 'shop')
                            ->latest()
                            ->take(5)
                            ->get();
    
    return view('medicine.payment-success', compact(
        'grandTotal', 
        'paymentMethod', 
        'medicineReviews'
    ));
}
}

