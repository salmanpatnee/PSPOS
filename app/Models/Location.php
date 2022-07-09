<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'name',
        'location_id',
        'landmark',
        'city',
        'mobile',
        'email',
        'status'
    ];

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == 'Active' ? 1 : 0;
    }



    /**
     * Get the business details
     */
    public function business()
    {
        return $this->hasOne(Business::class, 'id', 'business_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";

        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('location_id', 'like', $term)
                ->orWhere('landmark', 'like', $term)
                ->orWhere('city', 'like', $term)
                ->orWhere('mobile', 'like', $term)
                ->orWhere('email', 'like', $term);
        });
    }
}
