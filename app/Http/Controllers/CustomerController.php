<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Auth;  
class CustomerController extends Controller
{
    public function index(){
        $user = Auth::user();
        $recommendations = Product::whereNotIn('category', ['Desert','Beverage'])
        ->inRandomOrder()
        ->take(3)
        ->get();

        $available = Product::whereNotIn('category', ['Desert', 'Beverage'])
                        ->take(6)
                        ->get();

        $roasted = Product::whereNotIn('category', ['Desert', 'Beverage'])
                    ->whereNotIn('ProductID', $available->pluck('ProductID')->toArray())
                    ->take(6)
                    ->get();

        $extra = Product::whereIn('category', ['Desert', 'Beverage'])
                    ->take(6)
                    ->get();
        return view('customer.index',compact('user','recommendations','available','extra','roasted'));
    }

    public function cart(){
        $user = Auth::user();
        $cartItems = DB::table('items_view')->get();
        return view('customer.cart',compact('user','cartItems'));
    }
}
