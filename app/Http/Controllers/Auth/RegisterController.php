<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    // View
    public function showRegistrationForm() {
        return view('login.register_form');
    }

    public function register(Request $request) {
         // データのバリデーション
        $this->validator($request->all())->validate();

    // バリデーションが通ったらユーザーをデータベースに作成
        $this->create($request->all());

    //コメント表示
        return view('login.register_success');
    }

    /**
     * Create a new controller instance.
     *ログインしていないユーザーのみに制限されることを保証
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *入力されたデータが特定の条件やルールに合致するかを確認する
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
        protected function validator(array $data)
        {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
    }
    

    /**`
     * Create a new user instance after a valid registration.
     *バリデーションが成功した後に、新しいユーザーをデータベースに作成
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
        {
        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}