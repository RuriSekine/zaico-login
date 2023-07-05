<!DOCTYPE html>
<html lang="ja">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログインフォーム</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link href="{{ asset('css/sign.css') }}" rel="stylesheet">
    

</head>
<body>
<form method="post" action="{{ route('login') }}" class="form-sign">
@csrf
  <h1 class="tittle">ログインフォーム</h1>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <br>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
  <br>
  <label for="inputPassword" class="sr-only">Password</label>
  <br>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
  <br>
  <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</form>
</body>
</html>