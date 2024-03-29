<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザーログイン画面</title>
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link href="{{ asset('/css/sign.css') }}" rel="stylesheet">
    

</head>
<body>
<form method="post" action="{{ route('login') }}" class="form-sign">
@csrf
  <h1 class="tittle">ユーザーログイン画面</h1>
  @if ($errors->any())
    <div class="alert alert-danger" login-error>
      <!--バリデーション-->
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  @if (session('register_success'))
    <div class="alert alert-success">
      <!--新規登録完了のコメント表示-->
        {{ session('register_success') }}
    </div>
  @endif
  <br>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="アドレス" required autofocus>
  <br>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="パスワード" required>
<div class="btn-class">
  <a href="{{ route('register') }}" class="btn btn-lg btn-secondary btn-block btn-wide">新規登録</a>
  <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
</div>  
</form>
</body>
</html>