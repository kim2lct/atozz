<?php

namespace App\Http\Controllers;

use App\Repository\OrderRepository;

class UserController extends Controller
{
    public $order = '';
    public function __construct(){
        $this->middleware('auth');
        $this->order = new OrderRepository;
    }

    public function index(){        
        $orders = $this->order->all();
        return view('member.index',compact(['orders']));
    }
}
