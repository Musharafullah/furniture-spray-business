<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use File;
class ProductController extends Controller
{
    private $_request = null;
    private $_modal = null;

    /**
     * Create a new controller instance.
     *
     * @return $reauest, $modal
     */
    public function __construct(Request $request, Product $modal)
    {
        $this->_request = $request;
        $this->_modal = $modal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = $this->get_all($this->_modal);
        $slug = "products";
        return view('home',compact('slug','data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view({{ view_name }});
        $product =$this->_modal;
        return view('product.add_product', compact('product'));
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
            'type'=> 'required',
            'code' => 'required|unique:products,code',
            'product_name' => 'required|unique:products,product_name',
            'sale_net_sqm'=> 'required',
        ]);

        $product = $this->_request->only(
            'type',
            'code',
            'product_name',
            'cost_from_supplier',
            'sale_net_sqm',
            'matt_finish',
            'spraying_edges',
            'metallic_paint',
            'wood_stain',
            'gloss_80',
            'gloss_100_paint',
            'gloss_100_acrylic_lacquer',
            'polyester_or_full_grain',
            'burnished_finish',
            'edgebanding',
            'micro_bevel',
            'product_note',
            'routed_handle_spraying',
            'beaded_door',
            'barrier_coat',
        );
        //dd($product);
        $product = $this->_request->except('_token');

        if($this->_request->type == "standard" || $this->_request->type == "basic")
        {
            $product['matt_finish'] = 0;
            $product['spraying_edges'] = 0;
            $product['metallic_paint'] = 0;
            $product['gloss_80'] = 0;
            $product['gloss_100_paint'] = 0;
            $product['gloss_100_acrylic_lacquer'] = 0;
            $product['edgebanding'] = 0;
            $product['micro_bevel'] = 0;
            $product['routed_handle_spraying'] = 0;
            $product['beaded_door'] = 0;
            $product['burnished_finish'] = 0;
            $product['polyester_or_full_grain'] = 0;
            $product['wood_stain'] = 0;
            $product['barrier_coat'] = 0;
        }

        if($this->_request->type == "full_paint")
        {
            $product['polyester_or_full_grain'] = 0;
            $product['wood_stain'] = 0;
            $product['barrier_coat'] = 0;
        }

        if($this->_request->type == "full_wood")
        {
            $product['gloss_100_paint'] = 0;
            $product['metallic_paint'] = 0;
            $product['gloss_80'] = 0;
            $product['micro_bevel'] = 0;
        }


        if ($this->_request->file('product_image'))
        {
            $file = $this->_request->file('product_image');
            $fileName   =  $file->getClientOriginalName();
            // Storage::disk('public')->put($path, File::get($file));
            $file->move(public_path('product_image/product'), $fileName );
            $product['product_image_path'] = $fileName;
        }

        // dd($product);
        $var = $this->add($this->_modal, $product);
        return redirect()->route('product.index')->with('success','product has been added');
    }
    // get product type
    public function product_info($id)
    {
        $product_type = $this->get_by_id($this->_modal, $id);
        return response()->json([
            'product_type' =>$product_type->type
        ]);
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
    //get products detail through ajax
    public function product_data($id)
    {
        $get_product = $this->get_by_id($this->_modal, $id);
        return response()->json($get_product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $this->_modal  $modal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = $this->get_by_id($this->_modal, $id);
        return view('product.edit_product',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $modal
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // dd($this->_request->all());
        $this->validate($this->_request,[
            'type'=> 'required',
            'code' => 'required',
            'product_name' => 'required',
            'sale_net_sqm'=> 'required',
        ]);

        $product = $this->_request->only(
            'type',
            'code',
            'product_name',
            'cost_from_supplier',
            'sale_net_sqm',
            'matt_finish',
            'spraying_edges',
            'metallic_paint',
            'wood_stain',
            'gloss_80',
            'gloss_100_paint',
            'gloss_100_acrylic_lacquer',
            'polyester_or_full_grain',
            'burnished_finish',
            'edgebanding',
            'micro_bevel',
            'product_note',
            'routed_handle_spraying',
            'beaded_door',
            'barrier_coat',
        );
        // dd($product);
        $product = $this->_request->except('_token');
        $exist = $this->get_by_id($this->_modal, $id);

        if($this->_request->type == "standard" || $this->_request->type == "basic")
        {
            $product['matt_finish'] = 0;
            $product['spraying_edges'] = 0;
            $product['metallic_paint'] = 0;
            $product['gloss_80'] = 0;
            $product['gloss_100_paint'] = 0;
            $product['gloss_100_acrylic_lacquer'] = 0;
            $product['edgebanding'] = 0;
            $product['micro_bevel'] = 0;
            $product['routed_handle_spraying'] = 0;
            $product['beaded_door'] = 0;
            $product['burnished_finish'] = 0;
            $product['polyester_or_full_grain'] = 0;
            $product['wood_stain'] = 0;
            $product['barrier_coat'] = 0;
        }

        if($this->_request->type == "full_paint")
        {
            $product['polyester_or_full_grain'] = 0;
            $product['wood_stain'] = 0;
            $product['barrier_coat'] = 0;
        }

        if($this->_request->type == "full_wood")
        {
            $product['gloss_100_paint'] = 0;
            $product['metallic_paint'] = 0;
            $product['gloss_80'] = 0;
            $product['micro_bevel'] = 0;
        }

        if ($this->_request->file('product_image'))
        {
            $file = $this->_request->file('product_image');
            $fileName  =  $file->getClientOriginalName();
            // Storage::disk('public')->put($path, File::get($file));
            $file->move(public_path('product_image/product'), $fileName );
        }else{
            $fileName =  $exist->product_image_path;
        }

        $product['product_image_path'] = $fileName;
        $var = $exist->update($product);
        return redirect()->route('product.index')->with('success','product has been updated');
    }

    public function duplicate($id)
    {
        // dd($id);
        $copy = '-copy';
        $diplicate_product = $this->get_by_id($this->_modal, $id);
        //dd($diplicate);
        $diplicate_product = $diplicate_product->replicate();
        $diplicate_product->product_name = $diplicate_product->product_name.'-copy';
        $diplicate_product->code = $diplicate_product->code.'-copy';

        $diplicate_product->save();
        return back()->with('alert-success', 'Product Duplicate Successfully');
        //dd($code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $modal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->delete($this->_modal, $id);
        return redirect()->route('{{ routeName }}');
    }


    //get products detail through ajax
    // public function product_data($id)
    // {
    //     $product = $this->get_by_id($this->_modal, $id);
    //     //dd($product);
    //     return response()->json($product);
    
    // }
}
