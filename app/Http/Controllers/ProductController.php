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
            // 'product_name'=> 'required',
            // 'product_image'=> 'required',
            // 'cost_from_supplier'=> 'required',
            // 'sale_net_sqm'=> 'required',
            // 'cut_out'=> 'required',
            // 'notch'=> 'required',
            // 'hole'=> 'required',
            // 'painted'=> 'required',
            // 'sparkle_finish'=> 'required',
            // 'metallic_finish'=> 'required',
            // 'printed'=> 'required',
            // 'cnc'=> 'required',
            // 'standblasted'=> 'required',
            // 'ritec'=> 'required',
            // 'rake'=> 'required',
            // 'radius_corners'=> 'required',
            // 'product_note'=> 'required',
            // 'bevel_edges'=> 'required',

        ]);

        $product = $this->_request->only(
            'type',
            'code',
            'product_name',
            'cost_from_supplier',
            // 'sale_net_sqm',
            // 'matt_finish',
            // 'min_charges',
            // 'spraying_edges',
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
        );
        // dd($product);
        $product = $this->_request->except('_token');


        if ($this->_request->file('product_image'))
        {
            $file = $this->_request->file('product_image');
            $fileName   =  $file->getClientOriginalName();
            // Storage::disk('public')->put($path, File::get($file));
            $file->move(public_path('product_image/product'), $fileName );
            $product['product_image_path'] = $fileName;
        }
        // if type="standered"
        if($this->_request->type == "standard")
        {
            // this rate will fixed sel net per square 30
            $product['sale_net_sqm'] = $this->_request->sale_net_sqm * 30;
            //
            $product['min_charges'] = '0';
            $product['matt_finish'] = '0';
            $product['spraying_edges'] = '0';
            $product['metallic_paint'] = '0';
            $product['gloss_80'] = '0';
            $product['gloss_100_paint'] = '0';
            $product['gloss_100_acrylic_lacquer'] = '0';
            $product['edgebanding'] = '0';
            $product['micro_bevel'] = '0';
            $product['routed_handle_spraying'] = '0';
            $product['beaded_door'] = '0';

        }
        // if type is full_paint
        if($this->_request->type == "full_paint")
        {
            // this rate will fixed sel net per square 30
            if($this->_request->matt_finish =="single")
            {
                $mat_finish_rate = '65';
            }else{
                $mat_finish_rate = '130';
            }
            $product['matt_finish'] = $mat_finish_rate;

            $product['min_charges'] = $this->_request->min_charges * 35;
            $product['spraying_edges'] = '5';
            if($this->_request->matt_finish =="yes")
            {
                $matalic_paint_1side = '5';
            }else{
                $matalic_paint_1side = '10';
            }
            $product['metallic_paint'] = $matalic_paint_1side;
            if($this->_request->gloss_80 =="yes")
            {
                $glass_80_1side = '10';
            }else{
                $glass_80_1side = '20';
            }
            $product['gloss_80'] = $glass_80_1side;
            $product['gloss_100_paint'] = '30';
            $product['gloss_100_acrylic_lacquer'] = '45';
            $product['edgebanding'] = '6';
            $product['micro_bevel'] = '4';
            $product['routed_handle_spraying'] = '15';
            $product['beaded_door'] = '14';

        }
        // if type is full_paint
        if($this->_request->type == "full_wood")
        {
            // this rate will fixed sel net per square 30
            $product['min_charges'] = $this->_request->min_charges * 30;
            if($this->_request->matt_finish =="yes")
            {
                $mat_finish_rate = '40';
            }else{
                $mat_finish_rate = '80';
            }
            $product['matt_finish'] = $mat_finish_rate;

            $product['spraying_edges'] = '3';

            if($this->_request->wood_stain =="yes")
            {
                $matalic_wood_1side = '3';
            }else{
                $matalic_wood_1side = '6';
            }
            $product['wood_stain'] = $matalic_wood_1side;
            if($this->_request->gloss_100_acrylic_lacquer =="yes")
            {
                $product['gloss_100_acrylic_lacquer'] = '44';
            }
            $product['polyester_or_full_grain'] = '100';
            $product['burnished_finish'] = '70';
            $product['edgebanding'] = '7.5';
            $product['routed_handle_spraying'] = '10';
            $product['beaded_door'] = '10';

        }

        // if type is type is full_paint
        // matt_finish


        // dd($product);
        $var = $this->add($this->_modal, $product);
        return redirect()->route('product.index')->with('success','product has been added');
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
        ]);

        $product = $this->_request->only(
            'type',
            'code',
            'product_name',
            'cost_from_supplier',
            'sale_net_sqm',
            'matt_finish',
            'min_charges',
            'spraying_edges',
            'metallic_paint',
            'wood_stain',
            'gloss_80%',
            'gloss_100%_paint',
            'gloss_100%_acrylic_lacquer',
            'polyester_or_full_grain',
            'burnished_finish',
            'edgebanding',
            'micro_bevel',
            'product_note',
            'routed_handle_spraying',
            'beaded_door',
        );
        // dd($product);
        $product = $this->_request->except('_token');
        $exist = $this->get_by_id($this->_modal, $id);

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
}
