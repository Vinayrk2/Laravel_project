<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use App\Helpers\helpers;

class CartController extends Controller
{
    private function updateGlobalCartCount()
    {
        session()->put('cart_count', Cart::where('user_id', Auth::id())->sum('quantity'));
    }

    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $subTotal = $cartItems->sum(function($item) {
            return $item->product->adjusted_price * $item->quantity;
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

        $this->updateGlobalCartCount();
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function removeItem($id)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->delete();

        $this->updateGlobalCartCount();
        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();
        $this->updateGlobalCartCount();
        return redirect()->back()->with('success', 'Cart cleared!');
    }

    public function incrementQuantity($id)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->increment('quantity');

        $this->updateGlobalCartCount();
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

        $this->updateGlobalCartCount();
        return redirect()->back();
    }

    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        
        $subTotal = $cartItems->sum(function($item) {
            return $item->product->adjusted_price * $item->quantity;
        });
        
        $tax = $subTotal * getSiteSetting('tax');
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
        Mail::to(getSiteSetting('bussiness_email'))->send(new OrderConfirmation(
            $user, 
            $cartItems, 
            $subTotal, 
            $tax, 
            $total
        ));

        Cart::where('user_id', $user->id)->delete();
        $this->updateGlobalCartCount();

    // Redirect to the success page with data
    return redirect()->route('success')->with([
        'title' => 'Thank You for Your Order!',
        'message' => 'Your order has been successfully placed. A confirmation email has been sent to you. We appreciate your business!',
        'buttonText' => 'Continue Shopping',
        'redirectRoute' => 'index', // Add any other route for redirection
    ]);
    }
} 