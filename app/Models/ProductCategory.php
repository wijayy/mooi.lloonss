<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;

    //     protected $with = [/*"variations,"*/'product'];

    // public function variations()
    // {
    //     return $this->hasMany(ProductVariation::class);
    // }

    //     public function category()
    //     {
    //         return $this->belongsTo(Product::class);
    //     }
}
