<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'student_id',
        'is_resolved',
        'date'
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
