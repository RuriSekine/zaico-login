<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Productモデルの使用を宣言
use App\Models\Company; // companyモデルの使用を宣言
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $companies = Company::all();

        $query = Product::query();

        // キーワードによる検索
        if ($request->filled('keyword')) {
        $query->where('product_name', 'LIKE', '%' . $request->input('keyword') . '%');
        }

        // メーカー名による絞り込み
        if ($request->filled('name')) {
        $query->where('company_id', $request->input('name'));
        }

        $products = $query->paginate(10);//10ページずつ表示
        return view('login.product', ['companies' => $companies, 'products' => $products]);//$companiesと$productsというデータをresourcesのviewのビューファイルproduct.blade.phpに渡して表示せよ
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('login.product_create',['companies' => $companies]);  // 新規登録フォームのビューを表示
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        DB::transaction(function () use ($request) {
        // データのバリデーション
        $this->validator($request->all())->validate();

        //データベースに画像のパスを保存する必要がある
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); 
            }

        // バリデーションが通ったら商品をデータベースに作成(モデル)
        Product::createProduct(array_merge($request->all(), ['img_path' => $path]));
        });

        //コメント表示
        return view('login.product_success');
        
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
        'product_name' => ['required', 'string', 'max:255'],
        'company_name' => ['required', 'string', 'max:255', 'exists:companies,company_name'],
        'price' => ['required', 'numeric', 'min:0'],
        'stock' => ['required', 'integer', 'min:0'],
    ]);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 詳細ページを表示
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('login.product_show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *編集ページを表示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $companies = Company::all();
        return view('login.product_edit', ['product' => $product, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *編集データーベースに保存
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
        $product = Product::find($id);  //IDを検索

        // データのバリデーション
        $this->validator($request->all())->validate();

        //データベースに画像のパスを保存する必要がある
        $oldImagePath = $product->img_path; // 既存の画像パスをデフォルト
        if ($request->hasFile('image')) {
            if ($oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
            $path = $request->file('image')->store('images', 'public');
        } else {
            $path = $oldImagePath;
        }

        // バリデーションが通ったら商品をデータベース更新(モデル)
        //$productDate変数にまとめる
        $productData = array_merge($request->all(), ['img_path' => $path]);
        $product->updateProduct($productData);
        });

        //コメント表示
        return view('login.product_update'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
        $product = Product::find($id);
        
        //削除処理
        $product->delete();
        });

        //コメント表示
        return view('login.product_delete');
        
    }

}
