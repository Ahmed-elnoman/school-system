<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'time',
        'subject_id',
        'classRoom_id',
        'teacher_id'
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function classRoom() {
        return $this->belongsTo(ClassRoom::class, 'classRoom_id');
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

}
