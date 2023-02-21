<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug = null)
    {
        // dd($slug);
        $data = null;
        return view('home',compact('slug','data'));
        // return view('home',compact('slug'));
    }
    public function logout()
    {
        Auth::logout();
        // return redirect('/login');
        return view('welcome');
    }
}
