<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Auth;  
use Illuminate\Http\Request;

class CashierController extends Controller
{

    public function profile(){
        $user = Auth::user();
        return view('cashier.profile', compact('user'));
    }

    public function image(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $imagePath = $request->file('image')->store('profile', 'public');
        $user = Auth::user();
        DB::table('users')
            ->where('UserID', $user->UserID)
            ->update(['image' => $imagePath]);
    
        return back();
    }

    public function edit(){
        $user = Auth::user();
        $orders = DB::table('order_view')
            ->where('orderStatus', '<>', 'Delivered')
            ->get();
        $unpay = DB::table('unpaid_payment_view')->get();
        return view('cashier.site.edit',compact('user','orders','unpay'));
    }
}
