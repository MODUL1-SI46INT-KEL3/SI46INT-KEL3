<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = "medicine";

    protected $fillable = [
        'medicine_name',
        'description',
        'price',
        'stock',
    ];
}