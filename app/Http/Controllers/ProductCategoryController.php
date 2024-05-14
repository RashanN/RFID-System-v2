<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    //
    public function create()
    {
        return view('productcategory/create');
    }
    public function store(Request $request)
    {
        //dd($request);
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255', // Example validation rule
        ]);

        // Create the product category
        $productCategory = ProductCategory::create([
            'name' => $request->input('name'),
            // Add other fields here if needed
        ]);

        // Redirect back to the index page with success message
        return redirect()->route('product_category.index')->with('success', 'Product category created successfully!');
    }
    public function index()
    {
        $productcategories = ProductCategory::all();
        return view('productcategory/index', compact('productcategories'));
    }
    public function edit($id)
    {
    $productCategory = ProductCategory::findOrFail($id);
    return view('productcategory/edit', compact('productCategory'));
    }
    public function update(Request $request, $id)
    {
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $productCategory = ProductCategory::findOrFail($id);
    $productCategory->update($request->all());

    return redirect()->route('product_category.index')
                     ->with('success', 'Product category updated successfully');
    }
    public function destroy($id)
{
    $productCategory = ProductCategory::findOrFail($id);
    $productCategory->delete();

    return redirect()->route('product_category.index')
                     ->with('success', 'Product category deleted successfully');
}
}
