<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playtimesprice extends Model
{
    use HasFactory;
    protected $table = 'playtime_prices';
    protected $fillable = [
        'name',
        'price',
    ];

}
