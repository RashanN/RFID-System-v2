<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    //
    public function create()
    {
        return view('customer.create');
    }
    public function store(Request $request)
    {
    //   dd($request);
    $customer = new Customer;
    // Validate incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'contact' => 'nullable|string|max:10|min:10',
         'email' => 'nullable|email',

    ]);
   ( $validatedData);
    try {
        // Create a new Customer instance

        $customer = new Customer;

        // Assign validated data to the customer attributes
        $customer->name = $validatedData['name'];
        $customer->contact = $validatedData['contact'];
        $customer->email = $request->input('email');

            try {
                $customer->save();
                
            } catch (\Exception $e) {
            
            }
        // Redirect back to the form with a success message
        return redirect()->route('customer.index')->with('success', 'Customer created successfully!');
    } catch (\Exception $e) {
        // If an error occurs during customer creation, redirect back with an error message
        return redirect()->route('customer.create')->with('error', 'error', $e->getMessage());
    }
    }
    public function index()
    {
        $customers = Customer::all();

        return view('customer.index', compact('customers'));
    }
    public function show()
    {
    $customers = Customer::all();

    return view('customer.index', compact('customers'));
    }
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }
    public function update(Request $request, $id)
{

    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'contact' => 'nullable|string',
        'email' => 'nullable|email',
    ]);

    try {
        // Find the customer by its ID
        $customer = Customer::findOrFail($id);

        // Update the customer attributes
        $customer->update($validatedData);

        // Reload the customer instance to reflect the updated data
        $customer = $customer->fresh();

        // Redirect back to the edit form with a success message
        return redirect()->route('customer.index', $customer->id)->with('success', 'Customer updated successfully!');
    } catch (\Exception $e) {
        // If an error occurs, log the error and redirect back to the edit form with an error message
        Log::error('Error updating customer: ' . $e->getMessage());
        return redirect()->route('customer.edit', $id)->with('error', 'Failed to update customer. Please try again.');
    }
}

    public function destroy($id)
    {
        // Find the customer by its ID
        $customer = Customer::findOrFail($id);

        // Delete the customer
        $customer->delete();

        // Redirect back to the customer index page with a success message
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully!');
    }
    public function search(Request $request)
{
    $query = $request->input('query');
    $customers = Customer::where('name', 'like', '%' . $query . '%')->get();
    return response()->json($customers);
}


    // Other methods...
}
