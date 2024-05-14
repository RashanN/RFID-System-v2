<?php

namespace App\Models;

use App\Models\Order;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name', // Add 'name' to the fillable array
        'showprice',
        'unitprice',
        'stock_level',
        'description',
        'product_category_id',
        'supplier_id',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function productdrafts()
    {
        return $this->hasMany(Productdraft::class);
    }
}
