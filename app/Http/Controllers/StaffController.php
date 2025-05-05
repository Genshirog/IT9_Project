<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
class StaffController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('staff.index', compact('user'));
    }
    public function profile(){
        $user = Auth::user();
        return view('staff.profile', compact('user'));
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

    public function add(){
        $user = Auth::user();
        return view('staff.product.add',compact('user'));
    }

    public function store(Request $request){    
        $request->validate([
            'productName' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'productDescription' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $imagePath = $request->file('image')->store('images', 'public');
        Product::create([
            'productName' => $request->input('productName'),
            'category' => $request->input('category'),
            'productDescription' => $request->input('productDescription'),
            'price' => $request->input('price'),
            'image' => $imagePath,
        ]);
        return redirect()->route('staff.product.add');
    }
    public function search(){
        $user = Auth::user();
        $products = Product::all();
        return view('staff.product.search',compact('user','products'));
    }
    public function edit(){
        $user = Auth::user();
        return view('staff.site.edit',compact('user'));
    }
    public function bar(){
        $user = Auth::user();
        return view('staff.graph.bar',compact('user'));
    }
    public function pie(){
        $user = Auth::user();
        return view('staff.graph.pie',compact('user'));
    }
    public function line(){
        $user = Auth::user();
        return view('staff.graph.line',compact('user'));
    }
}
