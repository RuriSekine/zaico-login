<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー新規登録画面</title>
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link href="{{ asset('/css/register.css') }}" rel="stylesheet">
    

</head>
<body>
<form method="post" action="{{ route('register') }}" class="form-register">
@csrf
  <h1 class="tittle">ユーザー新規登録画面</h1>
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

  <br>
  <input type="text" id="inputName" name="user_name" class="form-control" placeholder="氏名" required autofocus>
  <br>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="アドレス" required autofocus>
  <br>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="パスワード" required>
  <br>
  <input type="password" id="inputPasswordConfirmation" name="password_confirmation" class="form-control" placeholder="パスワード確認" required>
<div class="btn-class">
  <button class="btn btn-lg btn-secondary btn-block" type="submit" >新規登録</button>
  <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-block btn-wide">戻る</a>
</div>  
</form>
</body>
</html>