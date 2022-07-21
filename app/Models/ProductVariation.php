<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_id',
        'is_dummy'
    ];

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }
}
