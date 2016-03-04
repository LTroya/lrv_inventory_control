<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\DoLoginRequest;
use Auth;

class AuthController extends Controller
{
    public function getLogin (Request $request)
    {
        return view('auth.login');
    }

    public function postLogin(DoLoginRequest $request)
    {
        $data = ['email' => $request->input('email'), 'password' => $request->input('password')];
        if (Auth::attempt($data)) {
            return redirect('/products');
        }
        return redirect()->back()->withErrors(['El usuario y/o el password son incorrectos.'])->withInput(['email']);
    }

    public function Logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
