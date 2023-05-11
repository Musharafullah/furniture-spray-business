<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Deals;
use App\Models\User;
use App\Models\Product;
use App\Models\DeliveryCharges;
use Carbon\Carbon;
use PDF;
use Auth;
use Mail;
class QuotesController extends Controller
{
    private $_request = null;
    private $_modal = null;
    private $_pmodal = null;
    private $_dmodal = null;

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(Request $request, Quote $modal, Product $pmodal, Deals $dmodal)
    {
        $this->_request = $request;
        $this->_modal = $modal;
        $this->_pmodal = $pmodal;
        $this->_dmodal = $dmodal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $data = $this->get_all($this->_modal)->sortDesc();
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
        if($id != null){
            $quote = $this->get_by_id($this->_modal,$id);
            // dd($quote);
            // get previous user id
            $previous = $this->_modal::where('id', '<', $quote->id)->max('id');
            // get next user id
            $next = $this->_modal::where('id', '>', $quote->id)->min('id');
            $clint_id = $id;
        }else{

            $quote = new $this->_modal;
            $clint_id = null;
            $previous = null;
            // get next user id
            $next = null;
        }
        $data = $this->get_all_by_roll(new User);
        $products = $this->get_all(new Product)->sortBy('product_name');;
        // dd(Deals::where('quote_id'));
        return view('quote.quote_create',compact('data','products','quote','clint_id','next', 'previous'));
    }
    // create quote
    public function create_quote()
    {

        $delivery  = $this->get_by_id(new DeliveryCharges, 1);
        if($this->_request->quote_id != null)
        {
            $id = $this->_request->quote_id;
            $var = $this->get_by_id($this->_modal, $id);

            $deal = Deals::where('quote_id', $id)->get();
            $collected = $deal->sum('total_gross');
            $collected = round($collected, 2);

            $data['client_id'] = $var->client_id;
            $data['user_id'] = Auth::user()->id;
            $data['collected'] = $collected;
            $data['internal_comment'] = $this->_request->internal_comment;
            $data['comment'] = $this->_request->comment;
            // $data['delivered'] = $delivery->total_charges;

            $previous = $this->_modal::where('id', '<', $this->_request->quote_id)->max('id');
            $next = $this->_modal::where('id', '>', $this->_request->quote_id)->min('id');

            $var->update($data);

            //dd($var);
        }else{
            if($this->_request->client_id == null)
            {
                return back()->with('error','select client first');
            }
            $quote = $this->_request->only('client_id','comment', 'internal_comment');
            $quote['user_id'] = Auth::user()->id;
            $quote['collected'] = $this->_request->total_gross;
            $quote['delivered'] = $delivery->total_charges;
            $var = $this->add($this->_modal, $quote); 

        }
         //  Deals
        //  when product id is missing
         if($this->_request->product_id == null)
         {
             return back()->with('error','something went wrong');
         }
         $data = $this->_request->only(
            'product_id',
            'width',
            'height',
            'sqm',
            'product_price',
            'matt_finish_option',
            'matt_finish',
            'spraying_edges',
            'metallic_paint',
            'wood_stain',
            'gloss_percentage',
            'gloss_100_acrylic_lacquer',
            'polyester',
            'burnished_finish',
            'barrier_coat',
            'edgebanding',
            'micro_bevel',
            'routed_handle_spraying',
            'beaded_door',
            'quantity',
            'net_price' ,
            'vat',
            'trade_discount',
            'total_gross',
            'note');
            if($this->_request->gloss_percentage_option == null)
            {
                $data['gloss_percentage_option'] = 0;
            }else{
                $data['gloss_percentage_option'] = $this->_request->gloss_percentage_option;
            }

            // dd($var);
            // dd($this->_request->gloss_percentage_option);

            $data['quote_id'] = $var->id;

        // create Deals
        $var2 = $this->add(new Deals,$data);
        // dd($var2);

            return redirect()->route('quote.create', compact('var'));
        // return redirect()->route('quote.create',[$var])->with('success','Quote created successfully!');

    }
    // duplicate item
    public function duplicate_item($id)
    {
        // dd($id);
        $item_duplicate = $this->get_by_id(new Deals, $id);
        $quote_id = $item_duplicate->quote_id;
        $duplicate = $item_duplicate->replicate();
        $duplicate->save();
        //
        $quote= $this->get_by_id($this->_modal, $quote_id);

        $deal = Deals::where('quote_id',$quote_id)->get();
        $sqm = $deal->sum('sqm_qty');


        $collected = $deal->sum('total_gross');
        $collected = round($collected, 2);
        $quote->collected = $collected;
        $quote->delivered = 60;
        $quote->save();
        return redirect()->back()->with('success','Record duplicted successfull!');
    }
    //duplicate quote
    public function duplicate($id){

        $quote = $this->get_by_id($this->_modal, $id);
        $duplicate_quote = $quote->replicate();
        $duplicate_quote->save();

        $duplicate_quote_id = $duplicate_quote->id;

        $item_duplicate = Deals::where('quote_id', $quote->id)->get();
        foreach($item_duplicate as $duplicate){
            $replicate = $duplicate->replicate();
            $replicate->quote_id = $duplicate_quote_id;
            $replicate->save();
        }

        //
        return redirect()->back()->with('success','Record duplicted successfull!');
    }
    // backup
    public function edit_survey(Request $request,$id)
    {
        // dd($this->_request->all());
        $data = $request->except('_token', '_method');
        $delivery_charges = Quote::findOrFail($id)->update($data);
        // $quote = $this->get_by_id($this->_modal,$id);
        // dd($quote);
        return back()->with('success','delievry added!');
    }

    // change the status
    public function status(Request $request)
    {
        // dd($this->_request->all());

        $id = $this->_request->quote_id;
        $quote = $this->get_by_id($this->_modal, $id);
        if($quote)
        {
            $data['status'] = $this->_request->status;
            $quote->update($data);
            return response()->json(['status'=>200]);
        }
        else{
            return response()->json(['status'=>404]);
        }


    }

    public function hidden_option(){
        $quote_id = $this->_request->quote_id;
        $quote = $this->get_by_id($this->_modal, $quote_id);

        $quote->hidden_price = $this->_request->quote_option;
        $quote->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  $this->_modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


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

        $deal = Deals::findorFail($id);
        $client = $deal->quotes->client_id;
        $quote_id = $deal->quote_id;
        $quote = $this->get_by_id($this->_modal, $quote_id);
        $products = Product::all();
        return view('quote.quote_edit', compact( 'products','quote','deal','client'));

        // $data = $this->get_by_id($this->_modal, $id);
        // return view('{{view_name}}', compact('data'));
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
        // dd($this->_request->all());
        $this->validate($this->_request, [
            'product_id'  => 'required',
            'quantity' => 'required',
            'net_price' => 'required',
            'vat' => 'required',
            'total_gross' => 'required',
        ]);

        $data = $this->_request->except('_token', '_method');

        //dd($data);

        $data = $this->get_by_id($this->_dmodal, $id)->update($data);

        $quote['collected'] = $this->_request->total_gross;
        $data = $this->get_by_id($this->_modal, $this->_request->quote_id)->update($quote);

        $var = $this->get_by_id($this->_modal, $this->_request->quote_id);

        return redirect()->route('quote.create', compact('var'))->with('success','Updated successfully!');
    }
    // ------------status section
    public function image_status(Request $request)
    {
        $deal_id = $request->deal_id;
        // $deal = Deals::findOrFail($deal_id);
        $deal = $this->get_by_id(new Deals, $deal_id);

        $deal->image_status = $request->status;

        $deal->save();
       // return response()->json('image status change');
    }
    // total vat status
    public function total_vat_status(Request $request)
    {
        // dd($request->all());
        $quote_id = $request->quote_id;
        $quote = $this->get_by_id($this->_modal, $quote_id);


        $quote->total_vat_status = $request->total_vat_status;
        $quote->save();
        return response()->json('Delivered ststus change');
    }
    // total gross total status
    public function gross_total_status(Request $request)
    {
        //dd($request->all());
        $quote_id = $request->quote_id;
        $quote = $this->get_by_id($this->_modal, $quote_id);

        $quote->gross_total_status = $request->gross_total_status;
        $quote->save();
        return response()->json('Delivered ststus change');
    }
    // net price status
    public function net_price_status(Request $request)
    {
        $quote_id = $request->quote_id;
        $quote = $this->get_by_id($this->_modal, $quote_id);

        $quote->net_price_status = $request->net_price_status;
        $quote->save();
        return response()->json('Delivered ststus change');
    }
    // total net price status
    public function total_net_status(Request $request)
    {
        //dd($request->all());
        $quote_id = $request->quote_id;
        $quote = $this->get_by_id($this->_modal, $quote_id);

        $quote->total_net_status = $request->total_net_status;
        $quote->save();
        return response()->json('Delivered ststus change');
    }
    // collect status
    public function collect_status(Request $request)
    {
        //dd($request->all());
        $quote_id = $request->quote_id;
        $quote = $this->get_by_id($this->_modal, $quote_id);

            $quote->hide_collect = $request->collect_status;
            $quote->save();
       // return response()->json('done collect');
    }
    // delivered status
    public function delivered_status(Request $request)
    {
        $quote_id = $request->quote_id;
        $quote = $this->get_by_id($this->_modal, $quote_id);

        $quote->hide_delivered = $request->delivered_status;
        $quote->save();
       return response()->json('Delivered ststus change');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Quote  $modal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id,'delete');

        $delete_item_row = Deals::findOrFail($id);
        $quote_id = $delete_item_row->quote_id;
        $delete_item_row->delete();

        $quote = $this->get_by_id($this->_modal, $quote_id);
        // dd($quote);
        $deal = Deals::where('quote_id', $quote_id)->get();
        $collected = $deal->sum('total_gross');
        $collected = round($collected, 2);

        $quote->collected = $collected;
        $quote->delivered = 60;
        $quote->save();
        return back()->with('error','Quote deal deleted!');
        // return redirect()->route('quote.create', compact('quote'))->with('success','Quote deleted successfully!');
    }

    //download pdf
    public function download_pdf($id)
    {

        $quotes = $this->get_by_id($this->_modal, $id);
        $client = $quotes->client_id;
        // $pdf = \PDF::loadView('pdf.pdf', compact('quotes'));
        $pdf = \PDF::loadView('pdf_email.pdf', compact('quotes'));
        $gsuk = 'ROKA-0000'.$id;
        $email = $quotes->client->email;

        Mail::send('pdf_email.plain_text', [], function ($message) use ($pdf, $client, $gsuk, $email) {
            $message->from('info@furniturepaintspraying.co.uk', 'FurnitureSpray');
            $message->to($email)->subject('ROKA quote –'.$gsuk);
            $message->cc('info@furniturepaintspraying.co.uk')->subject('Roka quote –'.$gsuk);
            $message->attachData($pdf->output(), $gsuk.'.pdf');
        });

        $quotes->status = 'sent';
        $quotes->update();
        $pdf->download($gsuk.'.pdf');
        return back()->with('success','PDF sent successfully!');

    }
    //send_pdf
      //download pdf
    public function send_pdf($id)
    {

        $quotes = $this->get_by_id($this->_modal, $id);
        $client = $quotes->client_id;
        $pdf = \PDF::loadView('pdf_email.pdf', compact('quotes'));
        $gsuk = 'ROKA-0000'.$id;
        $email = $quotes->client->email;

        Mail::send('pdf_email.plain_text', [], function ($message) use ($pdf, $client, $gsuk, $email) {
            $message->from('info@furniturepaintspraying.co.uk', 'FurnitureSpray');
            $message->to($email)->subject('ROKA quote –'.$gsuk);
            $message->cc('info@furniturepaintspraying.co.uk')->subject('Roka quote –'.$gsuk);
            $message->attachData($pdf->output(), $gsuk.'.pdf');
        });

        $quotes->status = 'sent';
        $quotes->update();

       return redirect()->route('quote.index')->with('success','PDF sent successfully!');

    }


    public function pdf($id)
    {
        $quotes = $this->get_by_id($this->_modal, $id);
        $pdf = \PDF::loadView('pdf.pdf', compact('quotes'));

        return $pdf->stream();
    }
}
