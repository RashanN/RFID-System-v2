<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class playtimeorder extends Model
{
    use HasFactory;

    protected $table = 'playtimeorder';

    protected $fillable = [
        'intime',
        'outime',
        'amount',
        'customer_id',
        'invoice_id',
        'child_id'

    ];
}
