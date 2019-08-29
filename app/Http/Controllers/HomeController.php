<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Sales;
use App\Sold;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyRoles');
        $this->middleware('getRoles');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = Admin::count();
        $user = User::count();
        $sales = Sales::count();
        $sold = Sold::count();
        return view('layouts.home')->with(compact('admin', 'sales', 'sold', 'user'));
    }
}
