<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intime extends Model
{
    protected $table = 'intime';
    use HasFactory;

    protected $fillable = [
        'RFID',
        'in_time',
    ];
}
