@extends('layouts.app')

@section('title', '商品情報詳細画面')

@section('additional-styles')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link href="{{ asset('/css/show.css') }}" rel="stylesheet">
@endsection

@section('content')
@if (session('product_update'))
<div class="alert alert-success">
<!--更新完了のコメント表示-->
    {{ session('product_update') }}
</div>
@endif

<h1 class="tittle">商品情報詳細画面</h1>

<div class='Details'>
    <div class="row border border-solid border-dark">
    <div class="product-group">
        <p>Id</p>
        <span>{{ $product->id }}</span>
    </div>
    <div class="product-group">
        <p>商品画像</p>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="width: 100px">
            </div>
        </div>
    </div>    
    <div class="product-group">
        <p>商品名</p>
        <span>{{ $product->product_name }}</span>
    </div>    
    <div class="product-group">
        <p>メーカー名</p>
        <span>{{ $product->company->company_name }}</span>
    </div>
    <div class="product-group">
        <p>価格</p>
        <span>{{ $product->price }}</span>
    </div>
    <div class="product-group">
        <p>在庫数</p>
        <span>{{ $product->stock }}</span>
    </div>
    <div class="product-group">
        <p>コメント</p>
        <div class="card" style="width: 18rem;height: 10rem">
            <div class="card-body">
                <span class="comment">{{ $product->comment }}</span>
            </div>    
        </div>
    </div>
    <div class="btn-class">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-lg btn-secondary btn-block btn-wide">編集</a>
        <a href="{{ route('products.index') }}" class="btn btn-lg btn-primary btn-block btn-wide">戻る</a>
    </div>

@endsection