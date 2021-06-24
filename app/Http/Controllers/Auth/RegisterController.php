<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        if($user){
            return redirect('login')->with(['success'=>'User Berhasil ditambahkan, Silakan Login']);                
        }
    }


}
