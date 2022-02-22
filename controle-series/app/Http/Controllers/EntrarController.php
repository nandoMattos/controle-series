<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{
    public function index()
    {
        return view('entrar.index');
    }


    public function entrar(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($credenciais)){
            return back()->withErrors([
                'email' => 'Email ou senha inválido(s).'
            ]);
        }
        $request->session()->regenerate();

        return redirect('/series');
    }
}
