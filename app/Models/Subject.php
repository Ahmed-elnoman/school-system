<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade',
        'description'
    ];

    public function results() {
        return $this->hasMany(Result::class);
    }

    public function timeTable() {
        return $this->hasMany(TimeTable::class);
    }


}