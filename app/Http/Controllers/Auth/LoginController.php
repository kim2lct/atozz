<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(){    
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $validated = $request->validate([            
            'email'=>'required',
            'password'=>'required',
        ]);

        $credentials = $request->only('email', 'password');        
            if (Auth::attempt($credentials)) {
            $request->session()->regenerate();            
            // dd($request->session()->all());  
            return redirect()->intended('member-area');
        }

        return back()->withErrors([
            'er' => 'Email and Password doest matched',
        ]);        
    }

    public function logout(){        
        Auth::logout();
        return redirect('login');
    }   
}
