<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //
    public function create()
    {
        return view('supplier.create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
        ]);

        // Create the supplier with the validated data
        Supplier::create($validatedData);

        // Redirect back to the supplier index page with a success message
        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully.');
    }
    public function index()
    {
        // Retrieve all suppliers from the database
        $suppliers = Supplier::all();

        // Return the suppliers index view with the retrieved suppliers
        return view('supplier.index', compact('suppliers'));
    }
    public function edit($id)
    {
        // Find the supplier by its ID
        $supplier = Supplier::findOrFail($id);

        // Return the supplier edit view with the retrieved supplier
        return view('supplier.edit', compact('supplier'));
    }
    public function update(Request $request, $id)
    {
        // Find the supplier by its ID
        $supplier = Supplier::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'contact' => 'required|string',
        ]);

        // Update the supplier's attributes with the validated data
        $supplier->update($validatedData);

        // Redirect back to the edit form with a success message
        return redirect()->route('supplier.edit', $supplier->id)->with('success', 'Supplier updated successfully!');
    }
    public function destroy($id)
    {
        // Find the supplier by its ID
        $supplier = Supplier::findOrFail($id);

        // Delete the supplier
        $supplier->delete();

        // Redirect back to the supplier index page with a success message
        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully!');
    }

}
