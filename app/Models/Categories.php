<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['category_name'];

    public function products()
    {
        return $this->belongsToMany(
            Products::class,
            'categories_products',
            'category_id',
            'product_id'
        );
    }
}
