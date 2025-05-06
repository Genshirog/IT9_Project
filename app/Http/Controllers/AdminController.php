<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $user = Auth::user();
        $dailySales = DB::table('daily_sales_view')->get();
        $weeklySales = DB::table('weekly_sales_view')->get();
        $monthlySales = DB::table('monthly_sales_view')->get();
        $bestSellers = DB::table('best_selling_products')->get();
        return view('admin.index', compact('user','dailySales', 'weeklySales', 'monthlySales','bestSellers'));
    }
    public function profile(){
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
    public function add(){
        $user = Auth::user();
        return view('admin.user.add',compact('user'));
    }

    public function search()
    {
        $user = Auth::user();
        $users = DB::table('users_view')->get();
        return view('admin.user.search',compact('users','user'));
    }

    public function bar(){
        $user = Auth::user();
        $bestSellers = DB::table('best_selling_products')->get();
        return view('admin.graph.bar',compact('user','bestSellers'));
    }
    public function line(){
        $user = Auth::user();
        $dailySales = DB::table('daily_sales_view')->get();
        $weeklySales = DB::table('weekly_sales_view')->get();
        $monthlySales = DB::table('monthly_sales_view')->get();
        return view('admin.graph.line',compact('user','dailySales', 'weeklySales', 'monthlySales'));
    }
    public function pie(){
        $user = Auth::user();
        $bestSellers = DB::table('best_selling_products')->get();
        return view('admin.graph.pie',compact('user','bestSellers'));
    }

    public function store(Request $request){
        $validate = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthday' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8'
        ]);

        $staff = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'RoleID' => 2,
        ]);
        return redirect()->route('admin.user.search')->with('success', 'Staff added successfully!');
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
}
