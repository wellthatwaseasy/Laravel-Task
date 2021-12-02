<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    // show the login
    public function index(){
        return view('auth.login');
    }

    // login the user
    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(!Auth::attempt($request->only('email', 'password'),$request->remember)){
            return back()->with('status', 'Invalid Login Details');
        }
        return redirect()->route('dashboard');
    }
}
