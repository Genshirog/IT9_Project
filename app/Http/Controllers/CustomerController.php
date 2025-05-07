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
        $topProductNames = DB::table('best_selling_products')
            ->select('productName')
            ->limit(3)
            ->pluck('productName'); // This gives you a plain array of names

        $recommendations = Product::whereIn('productName', $topProductNames)->get();

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

    public function delivery(){
        $user = Auth::user();
        $cartItems = DB::table('items_view')->get();
        return view('customer.cart',compact('user','cartItems'));
    }
}
