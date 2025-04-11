<?php
namespace App\Http\Controllers;
use App\Models\Medicine;
use Illuminate\Http\Request;
use PDF;

class AdminMedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all(); 
        $nav = 'Medicines';
        return view('admins.adminmedicine.index', compact('medicines', 'nav')); 
    }

    public function create() 
    {
        $nav = 'Add Medicine';
        return view('admins.adminmedicine.create', compact('nav'));
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
        return redirect()->route('adminmedicine.index')->with('success', 'Medicine has been added.');
    }

    public function show(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        $nav = 'Medicine Details - ' . $medicine->medicine_name;
        return view('adminmedicine.show', compact('medicine', 'nav'));
    }

    public function edit(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        $nav = 'Edit Medicine - ' . $medicine->medicine_name;
        return view('admins.adminmedicine.edit', compact('medicine', 'nav'));
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
        return redirect()->route('adminmedicine.index')->with('success', 'Medicine updated successfully.');
    }

    public function destroy(string $id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return redirect()->route('adminmedicine.index')->with('success', 'Medicine has been deleted.');
    }
    
    public function medicine_export()
    {
        $medicines = Medicine::all();
        $nav = 'Medicines List';
        $pdf = PDF::loadView('admins.adminmedicine.pdf', compact('medicines', 'nav'));
        return $pdf->download('medicines.pdf');
    }
}