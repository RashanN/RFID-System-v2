<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Playtimes;
use App\Models\Productdraft;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = ['name', 'contact'];
    protected $guarded = [];

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
   
    public function children()
    {
        return $this->hasMany(Child::class);
    }
    public function productdrafts()
    {
    return $this->hasMany(Productdraft::class);
    }
}
    