<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
class CartController extends Controller
{
    public function storeToCart(Request $request)
    {
        $validated = $request->validate([
            'ProductID' => 'required|exists:products,ProductID',
            'quantity' => 'required|integer|min:1',
        ]);

        // 1. Check if there's a current OrderID in session
        $cartID = Session::get('CartID');
        $product = Product::find($validated['ProductID']);
        $totalPrice = $product->price * $validated['quantity'];
        
        if (!$cartID || !Cart::find($cartID)) {
            $cart = Cart::create([
                'UserID' => Auth::user()->UserID,
                'totalPrice' => 0
            ]);
            $cartID = $cart->CartID;
            Session::put('CartID', $cartID); // Store it in session
        }

        $existingItem = CartItem::where('CartID', $cartID)
                            ->where('ProductID', $validated['ProductID'])
                            ->first();

        if ($existingItem) {
            // Update existing item's quantity and subtotal
            $newQuantity = $existingItem->quantity + $validated['quantity'];
            $existingItem->update([
                'quantity' => $newQuantity,
                'subTotal' => $newQuantity * $product->price
            ]);
        } else {
            // Create new cart item
            CartItem::create([
                'CartID' => $cartID,
                'ProductID' => $validated['ProductID'],
                'quantity' => $validated['quantity'],
                'subTotal' => $validated['quantity'] * $product->price
            ]);
        }
        
        $total = CartItem::where('CartID', $cartID)->sum('subTotal');

        // 3. Update the cart's totalPrice
        Cart::where('CartID', $cartID)->update([
            'totalPrice' => $total
        ]);
        return redirect()->back()->with('success', 'Item added to cart.');
    }
}
