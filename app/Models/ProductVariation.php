<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $with = ["stock_category"];

    function stock_category()
    {
        return $this->belongsTo(StockCategory::class);
    }
}
