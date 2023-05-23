<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quote;
use Auth;
use Hash;
class UserOrCustomerController extends Controller
{
    private $_request = null;
    private $_modal = null;
    private $_qModel = null;

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(Request $request, User $modal, Quote $qModel)
    {
        $this->_request = $request;
        $this->_modal = $modal;
        $this->_qModel = $qModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = $this->get_all_by_roll($this->_modal)->sortDesc();
        $slug = "customer";
        return view('home',compact('slug','data'));

    }


    // here  get all client info by ajax
    public function allclient($id)
    {
        $clients = $this->get_all_by_roll($this->_modal)->sortBy('name');

        if($id != 'null') {
            $quote = $this->get_by_id($this->_qModel, $id);
        }
        else{
            $quote = 'null';
        }
        $client  = view('render_data.clients', compact('clients', 'quote'))->render();

        return response()->json([
            'client' =>$client,
            'quote' =>$quote,
        ]);
    }


    public function clientinfo($id)
    {

        $client = $this->get_by_id($this->_modal, $id);
        // return view('render_data.clients')->rendor('data');
        // $client  = view('render_data.clients', compact('data'))->render();

        return response()->json([
            'client' =>$client
        ]);
    }

    public function client_data(Request $request){
        //dd($request->id);
        $get_client = $this->get_by_id($this->_modal, $request->id);
        //dd($get_client);
        return response()->json($get_client);
    }

    public function client_store(Request $request){
        $this->validate($this->_request,
        [
            'name' => 'required|string|max:191',
            'email' => 'required|e-mail|unique:users',
            'postal_code'=> 'required',
        ]);
        $customer = $this->_request->only(
            'name',
            'email',
            'password',
            'phone',
            'postal_code',
            'address',
            'latitude',
            'longitude',
            'trade_discount',
        );
        $customer = $this->_request->except('_token');

        //we use UB6 8JN  zip code for starting point
        $lati1= $this->_request->latitude;
        $long1 = $this->_request->longitude;
        $final_distance = $this->find_distance($lati1,$long1);

        $customer['user_id'] = Auth::user()->id;
        $customer['password'] = Hash::make('123456');
        $customer['distance'] = $final_distance;
        $var = $this->add($this->_modal, $customer);
        $var->assignRole('client');

        //dd($customer);

        return response()->json($var);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $client=$this->_modal;
        return view('customer.add_customer', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // dd($this->_request->all());
        $this->validate($this->_request,
        [
            'name' => 'required|string|max:191',
            'email' => 'required|e-mail|unique:users',
            'postal_code'=> 'required',
        ]);
        $customer = $this->_request->only(
            'name',
            'email',
            'password',
            'phone',
            'postal_code',
            'address',
            'latitude',
            'longitude',
            'trade_discount',
            );
        $customer = $this->_request->except('_token');
        //we use UB6 8JN  zip code for starting point
        $lati1= $this->_request->latitude;
        $long1 = $this->_request->longitude;
        $final_distance = $this->find_distance($lati1,$long1);

        $customer['user_id'] = Auth::user()->id;
        $customer['password'] = Hash::make('123456');
        $customer['distance'] = $final_distance;
        $var = $this->add($this->_modal, $customer);
        $var->assignRole('client');
        if($this->_request->quote_create != 1)
        {
            return redirect()->route('customer.index')->with('success','Customer added successfully!');
        }
        return redirect()->route('quote.create')->with('success','Customer added successfully!');
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

        $client = $this->get_by_id($this->_modal, $id);
        return view('customer.edit_customer', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $modal
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // dd($this->_request->all());
        //check here if the customer email already exist
        $check_email = $this->get_by_id($this->_modal, $id);
        if($check_email->email != $this->_request->email)
        {
            $this->validate($this->_request,
            [
                'name' => 'required|string|max:191',
                'email'=> 'required|e-mail|unique:users',
                'postal_code'=> 'required',
            ]);
        }
        $customer = $this->_request->only(
            'name',
            'email',
            'phone',
            'postal_code',
            'address',
            'latitude',
            'longitude',
            'trade_discount',
            );

        $lati1= $this->_request->latitude;
        $long1 = $this->_request->longitude;

            $final_distance = $this->find_distance($lati1,$long1);
            $customer['distance'] = $final_distance;
            $check_email->update($customer);
        return redirect()->route('customer.index')->with('success','Customer updated successfully!');
    }
    // find distance
    public function find_distance($lati1,$long1)
    {
        //we use UB6 8JN  zip code for starting point
        $radius = 6371;
        $latitude1 = 51.537042;
        // $latitude1 = 51.5657281;  HA9 7RD
        $longitude1 = -0.333705;
        //$longitude1 = -0.30114879999996447;  HA9 7RD
        $latitude2 = $lati1;
        $longitude2 = $long1;

        $lat2 = (double)$latitude2;
        $long2 = (double)$longitude2;

        $latfrom = deg2rad($latitude1);
        $lonfrom = deg2rad($longitude1);
        $latto = deg2rad($lat2);
        $lonto = deg2rad($long2);
        //dd($latto);
        $latdelta = $latto - $latfrom;
        $londelta = $lonto - $lonfrom;

        $angle = 2 * asin(sqrt(pow(sin($latdelta / 2), 2) + cos($latfrom) * cos($latto) * pow(sin($londelta / 2), 2)));
        $distance_in_km = $angle * $radius;

        $distance_in_miles = $distance_in_km * 0.621371;

        $final_distance = (round($distance_in_miles, 2));
        return $final_distance;
    }
    // admin update his profile
    public function admin_update(){
        // dd($this->_request->all());
        $id = Auth::user()->id;
        if($this->_request->password == ''){
            $real_pass = Auth::user()->password;

            $admin = $this->get_by_id($this->_modal, $id);
            //$data = $this->_request->except('_token', '_method','password');
            $admin->name = $this->_request->name;
            $admin->email = $this->_request->email;
            $admin->password = $real_pass;
            $admin->address = $this->_request->address;
            $admin->save();
        }else{
            $password = $this->_request->password;
            $admin = $this->get_by_id($this->_modal, $id);
            $admin->name = $this->_request->name;
            $admin->email = $this->_request->email;
            $admin->password = Hash::make($password);;
            $admin->address = $this->_request->address;
            $admin->save();
        }
        return back()->with('success','Profile updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $modal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->delete($this->_modal, $id);
        return redirect()->route('{{ routeName }}');
    }
}
