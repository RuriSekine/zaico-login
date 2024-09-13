<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // モデルが対応するテーブル名
    protected $table = 'sales';

    // Mass assignment 可能な属性
    protected $fillable = [
        'product_id',
        'quantity',
    ];

    // `Sale`モデルが`Product`モデルに属している
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
