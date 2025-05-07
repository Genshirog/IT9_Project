<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
class PaymentController extends Controller
{
    public function payment(Request $request){
        $user = Auth::user();
        $cart = Cart::where('UserID', $user->UserID)->first();
        $cartItems = CartItem::where('CartID',$cart->CartID)->get();
        if ($request->amountPayed < $cart->totalPrice && $request->paymentMethod == 'gcash') {
            return back()->withErrors(['amountPayed' => 'Insufficient payment. Please enter the full amount.'])->withInput();
        }else{
            DB::transaction(function () use ($user, $cart,$cartItems,$request) {
                // Create Order
                $order = Order::create([
                    'UserID' => $user->UserID,
                    'totalPrice' => $cart->totalPrice,
                    'status' => 'Preparing',
                    'deliveryType' => 'Delivery'
                ]);

                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'OrderID' => $order->OrderID,
                        'ProductID' => $item->ProductID,
                        'quantity' => $item->quantity,
                        'subTotal' => $item->subTotal,
                    ]);
                }
                
                if($request->paymentMethod == 'gcash'){
                    Payment::create([
                        'OrderID' => $order->OrderID,
                        'paymentMethod' => $request->paymentMethod,
                        'amountPayed' => $request->amountPayed,
                        'amountChanged' => $request->amountPayed - $order->totalPrice,
                        'status' => 'Paid'
                    ]);
                }else if($request->paymentMethod == 'cash'){
                    Payment::create([
                        'OrderID' => $order->OrderID,
                        'paymentMethod' => $request->paymentMethod,
                        'amountPayed' => 0,
                        'amountChanged' => 0,
                        'status' => 'Unpaid',
                    ]);
                }
                // Clear cart
                $cartItems->each(function ($item) {
                    $item->delete(); // Delete each cart item
                });
                $cart->delete();
            });
            
            return redirect()->route('customer.index');
        }
    }

    public function status(Request $request, $id){
        $order = Order::findOrFail($id);
        if($request->amountPayed < $order->totalPrice){
            return back()->withErrors(['amountPayed' => 'Insufficient payment. Please enter the full amount.'])->withInput();
        }else{
            $payment = Payment::where('OrderID', $order->OrderID)->first();

            if ($payment) {
                $payment->update([
                    'amountPayed' => $request->amountPayed,
                    'amountChanged' => $request->amountPayed - $order->totalPrice,
                    'status' => $request->status
                ]);
            }
            return redirect()->route('staff.site.edit');
        }
    }
}
