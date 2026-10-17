<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory; 
    
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'quantity_in_stock',
        'image_product',
        'store_id',
    ];

     protected static function newFactory()
    {
        return ProductFactory::new();
    }
    
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class , 'categories_products','product_id','category_id');
    }

    public function similarProducts()
    {
        $catIds = $this->categories()->pluck('category_id');
        return Products::whereHas('categories', function ($query) use ($catIds) {
            $query->whereIn('category_id', $catIds);
        })->where('id', '!=', $this->id)->inRandomOrder()->limit(8)->get();
    }


 
}
