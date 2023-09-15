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
        
        $company = Company::firstOrCreate([
            'company_name' => $data['company_name'],
            'street_address' => $data['street_address'] ?? "",
            'representative_name' => $data['representative_name'] ?? "",
        ]);
        
            return Product::create([
            'company_id' => $company->id,
            'product_name'=> $data['product_name'],
            'price' => '￥' . $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'] ?? "",
            'img_path' => $data['img_path'] ?? "",
        ]);
    }

    public function updateProduct($data)
    {
        
        $company = Company::firstOrCreate([
            'company_name' => $data['company_name'],
        ]);
        
            $this->company_id = $company->id;
            $this->product_name = $data['product_name'];
            $this->price = '￥' . $data['price'];
            $this->stock = $data['stock'];
            $this->comment = $data['comment'] ?? "";
            $this->img_path = $data['img_path'] ?? "";
            $this->save();
    }
}

