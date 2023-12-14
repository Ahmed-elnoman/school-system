<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'class_room_id',
        'time'
    ];

    public function result() {
        return $this->hasMany(Result::class);
    }

    public function subject() {
        return $this->belongsTo(ClassRoom::class, 'class_room_id');
    }

}