<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ManufacturerController; 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//ログインフォーム表示
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//ログイン処理
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
//ユーザーをログアウト
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//新規登録フォーム表示
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//新規登録処理
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

//ログインしていないユーザーがこれらのルートにアクセスしようとすると、自動的にログインページにリダイレクト
Route::middleware(['auth'])->group(function () {
// 商品一覧、詳細表示、新規登録、編集、更新、削除のルートを一括で定義
Route::resource('products', ProductController::class);
// 非同期処理
Route::post('/search-list', [ProductController::class, 'searchList'])->name('searchList');
});


