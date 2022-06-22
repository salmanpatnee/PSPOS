<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'mobile', 'date_of_birth', 'address', 'previous_balance', 'total_purchases', 'last_purchase'];
}
