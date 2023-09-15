@extends('layouts.app')

@section('content')
    <div class="alert alert-success">
        ログイン成功しました！数秒後に商品一覧画面へ遷移します。
    </div>

    <script src="{{ asset('/js/login_success.js') }}"></script>
@endsection