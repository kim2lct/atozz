<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\TopUp;
use App\Repository\OrderRepository;
use App\Jobs\OrderStatus;
use DB;
use Str;

class OrderController extends Controller
{
    public $order;
    public function __construct(){
        $this->middleware('auth');
        $this->order =  new OrderRepository;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment($id)
    {
        
        $order = $this->order->findIdNewRow($id);
        if(!$order){
            abort(404);
        }
        
        return view('member.order-create',compact(['order']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = session()->get('orderTable');

        if(!$data){
            return redirect('member-area');
        }   
        
        $json = json_decode($data['data']);     
        
        $no = str_replace(' ', '', $data['no_order']);
        $product = ($data['type'] == 'product')?Product::find($json->id):TopUp::find($json->id);
        try {
            DB::beginTransaction();
            $order = $product->orders()->create([
                'no_order'=>$no,
                'status'=>'new',
                'price'=>$json->total,
                'user_id'=>auth()->user()->id
            ]);
            
            if($order){
                DB::commit();                 
                session()->forget('orderTable');                
                return redirect('member-area/payment/'.$order->id)->with(['success'=>'Order Berhasil!']);
            }
        } catch (Exception $e) {
            DB::rollback(); 
        }
        
    }

    public function success(){
         
        $data = session()->get('orderTable');  
        if(!$data){
            abort(403);
        }   
        return view('member.success',compact(['data']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {        
        $orderStatus = $order->update([
            'status'=>($this->order->checkPayment($order->id)?'success':'failed')
        ]);   

        if($order->orderable->product && $order->status == 'success'){
            $order->update([
                'status'=>'shipping',
                'shipping_code'=>(new Order)->generateShipcode()
            ]);
        }
        return redirect('member-area');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
