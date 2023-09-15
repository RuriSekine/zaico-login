<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginFormRequest; 
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    // View
    public function showLoginForm() {
        return view('login.login_form');
    }

    // @parm App\Http\Requests\loginFormRequest;
    //emailとpasswordの内容が$credentialsに入っている
    public function login(loginFormRequest $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        // 成功したらログインコメント表示
        return view('login.login_success');
        }
        //失敗したら元の画面にもどるようにする
        return back()->withErrors([
            'login_error' => 'メールアドレスかパスワードが間違っています。',
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
