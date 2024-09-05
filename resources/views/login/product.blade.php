<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧画面</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @vite('resources/sass/app.scss')
    <link href="{{ asset('/css/product.css') }}" rel="stylesheet">
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">

    <script>
        $(document).ready(function() {
            $('#product-table').tablesorter({
                sortList: [[0, 0]],
                headers: {
                1: { sorter: false }, // 商品画像カラムのソート無効化
                2: { sorter: false }, // 商品名カラムのソート無効化
                5: { sorter: false }, // メーカー名カラムのソート無効化
                6: { sorter: false }, // 新規登録ボタンのカラムのソート無効化
            }
                
            });
        });
    </script>

    <!-- ver.jsを読み込む -->
    <script src="{{ asset('/js/ver.js') }}"></script> 

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
    <!--検索機能-->
    <div class="center-container">
        <form method="POST" action="{{ route('searchList') }}" id="search-form" data-search-list-url="{{ route('searchList') }}">
            @csrf
            <div class="input-group">
                <div class="search">
                    <label>キーワード
                    <div>
                        <input type="text" class="form-control" placeholder="検索キーワード" name="keyword">
                    </div>
                    </label>
                </div>
                
                <div class="search">
                    <label>メーカー名
                    <div>
                        <select id="inputSelect"  class="form-select" name="company_name">
                            <option value="">メーカー名</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    </label>
                </div>
            </div>    

            <div class="price-group">
                <div class="search">
                    <label>価格
                    <div>
                        <input type="number" id="priceMin" class="price-min"  name="price_min" placeholder="下限価格">
                        <span>～</span>
                        <input type="number" id="priceMax" class="price-max"  name="price_max" placeholder="上限価格">        
                    </div>
                    </label>
                </div>
            </div>
            
            <div class="stock-group">
                <div class="search">
                    <label>在庫数
                    <div>
                        <input type="number" id="stockMin" class="stock-min"  name="stock_min" placeholder="下限数">
                        <span>～</span>
                        <input type="number" id="stockMax" class="stock-max"  name="stock_max" placeholder="上限数">        
                    </div>
                    </label>
                </div>
            </div>

            <div class="search">
                <input type="button" id="search-icon" value="検索" class="btn btn-primary">
            </div>
        </form> 
    </div>
    <div class='link' id="product-list">
    <table id="product-table" class="table table-bordered">
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
            <td>
                @if ($product->img_path && File::exists(public_path('storage/' . $product->img_path)))
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="max-width: 60px; height: auto;">
                    @else
                    <!-- 画像がない場合の表示（何も表示しない、または代替のメッセージを追加できます） -->
                @endif
            </td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ optional($product->company)->company_name }}</td>
            <td>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary details-btn">詳細</a>
            </td>
            <td>
                <form method="POST" action="{{ route('products.destroy', [$product->id]) }}" class="product-delete" data-product-id="{{ $product->id }}">
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
    <script src="{{ asset('/js/ver.js') }}"></script> 
</body>
</html>