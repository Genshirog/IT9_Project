<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            Auth::login($user);
            session(['user_role' => $user->RoleID]);
            $request->session()->save();
            switch(Auth::user()->RoleID){
                case 1:
                    return redirect()->route('admin.index');
                case 2:
                    return redirect()->route('staff.index');
                case 3:
                    return redirect()->route('customer.index');
                default:
                    return redirect()->route('/');
            }
        } else {
            return back()->withErrors([
                'loginError' => 'Invalid username or password.',
            ]);
        }
    }

    public function store(Request $request){
        $validate = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'birthday' => 'required|date',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8'
        ]);        

        $user = new User();
        $user->firstname = $validate['firstname'];
        $user->lastname = $validate['lastname'];
        $user->email = $validate['email'];
        $user->birthday = $validate['birthday'];
        $user->username = $validate['username'];

        // For now, if you are not hashing password yet, just do:
        $user->password = $validate['password'];

        // You can set a default role too, like "customer"
        $user->RoleID = 3; // Example: 1 = Admin, 2 = Staff, 3 = Customer

        // Save to the database
        $user->save();

        Auth::login($user);
        session(['user_role' => $user->RoleID]);
        $request->session()->save();
        // After saving, redirect or return
        return redirect()->route('customer.index');
    }

    public function logout(Request $request)
    {
        // Clear the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // If you're using Auth::user(), you should also call logout
        Auth::logout();

        // Redirect to login page (or wherever you want)
        return redirect('/');
    }
}