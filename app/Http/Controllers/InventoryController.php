<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Models\Movement;
class InventoryController extends Controller
{   
    public function profile(){
        $user = Auth::user();
        return view('inventory.profile', compact('user'));
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

    public function bar(){
        $user = Auth::user();
        $bestSellers = DB::table('best_selling_products')->get();
        return view('inventory.graph.bar',compact('user','bestSellers'));
    }
    public function pie(){
        $user = Auth::user();
        $bestSellers = DB::table('best_selling_products')->get();
        return view('inventory.graph.pie',compact('user', 'bestSellers'));
    }
    public function line(){
        $user = Auth::user();
        $dailySales = DB::table('daily_sales_view')->get();
        $weeklySales = DB::table('weekly_sales_view')->get();
        $monthlySales = DB::table('monthly_sales_view')->get();
        return view('inventory.graph.line',compact('user','dailySales', 'weeklySales', 'monthlySales'));
    }

    public function inventory(){
        $user = Auth::user();
        $inventoryTable = DB::table("inventory_view")->get();
        return view('inventory.site.edit', compact('user', 'inventoryTable'));
    }

    public function restocking(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();
        
        try {
            // Find inventory
            $inventory = Inventory::findOrFail($id);
            
            // Calculate new quantity
            $newQuantity = $inventory->quantity + $request->quantity;
            
            // Determine new status
            $percentage = ($newQuantity / $inventory->capacity) * 100;
            if ($percentage >= 50) {
                $newStatus = 'In Stock';
            } elseif ($percentage >= 20) {
                $newStatus = 'Low Stock';
            } else {
                $newStatus = 'Out of Stock';
            }

            // Update inventory
            $inventory->quantity = $newQuantity;
            $inventory->status = $newStatus;
            $inventory->lastUpdated = now()->toDateString();
            $inventory->save();

            // Create movement record
            Movement::create([
                'InventoryID' => $id,
                'changeType' => 'Restock',
                'quantityChange' => $request->quantity,
                'reason' => 'Manual Restock',
                'dateTime' => now()->toDateString()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'newQuantity' => $newQuantity,
                'status' => $newStatus,
                'lastUpdated' => now()->format('Y-m-d')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Restock failed'], 500);
        }
    }
}
