<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function auth(Request $request){

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(auth()->user()->active == 0){
                Auth::logout();
                return redirect()->back()->with('danger', 'Usuário inativo.');
            }
            return redirect('/home');
        }
        return redirect()->back()->with('danger', 'Email ou senha inválidos.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
