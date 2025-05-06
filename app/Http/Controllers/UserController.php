<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function salesData()
    {
        $dailySales = DB::table('daily_sales_view')->get();
        $weeklySales = DB::table('weekly_sales_view')->get();
        $monthlySales = DB::table('monthly_sales_view')->get();

        return view('staff.graphs.line', compact('dailySales', 'weeklySales', 'monthlySales'));
    }
}
