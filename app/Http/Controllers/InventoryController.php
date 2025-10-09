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
            $inventory = Inventory::findOrFail($id);

            $newQuantity = $inventory->quantity + $request->quantity;

            $percentage = ($newQuantity / $inventory->capacity) * 100;
            if ($percentage >= 50) {
                $newStatus = 'In Stock';
            } elseif ($percentage >= 20) {
                $newStatus = 'Low Stock';
            } else {
                $newStatus = 'Out of Stock';
            }

            $inventory->quantity = $newQuantity;
            $inventory->status = $newStatus;
            $inventory->lastUpdated = now()->toDateString();
            $inventory->save();

            Movement::create([
                'InventoryID' => $id,
                'changeType' => 'Restock',
                'quantityChange' => $request->quantity,
                'reason' => 'Manual Restock',
                'dateTime' => now()->toDateString()
            ]);

            DB::commit();

            // Redirect like customer.storeToCart
            return redirect()->back()->with('success', 'Product restocked successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Restock failed!');
        }
    }

    public function exportCSV()
    {
        // Fetch data from the same view
        $inventoryTable = DB::table("inventory_view")->get();

        // Filename
        $filename = "inventory_" . date('Y-m-d_H-i-s') . ".csv";

        // Create a temp file
        $handle = fopen('php://temp', 'r+');

        // Add header row
        fputcsv($handle, [
            'Inventory ID', 
            'Product Name', 
            'Category', 
            'Capacity', 
            'Stock', 
            'Status', 
            'Last Updated'
        ]);

        // Add data rows
        foreach ($inventoryTable as $item) {
            fputcsv($handle, [
                $item->InventoryID,
                $item->productName,
                $item->category,
                $item->capacity,
                $item->quantity,
                $item->status,
                $item->lastUpdated
            ]);
        }

        // Rewind so we can read it
        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        // Return download response
        return response($csvContent)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('productName'); // get search text

        $inventoryTable = DB::table('inventory_view')
            ->when($query, function ($q) use ($query) {
                $q->where('productName', 'like', '%' . $query . '%');
            })
            ->get();

        return view('inventory.site.edit', compact('user', 'inventoryTable'));
    }



}
