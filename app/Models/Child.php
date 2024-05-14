<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $table = 'child';
    protected $fillable = [
        'parent_id',
        'name',
        'DOB',
        'gender',
        'relationship',
        'school',
    ];
    public function customer()
    {
        
    return $this->belongsTo(Customer::class, 'customer_id');

    }
    public function lifemembers()
    {
        return $this->hasMany(Lifemember::class);
    }

}
