<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
class HomeController extends Controller
{

    private $_modal = null;
    private $_pmodal = null;
    private $_cmodal = null;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Quote $modal, Product $pmodal, User $cmodal)
    {
        $this->middleware('auth');

        $this->_modal = $modal;
        $this->_pmodal = $pmodal;
        $this->_cmodal = $cmodal;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug = null)
    {
        // dd($slug);
        $total_quotes = $this->get_all($this->_modal)->count();
        $total_customers = $this->get_all_by_roll($this->_cmodal)->count();
        $total_products = $this->get_all($this->_pmodal)->count();

        $to = Carbon::now();
        $from = Carbon::now()->addDays(-10);
        $grouped =  $this->_modal::whereBetween('created_at', [$from,$to])->get()->groupby(function ($q){
            return $q->created_at->format('d m Y');
        });
        $grouped_quotes = $this->_modal::where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)
                ->get();

        $all_quotes = $this->get_all($this->_modal);

        $data = ['total_quotes' => $total_quotes, 'total_customers' => $total_customers, 'total_products' => $total_products, 'from' => $from, 'to' => $to, 'grouped' => $grouped, 'grouped_quotes' => $grouped_quotes, 'all_quotes' => $all_quotes ];

        //dd($data);
        return view('home',compact('slug', 'data'));
        // return view('home',compact('slug'));
    }
    public function logout()
    {
        Auth::logout();
        // return redirect('/login');
        return view('welcome');
    }
}
