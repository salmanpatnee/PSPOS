<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'product_id',
        'product_variation_id',
        'default_purchase_price',
        'default_selling_price',
    ];

    public function product_variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
