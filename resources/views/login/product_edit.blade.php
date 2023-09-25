@extends('layouts.app')

@section('title', '商品情報編集画面')

@section('additional-styles')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link href="{{ asset('/css/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
<form method="post" action="{{ route('products.update', $product->id) }}"  enctype="multipart/form-data" class="form-edit">
    @csrf
    @method('PUT')
        <h1 class="tittle">商品情報編集画面</h1>

    <div class='Details'>    
        <div class="row border border-solid border-dark">
            <div class="input-group">
                <label for="inputID">Id</label>
                <span>{{ $product->id }}</span>
            </div>
            <div class="input-group">
                <label for="inputProduct">商品名<span class="required">*</span></label>
                <input type="text" id="inputProduct" name="product_name" value="{{ $product->product_name }}" class="form-control" required autofocus>
            </div>
            <div class="input-group">
                <label for="inputCompany">メーカー名<span class="required">*</span></label>
                <select id="inputSelect" name="select" class="form-select">
                    @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
                <!--<input type="text" id="inputCompany" name="company_name"  value="{{ $product->company->company_name }}" class="form-control" required>-->
            </div>
            <div class="input-group">
                <label for="inputPrice">価格<span class="required">*</span></label>
                <input type="number" id="inputPrice" name="price" value="{{ $product->price }}" class="form-control" required>
            </div>
            <div class="input-group">
                <label for="inputStock">在庫数<span class="required">*</span></label>
                <input type="number" id="inputStock" name="stock"  value="{{ $product->stock }}" class="form-control" required>
            </div>
            <div class="input-group">
                <label for="inputComment">コメント</label>
                <input type="text" id="inputComment" name="comment" value="{{ $product->comment }}" class="form-control comment-input">
            </div>
            <div class="input-group">
                <label for="inputImg">商品画像</label>
                <input type="file"  name="image">
            </div>
            <div class="btn-class">
                <button class="btn btn-lg btn-secondary btn-block btn-wide" type="submit" >更新</button>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-lg btn-primary btn-block btn-wide">戻る</a>
            </div>
        </div>
    </div>    
</form>
@endsection