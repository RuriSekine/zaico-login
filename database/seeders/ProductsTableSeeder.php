<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Company;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ja_JP');  // 日本語のFakerのインスタンスを作成

        // 商品名のリストを作成
        $productNames = ['水', 'お茶', 'コーヒー', 'ジュース', 'ビール', 'ワイン', 'ウィスキー', 'サイダー', '焼酎', '日本酒'];

        // 5つの商品を作成
        for ($i = 0; $i < 20; $i++) {
            $company = Company::inRandomOrder()->first();
            // ランダムに会社を選択し、その会社のIDをcompany_idに設定
            DB::table('products')->insert([
                'company_id' => $company->id,
                'product_name' => $faker->randomElement($productNames),  // リストからランダムに商品名を選択
                'price' => '￥' . $faker->numberBetween($min = 1, $max = 1000),  // 価格の前に￥マークを追加
                'stock' => $faker->randomDigit,
                'comment' => '', // commentを空欄に設定
                'img_path' => $faker->imageUrl(),
            ]);
        }
    }
}