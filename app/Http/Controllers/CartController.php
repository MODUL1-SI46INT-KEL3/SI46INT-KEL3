<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
public function index()
{
    $cartItems = Auth::user()->cartItems()->with('Medicine')->get();
    return view('patients.cart.index', compact(var_name: 'cartItems'));
}

public function add(Request $request, $medicineId)
{
    $patient = Auth::user();

    $cartItem = CartItem::firstOrCreate(
        ['patient_id' => $patient->id, 'medicine_id' => $medicineId],
        ['quantity' => 0]
    );

    $cartItem->increment('quantity', $request->input('quantity', 1));

    return back()->with('success', 'Item added to cart.');
}

public function remove($id)
{
    $patientId = auth()->id();

    $cartItem = CartItem::where('id', $id)
                ->where('patient_id', $patientId)
                ->first();

    if (!$cartItem) {
        return redirect()->back()->with('error', 'Item not found.');
    }

    $cartItem->delete();

    return redirect()->back()->with('success', 'Item removed from cart.');
}

public function increase($id)
{
    $medicine = CartItem::where('id', $id)->where('patient_id', auth()->id())->firstOrFail();
    $medicine->quantity += 1;
    $medicine->save();

    return redirect()->back();
}

public function decrease($id)
{
    $medicine = CartItem::where('id', $id)->where('patient_id', auth()->id())->firstOrFail();

    if ($medicine->quantity > 1) {
        $medicine->quantity -= 1;
        $medicine->save();
    } else {
        $medicine->delete();
    }

    return redirect()->back();
}

public function toggleSelect($id)
{
    $cartItem = CartItem::where('id', $id)
        ->where('patient_id', Auth::id())
        ->firstOrFail();

    $cartItem->selected = !$cartItem->selected;
    $cartItem->save();

    return response()->json(['selected' => $cartItem->selected]);
}

}
