<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuestItem;
use App\Models\Quote;
use App\Models\DeliveryCharges;
use App\Models\Deals;
use Auth;


class GuestItemController extends Controller
{
    private $_request = null;
    private $_modal = null;
    private $_qmodal = null;
    private $_dcmodal = null;
    private $_dmodal = null;

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(Request $request, GuestItem $modal, Deals $dmodal, Quote $qmodal, DeliveryCharges $dcmodal)
    {
        $this->_request = $request;
        $this->_modal = $modal;
        $this->_qmodal = $qmodal;
        $this->_dcmodal = $dcmodal;
        $this->_dmodal = $dmodal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view({{ view_name }});
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $delivery  = $this->get_by_id(new DeliveryCharges, 1);
        
        if($this->_request->quote_id != null)
        {
            $id = $this->_request->quote_id;
            $var = $this->get_by_id($this->_qmodal, $id);

            $deal = Deals::where('quote_id', $id)->get();
            $collected = $deal->sum('total_gross');
            $collected = round($collected, 2);

            //$quote['client_id'] = $var->client_id;

            $previous = $this->_qmodal::where('id', '<', $this->_request->quote_id)->max('id');
            $next = $this->_qmodal::where('id', '>', $this->_request->quote_id)->min('id');

            //$var->update($quote);
        }else{
            if($this->_request->client_id == null)
            {
                return back()->with('error','Select client first');
            }
            $quote = $this->_request->only('client_id', 'comment', 'internal_comment');
            $quote['user_id'] = Auth::user()->id;
            $quote['collected'] = $this->_request->price;
            $quote['delivered'] = $delivery->total_charges;
            $var = $this->add($this->_qmodal, $quote); 
        }

        $item = $this->_request->except('_token');
        $item['title'] = $this->_request->title;
        $item['price'] = $this->_request->price;
        $item['description'] = $this->_request->description;
    
        $itemdata = $this->add($this->_modal, $item);

        //dd($itemdata->id);

        //  Deals
        $data['quote_id'] = $var->id;
        $data['guest_id'] = $itemdata->id;
        $data['width'] = 0;
        $data['height'] = 0;
        $data['sqm'] = 0;
        $data['product_price'] = $this->_request->price;
        $data['matt_finish_option'] = 0;
        $data['matt_finish'] = 0;
        $data['spraying_edges'] = 0;
        $data['metallic_paint'] = 0;
        $data['wood_stain'] = 0;
        $data['gloss_percentage'] = 0;
        $data['gloss_100_acrylic_lacquer'] = 0;
        $data['polyester'] = 0;
        $data['burnished_finish'] = 0;
        $data['barrier_coat'] = 0;
        $data['edgebanding'] = 0;
        $data['micro_bevel'] = 0;
        $data['routed_handle_spraying'] = 0;
        $data['beaded_door'] = 0;
        $data['quantity'] = $this->_request->quantity;
        $data['net_price'] = $this->_request->net_price;
        $data['vat'] = $this->_request->vat;
        $data['trade_discount'] = $this->_request->trade_discount;
        $data['total_gross'] = $this->_request->total_price;

        // create Deals
        $var2 = $this->add(new Deals, $data);
        return redirect()->route('quote.create', compact('var'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $this->_modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->get_by_id($this->_modal, $id);
        return view('{{view_name}}', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $this->_modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deal = $this->get_by_id($this->_dmodal, $id);
        return view('guest_item.edit', compact('deal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  DeliveryCharges  $modal
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        //$data = $data = $this->get_by_id($this->_dmodal, $id);
        //$data = $this->_request->only('quote_id', 'client_id','quantity', 'trade_discount', 'net_price', 'vat', 'total_price');
        $data['quantity'] = $this->_request->quantity;
        $data['trade_discount'] = $this->_request->trade_discount;
        $data['net_price'] = $this->_request->net_price;
        $data['total_gross'] = $this->_request->total_price;
        $data['vat'] = $this->_request->vat;

        $this->get_by_id($this->_dmodal, $id)->update($data);
        
        $data = $this->get_by_id($this->_dmodal, $id);
        //dd($data);
        $guest['title'] = $this->_request->title;
        $guest['description'] = $this->_request->description;
        $guest['price'] = $this->_request->price;

        $this->get_by_id($this->_modal, $data->guest_id)->update($guest);
        $var = $this->get_by_id($this->_qmodal, $data->quote_id);

        return redirect()->route('quote.create', compact('var'))->with('success','Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeliveryCharges  $modal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_item_row = GuestItem::findOrFail($id);
        $delete_item_row->delete();

        return back()->with('error','Item deleted!');
    }
}
