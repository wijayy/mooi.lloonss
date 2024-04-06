<?php

namespace App\Models;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockCategory extends Model
{
    use HasFactory;

    protected $with = ["stocks"];

    function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}