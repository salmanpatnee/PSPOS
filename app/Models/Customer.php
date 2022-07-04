<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'mobile',
        'date_of_birth',
        'address',
        'previous_balance',
        'total_purchases',
        'last_purchase'
    ];

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('mobile', 'like', $term);
        });
    }

    public function scopeType($query, $type)
    {
        if (is_null($type)) return $query;

        $operator = ($type == 1) ? '>' : '<=';

        $query->where(function ($query) use ($operator) {
            $query->where('previous_balance', $operator, 0);
        });
    }
}
