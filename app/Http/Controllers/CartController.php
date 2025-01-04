<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $subTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $tax = $subTotal * 0.13; // 13% tax
        $total = $subTotal + $tax;

        return view('cart.index', compact('cartItems', 'subTotal', 'tax', 'total'));
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function removeItem($id)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Cart cleared!');
    }

    public function incrementQuantity($id)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->increment('quantity');

        return redirect()->back();
    }

    public function decrementQuantity($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } else {
            $cartItem->delete();
        }

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        
        $subTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        
        $tax = $subTotal * 0.13;
        $total = $subTotal + $tax;

        // Send email to customer
        Mail::to($user->email)->send(new OrderConfirmation(
            $user, 
            $cartItems, 
            $subTotal, 
            $tax, 
            $total
        ));

        // Send email to admin
        Mail::to('avionicsqf@gmail.com')->send(new OrderConfirmation(
            $user, 
            $cartItems, 
            $subTotal, 
            $tax, 
            $total
        ));

        // Clear the cart
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Order submitted successfully! Check your email for confirmation.');
    }
} 