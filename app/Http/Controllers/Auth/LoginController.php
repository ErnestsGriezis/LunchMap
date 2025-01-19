<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(){
        return view('auth.login');
    }

    public function store(Request $request){
        //dd($request->all());
        $credentials=$request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);


    if(!Auth::attempt($credentials)){
    
      return back()
      ->withInput()
      ->withErrors([
        'email'=>"These credentials do not match out records."
      ]);
    }
    return redirect()->route('home');
    }

    public function destroy(Request $request){
        Auth::logout();

        // Invalidate the session to prevent session fixation attacks
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent potential issues
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}