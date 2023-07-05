<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginFormRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // View
    public function showLogin() {
        return view('login.login_form');
    }

    // @parm App\Http\Requests\loginFormRequest;
    public function login(loginFormRequest $request) {
        dd($request->all());
    }
}
