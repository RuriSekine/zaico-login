@extends('layouts.app')

@section('content')
    <div class="alert alert-success">
        更新完了しました！数秒後に商品情報詳細画面へ遷移します。
    </div>

    <script src="{{ asset('/js/update.js') }}"></script>
@endsection