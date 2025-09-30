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
use App\Models\Inventory;
use App\Models\Movement;
class PaymentController extends Controller
{
    public function payment(Request $request){
        $user = Auth::user();
        $cart = Cart::where('UserID', $user->UserID)->first();
        $cartItems = CartItem::where('CartID',$cart->CartID)->get();
        if ($request->amountPayed < $cart->totalPrice && $request->paymentMethod == 'gcash') {
            return back()->withErrors(['amountPayed' => 'Insufficient payment. Please enter the full amount.'])->withInput();
        }else{
            DB::transaction(function () use ($user, $cart, $cartItems, $request) {
                // 1. Create Order
                $order = Order::create([
                    'UserID'       => $user->UserID,
                    'totalPrice'   => $cart->totalPrice,
                    'status'       => 'Preparing',
                    'deliveryType' => 'Delivery'
                ]);

                // 2. Loop through Cart Items
                foreach ($cartItems as $item) {
                    
                    // Get inventory for this product
                    $inventory = Inventory::where('ProductID', $item->ProductID)->first();
                    
                    // Reduce stock
                    $newQty = $inventory->quantity - $item->quantity;

                    // If quantity would be negative, set to zero
                    if ($newQty < 0) {
                        $newQty = 0;
                    }

                    $inventory->quantity = $newQty;
                    $inventory->status = $newQty > 0 ? 'Available' : 'Out of Stock';
                    $inventory->lastUpdated = now();
                    $inventory->save();
                    
                    // Create movement record
                    $movement = Movement::create([
                        'InventoryID'    => $inventory->InventoryID,
                        'changeType'     => 'Sale',
                        'quantityChange' => $item->quantity,
                        'reason'         => 'Order Confirmation',
                        'dateTime'       => now(),
                    ]);
                    
                    // Create order item with MovementID
                    OrderItem::create([
                        'OrderID'    => $order->OrderID,
                        'MovementID' => $movement->MovementID, // ✅ now we have a real movement ID
                        'quantity'   => $item->quantity,
                        'subTotal'   => $item->subTotal,
                    ]);
                }

                // 3. Payment creation
                if ($request->paymentMethod == 'gcash') {
                    Payment::create([
                        'OrderID'       => $order->OrderID,
                        'paymentMethod' => $request->paymentMethod,
                        'amountPayed'   => $request->amountPayed,
                        'amountChanged' => $request->amountPayed - $order->totalPrice,
                        'status'        => 'Paid'
                    ]);
                } else if ($request->paymentMethod == 'cash') {
                    Payment::create([
                        'OrderID'       => $order->OrderID,
                        'paymentMethod' => $request->paymentMethod,
                        'amountPayed'   => 0,
                        'amountChanged' => 0,
                        'status'        => 'Unpaid',
                    ]);
                }

                // 4. Clear cart
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
