<!-- resources/views/login/partials/product_list.blade.php -->

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
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="width: 100px">
                @else
                    <!-- 画像がない場合の表示（何も表示しない、または代替のメッセージを追加できます） -->
                @endif
            </td>
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
