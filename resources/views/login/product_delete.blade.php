@extends('layouts.app')

@section('content')
    <div class="alert alert-success">
        削除完了しました！数秒後に商品一覧画面へ遷移します。
    </div>

    <script src="{{ asset('/js/delete.js') }}"></script>
@endsection