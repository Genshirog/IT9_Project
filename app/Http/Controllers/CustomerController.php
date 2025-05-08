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

        $available = Product::whereNotIn('category', ['Desert', 'Beverage','Roasted'])
                        ->paginate(6);

        $roasted = Product::whereNotIn('category', ['Desert', 'Beverage','Dish'])
                    ->paginate(6);

        $extra = Product::whereIn('category', ['Desert', 'Beverage'])
                    ->paginate(6);
        return view('customer.index',compact('user','recommendations','available','extra','roasted'));
    }

    public function cart(){
        $user = Auth::user();
        $cartItems = DB::table('items_view')->get();
        return view('customer.cart',compact('user','cartItems'));
    }

    public function delivery(){
        $user = Auth::user();
        $delivery = DB::table('order_view')
            ->where('orderStatus', '<>', 'Delivered')
            ->where('UserID', $user->UserID)
            ->paginate(5);
        return view('customer.delivery',compact('user','delivery'));
    }

    public function history(){
        $user = Auth::user();
        $payments = DB::table('order_view')
            ->where('UserID', $user->UserID)
            ->paginate(5);
        return view('customer.history',compact('user','payments'));
    }
}
