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
        dd("here");
        // $all = $this->get_all($this->_modal);

        // return view({{ routeName }}, compact('all'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view({{ view_name }});
        return view('product.add_product');
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
            'code'=> 'required',
            'product_name'=> 'required',
            'product_image'=> 'required',
            'cost_from_supplier'=> 'required',
            'sale_net_sqm'=> 'required',
            'cut_out'=> 'required',
            'notch'=> 'required',
            'hole'=> 'required',
            'painted'=> 'required',
            'sparkle_finish'=> 'required',
            'metallic_finish'=> 'required',
            'printed'=> 'required',
            'cnc'=> 'required',
            'standblasted'=> 'required',
            'ritec'=> 'required',
            'rake'=> 'required',
            'radius_corners'=> 'required',
            'product_note'=> 'required',
            'bevel_edges'=> 'required',

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
            $path =  'product';
            Storage::disk('public')->put($path, File::get($file));
            $return_path = $path . '/' . $fileName;
            $product['product_image_path'] = $return_path;
        }
        // dd($product);
        $var = $this->add($this->_modal, $product);
        return redirect()->back()->with('success','product has been added');
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
        $data = $this->get_by_id($this->_modal, $id);
        return view('{{view_name}}', compact('data'));
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
     * @param  Product  $modal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->delete($this->_modal, $id);
        return redirect()->route('{{ routeName }}');
    }
}
