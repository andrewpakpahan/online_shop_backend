<?php

// Import necessary classes
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

// Define the ProductController class
class ProductController extends Controller
{
    // Define the index method for fetching all products
    public function index()
    {
        // Fetch all products from the database
        $products = Product::all();
        
        // Return a JSON response with a success message and the fetched products
        return response()->json(['message' => 'Successfully fetched products', 'data' => $products], 200);
    }

    // Define the store method for creating a new product
    public function store(Request $request)
    {
        // Create a new product with the data provided in the request
        $product = Product::create($request->all());
        
        // Return a JSON response with a success message and the created product
        return response()->json(['message' => 'Product successfully created', 'data' => $product], 201);
    }

    // Define the show method for fetching a specific product
    public function show(Product $product)
    {
        // Return a JSON response with a success message and the fetched product
        return response()->json(['message' => 'Successfully fetched product', 'data' => $product], 200);
    }

    // Define the update method for updating a specific product
    public function update(Request $request, Product $product)
    {
        // Update the product with the data provided in the request
        $product->update($request->all());
        
        // Return a JSON response with a success message and the updated product
        return response()->json(['message' => 'Product successfully updated', 'data' => $product], 200);
    }

    // Define the destroy method for deleting a specific product
    public function destroy(Product $product)
    {
        // Delete the specified product from the database
        $product->delete();
        
        // Return a JSON response with a success message
        return response()->json(['message' => 'Product successfully deleted'], 200);
    }
}
