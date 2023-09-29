<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

/**`
     *バリデーションが成功した後に、新しい商品をデータベースに作成
     * @param  array  $data
     * @return \App\Models\Product
     */

    public static function createProduct(array $data)
    {
        
        /**$company = Company::firstOrCreate([
            'company_name' => $data['company_name'],
            'street_address' => $data['street_address'] ?? "",
            'representative_name' => $data['representative_name'] ?? "",
        ]);
        */
             // 会社の名前からIDを取得
            $company = Company::where('company_name', $data['company_name'])->first();
            if (!$company) {
                throw new \Exception("The company with name {$data['company_name']} not found.");
            }
            $data['company_id'] = $company->id;

            return Product::create([
            'company_id' => $data['company_id'],
            'product_name'=> $data['product_name'],
            'price' => '￥' . $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'] ?? "",
            'img_path' => $data['img_path'] ?? "",
        ]);
    }

    public function updateProduct(array $data)
    {
        
        /**$company = Company::firstOrCreate([
            'company_name' => $data['company_name'],
        ]);
        */
            $company = Company::where('company_name', $data['company_name'])->first();
            if (!$company) {
                throw new \Exception("The company with name {$data['company_name']} not found.");
            }
            $data['company_id'] = $company->id;

            $this->company_id = $data['company_id'];
            $this->product_name = $data['product_name'];
            $this->price = '￥' . $data['price'];
            $this->stock = $data['stock'];
            $this->comment = $data['comment'] ?? "";
            $this->img_path = $data['img_path'] ?? "";
            $this->save();
    }
}

