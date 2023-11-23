<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeFor extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_fees',
        'first_payment',
        'second_payment',
        'classRoom_id'
    ];

    public function student(){
        return $this->hasMany(Student::class, 'id');
    }

    public function classRoom() {
        return $this->belongsTo(ClassRoom::class, 'id');
    }
}
