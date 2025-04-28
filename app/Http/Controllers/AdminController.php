<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    public function index(){
        $user = User::where('UserID', '1')->first();
        return view('admin.index',compact('user'));
    }
    public function profile(){
        $user = User::where('UserID', '1')->first();
        return view('admin.profile', compact('user'));
    }
    public function add(){
        $user = User::where('UserID', '1')->first();
        return view('admin.user.add',compact('user'));
    }
    public function search(){
        $user = User::where('UserID', '1')->first();
        return view('admin.user.search',compact('user'));
    }
    public function bar(){
        $user = User::where('UserID', '1')->first();
        return view('admin.graph.bar',compact('user'));
    }
    public function line(){
        $user = User::where('UserID', '1')->first();
        return view('admin.graph.line',compact('user'));
    }
    public function pie(){
        $user = User::where('UserID', '1')->first();
        return view('admin.graph.pie',compact('user'));
    }
}
