<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Retrieve all orders with associated user and product data
    public function index()
    {
        $orders = Order::with('user:id,name', 'product')->get();
        return response()->json(['message' => 'Successfully fetched orders', 'data' => $orders], 200);
    }


    // Create a new order with user ID, product ID, quantity, total price, and status
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed,canceled',
        ]);

        $order = Order::create($request->all());
        return response()->json(['message' => 'Order successfully created', 'data' => $order], 201);
    }

    // Retrieve an order by ID with associated user and product data
    public function show(Order $order)
    {
        $order->load(['user', 'product']);
        return response()->json(['message' => 'Successfully fetched order', 'data' => $order]);
    }

    // Update an existing order with optional user ID, product ID, quantity, total price, and status
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'total_price' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|required|in:pending,processing,completed,canceled',
        ]);

        $order->update($request->all());
        return response()->json(['message' => 'Order successfully updated', 'data' => $order]);
    }

    // Delete an existing order by ID
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Order successfully deleted'], 204);
    }
}
