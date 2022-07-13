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
        'name',
        'image',
        'description',
        'price',
        'vat',
        'units_sold',
        'stock_threshold',
        'status',
        'created_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('description', 'like', $term)
                ->orWhereHas('category', function ($query) use ($term) {
                    $query->where('name', 'like', $term);
                })
                ->orWhereHas('brand', function ($query) use ($term) {
                    $query->where('name', 'like', $term);
                });
        });
    }
}
