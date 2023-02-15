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
            'code'=> 'required|unique:products',
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
        'code',
        'product_name',
        'cost_from_supplier',
        'sale_net_sqm',
        'cut_out',
        'notch',
        'hole',
        'painted',
        'sparkle_finish',
        'metallic_finish',
        'printed',
        'cnc',
        'standblasted',
        'ritec',
        'rake',
        'type',
        'radius_corners',
        'product_note',
        'bevel_edges',
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

        'code' => 'required|unique:products,code',
        'product_name' => 'required|unique:products,product_name',
        ]);

        $product = $this->_request->only(
        'code',
        'product_name',
        'cost_from_supplier',
        'sale_net_sqm',
        'cut_out',
        'notch',
        'hole',
        'painted',
        'sparkle_finish',
        'metallic_finish',
        'printed',
        'cnc',
        'standblasted',
        'ritec',
        'rake',
        'type',
        'radius_corners',
        'product_note',
        'bevel_edges',
        );
        // dd($product);
        $product = $this->_request->except('_token');

        if ($this->_request->file('product_image'))
        {
            $file = $this->_request->file('product_image');
            $fileName  =  $file->getClientOriginalName();
            // Storage::disk('public')->put($path, File::get($file));
            $file->move(public_path('product_image/product'), $fileName );
        }else{
            $exist = $this->get_by_id($this->_modal, $id);
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
