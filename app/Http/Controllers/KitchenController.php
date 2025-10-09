<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Auth;  
use Illuminate\Http\Request;

class KitchenController extends Controller
{

    public function profile(){
        $user = Auth::user();
        return view('kitchen.profile', compact('user'));
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

        $orderItems = DB::table('order_item_view')
            ->whereIn('OrderID', $orders->pluck('OrderID'))
            ->get()
            ->groupBy('OrderID');

        $unpay = DB::table('unpaid_payment_view')->get();
        return view('kitchen.site.edit',compact('user','orders','unpay','orderItems'));
    }

    public function updateStatus(Request $request, $id){
        $user = Auth::user();
        $order = Order::findOrFail($id);
        $payment = Payment::where('OrderID', $order->OrderID)->first();
        switch($order->status){
            case 'Preparing':
                $order->status = 'Serving';
                break;
            case 'Serving':
                if ($payment->status == 'Unpaid') {
                    return back()->with('error', 'Pay up first');
                }
                $order->status = 'Delivered';
                break;
        }
            $order->save();
        

        return back();
    }
}
