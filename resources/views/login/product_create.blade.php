@extends('layouts.app')

@section('title', '商品新規登録画面')

@section('additional-styles')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link href="{{ asset('/css/create.css') }}" rel="stylesheet">
@endsection

@section('content')
<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data" class="form-create">
    @csrf
        <h1 class="tittle">商品新規登録画面</h1>
        @if ($errors->any())
        <div class="alert alert-danger register-error">
            <!--バリデーション-->
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    
        <section class="container">
            <div class="row border border-solid border-dark">
                <div class="input-group">
                    <label for="inputProduct">商品名<span class="required">*</span></label>
                    <input type="text" id="inputProduct" name="product_name" class="form-control"  required autofocus>
                </div>
                <div class="input-group">
                    <label for="inputCompany">メーカー名<span class="required">*</span></label>
                    <select id="inputSelect" name="select" class="form-select">
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <label for="inputPrice">価格<span class="required">*</span></label>
                    <input type="number" id="inputPrice" name="price" class="form-control" required>
                </div>
                <div class="input-group">
                    <label for="inputStock">在庫数<span class="required">*</span></label>
                    <input type="number" id="inputStock" name="stock" class="form-control" required>
                </div>
                <div class="input-group">
                    <label for="inputComment">コメント</label>
                    <input type="text" id="inputComment" name="comment" class="form-control comment-input">
                </div>
                <div class="input-group">
                    <label for="inputImg">商品画像</label>
                    <input type="file" name="image">
                </div>
                <div class="btn-class">
                    <button class="btn btn-lg btn-secondary btn-block" type="submit" >新規登録</button>
                    <a href="{{ route('products.index') }}" class="btn btn-lg btn-primary btn-block btn-wide">戻る</a>
                </div>
            </div>
        </section>  
</form>
@endsection