<?php

namespace App\Models;

use App\Models\Child;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lifemember extends Model
{
    use HasFactory;

    protected $fillable = ['child_id', 'status'];
    protected $table = 'lifemember';

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
    
}
