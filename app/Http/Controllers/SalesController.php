<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale; // Saleモデルの使用を宣言
use App\Models\Product; // Productモデルの使用を宣言
use DB;

class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        // リクエストをバリデーション
        $validatedData = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            //テーブルのidフィールドに存在することをチェック。
            'quantity' => 'required|integer|min:1',
            //quantityが1以上であることをチェック
        ]);

        //商品を取得し在庫を確認
        $product = Product::find($validatedData['product_id']);

        //在庫が0の場合、エラーを返す
        if ($product->stock < $validatedData['quantity']) {
            return response()->json(['error' => 'Insufficient stock.'], 400);
        }

        // トランザクションで購入処理
        $sale = DB::transaction(function () use ($product, $validatedData) {
            // productsテーブルの在庫数を減算
            $product->stock -= $validatedData['quantity'];
            $product->save();

            //salesテーブルにレコードを追加
            return $sale = Sale::create([
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
            ]);
        });

        // 処理結果を返却
        return response()->json(['success' => true, 'data' => $sale], 201);
    }
}
