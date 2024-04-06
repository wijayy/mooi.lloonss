<?php

namespace App\Models;

use App\Models\DeliveryOption;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;

    // protected $table = ["products"];
    protected $guarded = ["id"];
    // protected $with = ['category'];
    protected $with = ['category', 'variations', 'deliveries'];
    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function deliveries()
    {
        return $this->hasMany(DeliveryOption::class);
    }


    public function category()
    {
        return $this->belongsTo(ProductCategory::class, "product_category_id");
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeSearch($query, $filters)
    {
        $query->when($filters ?? false, function ($query, $search) {
            return $query->where("nama", "like", "%" . $search . "%");
            // ->orWhere("harga", "<=", $search);
        });
    }

    public function scopeCategory($query, $filters)
    {
        $query->when($filters ?? false, function ($query, $search) {
            return $query->orWhereHas("category", function ($query) use ($search) {
                $query->where("slug",  $search);
            });
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama',
            ],
        ];
    }
}
