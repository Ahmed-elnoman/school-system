<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'job',
        'student_id'
    ];

    public function students() {
        return $this->belongsToMany(Student::class, 'id');
    }
}
