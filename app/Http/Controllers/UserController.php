<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function login() {
        return view('login');
    }

    public function log(Request $request) {
        if(Auth::attempt(['name'=>$request->username , 'password' => $request->password])){
            return redirect()->route('dashboard');
        }else {
            return redirect('login')->route('login')->with('error' , 'this user not exits');
        }
    }
    public function dashboard() {
        return view('admin.dashboard');
    }
}
