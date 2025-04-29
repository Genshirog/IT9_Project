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
        return view('admin.index',compact('user'));
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
        return view('admin.graph.bar',compact('user'));
    }
    public function line(){
        $user = Auth::user();
        return view('admin.graph.line',compact('user'));
    }
    public function pie(){
        $user = Auth::user();
        return view('admin.graph.pie',compact('user'));
    }
}
