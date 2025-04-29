<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
