<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isLoggedIn = Auth::check() || session()->has('user_role');
    
        if (!$isLoggedIn) {
            return redirect()->route('auth');
        }
        
        $role = Auth::check() ? Auth::user()->RoleID : session('user_role');
        
        switch ($role) {
            case 1:
                break;
            case 2:
                return redirect()->route('staff.index');
            case 3:
                return redirect()->route('customer.index');
            default:
                return redirect('/');
        }
        return $next($request);
    }
}
