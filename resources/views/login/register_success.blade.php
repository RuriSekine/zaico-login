@extends('layouts.app')

@section('content')
    <div class="alert alert-success">
        登録完了しました！数秒後にログイン画面へ遷移します。
    </div>

    <script src="{{ asset('/js/register_success.js') }}"></script>
@endsection