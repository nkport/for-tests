<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    // 1つの仕入先は複数の商品を持てる
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_code', 'vendor_code');
    }
}
