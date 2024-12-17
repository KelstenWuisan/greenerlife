<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Store a new order in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve the product details
        $product = Product::findOrFail($request->product_id);

        // Calculate the total price
        $totalPrice = $product->price * $request->quantity;

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id() ?? null, // Replace `auth()->id()` with actual user ID if authentication is implemented
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'payment_status' => 'pending', // Default to 'pending'
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}

