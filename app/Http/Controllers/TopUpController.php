<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\TopUp;
use App\Models\Order;
use App\Repository\OrderRepository;
use DB;

class TopUpController extends Controller
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
        return view('member.topup');
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
    public function store(Request $request)
    {
        
        $validated = $request->validate([            
            'mobile_phone'=>'required|regex:/^081[0-9]{4,8}$/i',            
            'value'=>'required|numeric',            
        ],
        [
            'mobile_phone.regex'=>'The :attribute must start with 081 ,number &between 7 - 12',            
    ]);

        // because laravel regex cannot using | , i'm using this
        $pattern = '/^(10000|50000|100000)$/';
        if($request->value &&  !preg_match($pattern,$request->value)){
            return back()->withInput()->withErrors([
                'value'=>'The value must be 10000,50000,1000000'
            ]);
        }

        try {
            DB::beginTransaction();
            $product = TopUp::create([
            'mobile_number'=>$request->mobile_phone,
            'value'=>$request->value,            
            'user_id'=>auth()->user()->id
        ]);   
        if($product){
            DB::commit();
            $request->session()->put('orderTable',['type'=>'topup','no_order'=>(new Order)->generate(),'data'=>(new Order)->mappingData($product)]);
            return redirect('member-area/success')->with(['success'=>'Success!']);                
        } 
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors([
            'er' => $e->getMessage(),
        ]);           
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function edit(TopUp $topUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopUp $topUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopUp  $topUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopUp $topUp)
    {
        //
    }
}
