@extends('layouts.app')

@section('content')
    <div class="alert alert-success">
        登録完了しました！数秒後に商品一覧画面へ遷移します。
    </div>

    <script src="{{ asset('/js/product_success.js') }}"></script>
@endsection