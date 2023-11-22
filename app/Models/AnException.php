<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnException extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'discount_rate'
    ];
}
