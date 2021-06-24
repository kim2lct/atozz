<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.product');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validated = $request->validate([            
            'product'=>'required|min:10|max:150',
            'shipping_address'=>'required|min:10|max:150',
            'price'=>'required|numeric',
        ]);

        try {
            DB::beginTransaction();
            $product = Product::create([
            'product'=>$request->product,
            'shipping_address'=>$request->shipping_address,
            'price'=>$request->price,
            'user_id'=>auth()->user()->id
        ]);   
            
        if($product){
            DB::commit();
            $request->session()->put('orderTable',['type'=>'product','no_order'=>(new Order)->generate(),'data'=>(new Order)->mappingData($product)]);
            return redirect('member-area/success')->with(['success'=>'Success!']);                
        } 
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors([
            'er' => 'Terjadi Kesalah di sistem',
        ]);           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
