<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json(['message' => 'Successfully fetched products', 'data' => $products], 200);
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json(['message' => 'Product successfully created', 'data' => $product], 201);
    }

    public function show(Product $product)
    {
        return response()->json(['message' => 'Successfully fetched product', 'data' => $product], 200);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return response()->json(['message' => 'Product successfully updated', 'data' => $product], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product successfully deleted'], 200);
    }
}
