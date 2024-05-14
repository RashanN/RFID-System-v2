<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productdraft extends Model
{
    use HasFactory;
    protected $table = 'productdraft';
    protected $fillable = [
        'customer_id', 'product_id', 'date', 'amount', 'quantity',
    ];

    // Define relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
