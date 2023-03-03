<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;
class HomeController extends Controller
{

    private $_modal = null;
    
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
        $data = 'abc';
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
