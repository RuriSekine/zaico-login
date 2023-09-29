<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧画面</title>
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link href="{{ asset('/css/product.css') }}" rel="stylesheet">
        
</head>
<body>
    @if (session('login_success'))
    <div class="alert alert-success">
    <!--ログイン完了のコメント表示-->
        {{ session('login_success') }}
    </div>
    @endif
    @if (session('product_success'))
    <div class="alert alert-success">
    <!--商品登録完了のコメント表示-->
        {{ session('product_success') }}
    </div>
    @endif
    <h1 class="tittle">商品一覧画面</h1>
    <div class="center-container">
        <div class="input-group">
            <form method="GET" action="{{ route('products.index') }}">
                <input type="text" class="form-control" placeholder="検索キーワード" name="keyword">
                    <div class="input-group-select">
                        <select id="inputSelect" name="company_name" class="form-select">
                            <option value="">メーカー名</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
            <span class="input-group btn">
                <button type="submit" class="btn btn-primary">検索</button>
            </span>
            </form>    
        </div>
    </div>    
    <div class='link'>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th>
                    <a href="{{ route('products.create') }}" class="btn btn-lg btn-secondary btn-block btn-wide">新規登録</a>
                </th>
                </tr>
        </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="width: 100px"></td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company->company_name }}</td>
            <td>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">詳細</a>
            </td>
            <td>
                <form method="POST" action="{{ route('products.destroy', [$product->id]) }}" class="product-delete">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-lg btn-secondary btn-danger btn-wide">削除</button>
                </form>    
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
    {{ $products->links('pagination::bootstrap-4') }}
    </div>
</body>
</html>