<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login ()
    {
        return view('auth.login');
    }
//menambah mngecek di database ada atau tida
    public function auth(Request $request)
    {
        $validasi = $request->validate([
            'email' => 'required',
            'password' => 'required|min:5'
        ],[
            'email.required' => 'Email Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',
            'password.min' => 'Password Minimal 5 Karakter'
        ]);

        if(Auth::attempt($validasi)) {
            $request->session()->regenerate();

            return redirect()->route('buku.index')->with('success','Berhasil Login!!!');
        }
        return back();
    }

    public function logout()//membuat public logout----
    {
        Auth::logout();
        return redirect()->route('login');
    }
}