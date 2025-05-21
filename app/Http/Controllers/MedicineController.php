<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        if ($query) {
            $medicines = Medicine::where('medicine_name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->get();
        } else {
            $medicines = Medicine::all();
        }

        $cartCount = 0;
        if (auth()->check()) {
            $cartCount = \App\Models\CartItem::where('patient_id', auth()->id())->sum('quantity');
        }

        return view('medicines.index', compact('medicines', 'cartCount'));
    }


    public function create()
    {
        return view('medicines.create', ['nav' => 'Add Medicine']);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'medicine_name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Medicine::create($validateData);

        return redirect()->route('medicines.index')->with('success', 'Medicine has been added.');
    }

    public function show(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('medicines.show', ['medicine' => $medicine, 'nav' => 'Medicine Details - ' . $medicine->name]);
    }

    public function edit(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('medicines.edit', ['medicine' => $medicine, 'nav' => 'Edit Medicine - ' . $medicine->name]);
    }

    public function update(Request $request, string $id)
    {
        $medicine = Medicine::findOrFail($id);

        $validateData = $request->validate([
            'medicine_name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $medicine->update($validateData);

        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
    }

    public function destroy(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        
        $medicine->delete();

        return redirect()->route('medicines.index')->with('success', 'Medicine has been deleted.');
    }


}