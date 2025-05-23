<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Alert;
class LoginController extends Controller
{
    public function Login(){
        return view('auth.login',[
            'title' => 'Login SPP'
        ]);
    }

    public function AuthLogin(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
         ]);

         if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login Berhasil');
         }
         Alert::error('Gagal Login');
         return back()->with('error', 'Login Gagal !');
    }

    public function logout(){
        auth()->logout();

        return redirect('/auth');
    }
}
