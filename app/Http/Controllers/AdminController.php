<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function profile(){
        return view('admin.profile');
    }
    public function add(){
        return view('admin.user.add');
    }
    public function search(){
        return view('admin.user.search');
    }
    public function bar(){
        return view('admin.graph.bar');
    }
    public function line(){
        return view('admin.graph.line');
    }
    public function pie(){
        return view('admin.graph.pie');
    }
}
