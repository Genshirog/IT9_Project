<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function updateQuantity(Request $request, $id){
        $cart = CartItem::findOrFail($id);
        $cart->quantity = $request->input('quantity');
        $cart->subTotal = $cart->quantity * $cart->product->price;
        $cart->save();
        return back();
    }

    public function deleteItems($id){
        $cart = CartItem::findOrFail($id);
        $cart->delete();
        return back();
    }
}
