<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\ProductCategory;


class ProductController extends Controller
{
    //
    public function create()
    {
        $productCategories = ProductCategory::all();

        // Fetch all suppliers
        $suppliers = Supplier::all();

        // Pass product categories and suppliers to the view
        return view('product.create', compact('productCategories', 'suppliers'));
    }
    public function index()
    {
        $products = Product::join('product_category', 'product.product_category_id', '=', 'product_category.id')
                            ->join('supplier', 'product.supplier_id', '=', 'supplier.id')
                            ->select('product.*', 'product_category.name as category_name','supplier.name as supplier_name')
                            ->get();


        // Pass the products to the view
        return view('product.index', compact('products'));
    }
    public function store(Request $request)
    {

        $product = new Product;
        $validatedData = $request->validate([
            'name' => 'required|string',
            'showprice' => 'required|numeric',
            'unitprice' => 'required|numeric',
            'stock_level' => 'required|integer',
            'description' => 'required|string',
            'product_category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
        ]);

       
        try {
            // Create a new Product instance
            $product = new Product;

            // Assign validated data to the product attributes
            $product->name = $validatedData['name'];
            $product->showprice = $validatedData['showprice'];
            $product->unitprice = $validatedData['unitprice'];
            $product->stock_level = $validatedData['stock_level'];
            $product->description = $validatedData['description'];
            $product->product_category_id = $validatedData['product_category_id'];
            $product->supplier_id = $validatedData['supplier_id'];

            // Save the product
            $product->save();

            // Redirect back to the form with a success message
            return redirect()->route('product.create')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
           // Log::error('Error occurred while saving product: ' . $e->getMessage());
            // If an error occurs during product creation, redirect back with an error message
            return redirect()->route('product.create')->with('error', 'Failed to create product. Please try again.');
        }


            // Create a new Product instance


            // Redirect back to the form with a success message


    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);

    // Get all product categories
    $categories = ProductCategory::all();
    $suppliers = Supplier::all();
    //Pass the product data and product categories to the edit view
    return view('product.edit', compact('product', 'categories','suppliers'));
    }

    public function update(Request $request, $id)
    {

    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'showprice' => 'required|numeric',
        'unitprice' => 'required|numeric',
        'stock_level' => 'required|integer',
        'description' => 'required|string',
        'product_category_id' => 'required|integer',
        'supplier_id' => 'required|integer',
    ]);
  //  dd($validatedData);
    // Find the product by its ID
    $product = Product::findOrFail($id);

    // Update the product attributes
    $product->fill($validatedData)->save();

    // Redirect back to the edit form with a success message
    return redirect()->route('product.edit', $product->id)->with('success', 'Product updated successfully!');
}


}
