<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'exam_id',
        'marks',
        'year',
        'type_result'
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function exam() {
        return $this->belongsTo(Exam::class,'exam_id');
    }
}