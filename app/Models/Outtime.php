<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outtime extends Model
{
    protected $table = 'outtime';
    use HasFactory;

    protected $fillable = [
        'RFID',
        'out_time',
    ];
}
