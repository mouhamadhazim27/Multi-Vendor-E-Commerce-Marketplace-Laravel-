<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'store_name',
        'store_slug',
        'business_email',
        'business_type',
        'phone_number',
        'address',
        'store_logo',
        'store_description',
        'in_progress',

    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    
  
}
