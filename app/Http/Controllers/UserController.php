<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\User;
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
            if(!Auth::attempt(['password' => $request->password])){
                session()->flash('error', 'كلمة السر غير صحيحة');
                return redirect()->route('login');
            }
            session()->flash('error', 'المستخدم غير موجود');
            return redirect()->route('login');
        }
    }
    public function dashboard() {
        $classes = ClassRoom::all();
        return view('admin.dashboard', compact('classes'));
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function profile($id) {
       $user = User::find($id);
        return view('admin.auth.profile', compact('user'));
    }
}