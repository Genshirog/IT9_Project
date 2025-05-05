<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class CustomerController extends Controller
{
    public function index(){
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
        return view('customer.index',compact('recommendations','available','extra','roasted'));
    }
}
