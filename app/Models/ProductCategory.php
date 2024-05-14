<?php

namespace App\Models;


use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_category';
    protected $fillable = [
        'name',
        // Add other fillable fields here if needed
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
