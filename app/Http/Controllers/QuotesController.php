<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Deals;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Auth;
class QuotesController extends Controller
{
    private $_request = null;
    private $_modal = null;
    private $_pmodal = null;

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(Request $request, Quote $modal, Product $pmodal)
    {
        $this->_request = $request;
        $this->_modal = $modal;
        $this->_pmodal = $pmodal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $data = $this->get_all($this->_modal);
        $slug = "quote";
        return view('home',compact('slug','data'));
    }
    //create reports between two dates
    public function reports()
    {
        if ($this->_request->form_date || $this->_request->to_date) {

            $this->validate($this->_request, [
                'from_date' => 'required',
                'to_date' => 'required|after_or_equal:from_date',

            ]);

            $from = Carbon::parse( $this->_request->from_date )->startOfDay();
            $to = Carbon::parse( $this->_request->to_date )->endOfDay();
            $quotes = $this->_modal::orderBy('created_at', 'desc')
                ->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)
                ->get();

            $grouped =  $this->_modal::whereBetween('created_at', [$from,$to])->get()->groupby(function ($q){
                return $q->created_at->format('d m Y');
            });

            $all_quotes = $this->get_all($this->_modal);
            $total_quotes = $this->_modal::whereBetween('created_at', [$from,$to])->count();
            $paid_quotes = $this->_modal::where('status','paid-collected')
                        ->orWhere('status','paid-delivered')
                        ->orWhere('status','paid-installed-deposit')
                        ->count();

            return view('reports.index_reports', compact('quotes', 'from', 'to', 'grouped', 'total_quotes', 'paid_quotes', 'all_quotes'));

        } else {
            return view('reports.index_reports');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request , $id = null)
    {

        if($id){
            dd($id,'if');
        }else{
            $quote = $this->get_all(new Quote);
        }
        $data = $this->get_all_by_roll(new User);
        $products = $this->get_all(new Product);
        return view('quote.quote_create',compact('data','products','quote'));


        $products = $this->get_all($this->_pmodal);
        return view('quote.quote_create', compact('products'));


    }
    // create quote
    public function create_quote()
    {
        // dd($this->_request->all());
            $quote = $this->_request->only('client_id','comment', 'internal_comment');
            $quote['user_id'] = Auth::user()->id;
            $quote['collected'] = $this->_request->total_gross;
            $quote['delivered'] = 60;

            $var = $this->add($this->_modal, $quote);

            //  Deals
            $data = $this->_request->only(
                'product_id' ,
                'width' ,
                'height',
                'sqm' ,
                'product_price' ,
                'matt_finish_option' ,
                'matt_finish' ,
                'spraying_edges' ,
                'metallic_paint' ,
                'wood_stain' ,
                'gloss_percentage' ,
                'gloss_100_acrylic_lacquer' ,
                'polyester' ,
                'burnished_finish' ,
                'barrier_coat' ,
                'edgebanding' ,
                'micro_bevel' ,
                'routed_handle_spraying' ,
                'beaded_door' ,
                'quantity' ,
                'net_price' ,
                'vat',
                'trade_discount' ,
                'total_gross');
                $data['quote_id'] = $var->id;

            // create Deals
            $var2 = $this->add(new Deals,$data);
            return redirect()->route('quote.create', [$var]);
        // return redirect()->route('quote.create',[$var])->with('success','Quote created successfully!');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate($this->_request, [
            'name' => 'required',
        ]);

        $data = $this->_request->except('_token');
        $var = $this->add($this->_modal, $data);

        return redirect()->route('{{routeName}}');
    }

    /**
     * Display the specified resource.
     *
     * @param  $this->_modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        // $quotes = Quote::with('user' , 'deals')
        // ->when($id, function ($query, $id) {
        //     return $query->where('client_id', $id);
        // })
        // ->get();

        $quotes = $this->get_by_column($this->_modal, 'client_id', $id);
        //$client_data = $this->get_by_id($this->_modal, $id);
        return view('customer.view_customer_quote', compact('quotes'));

        // $data = $this->get_by_id($this->_modal, $id);
        // return view('{{view_name}}', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $this->_modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->get_by_id($this->_modal, $id);
        return view('{{view_name}}', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Quote  $modal
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate($this->_request, [
            'name' => 'required',
        ]);

        $data = $this->_request->except('_token', '_method');

        $data = $this->get_by_id($this->_modal, $id)->update($data);

        return redirect()->route('{{routeName}}.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Quote  $modal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->delete($this->_modal, $id);
        return redirect()->route('{{ routeName }}');
    }

}
