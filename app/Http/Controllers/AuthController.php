<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function auth(){
        return view('auth');
    }

    public function register(){
        return view('register');
    }

    public function login(Request $request){
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $validate['username'])->first();

        if ($user && $user->password == $validate['password']) {
            if ($user->RoleID == 1) {
                return redirect()->route('admin.index');
            }elseif ($user->RoleID == 2){
                return redirect()->route('staff.index');
            }elseif ($user->RoleID == 3){
                return redirect()->route('customer.index');
            } else {
                return redirect('/');
            }
        } else {
            return back()->withErrors([
                'loginError' => 'Invalid username or password.',
            ]);
        }
    }

    public function store(Request $request){
        
    }
}
