<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'brand_id',
        'product_id',
        'sku',
        'name',
        'image',
        'description',
        'vat',
        'units_sold',
        'stock_threshold',
        'default_purchase_price',
        'default_selling_price',
        'status',
        'created_by',
        'updated_by'
    ];

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == 'Active' ? 1 : 0;
    }

    public function getBrandNameAttribute()
    {
        return isset($this->brand) ? $this->brand->name : '';
    }

    public function getImagePathAttribute()
    {
        return !is_null($this->image)
            ? asset('images/products/' . $this->image)
            : null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the location wise details of the the product.
     */
    public function product_locations()
    {
        return $this->hasMany(PurchaseProductLocation::class, 'location_id', 'product_id');
    }

    /**
     * Get the variations associated with the product.
     */
    public function variations()
    {
        return $this->hasMany(\App\Variation::class);
    }

    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('description', 'like', $term)
                ->where('status', 1)
                ->orWhereHas('category', function ($query) use ($term) {
                    $query->where('name', 'like', $term);
                })
                ->orWhereHas('brand', function ($query) use ($term) {
                    $query->where('name', 'like', $term);
                });
        });
    }

    /**
     * Scope a query to only include active products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
