<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'capacity',
        'student_count',
        'student_id'
    ];


    public function students() {
        return $this->hasMany(Student::class, 'id');
    }

    public function timeTable() {
        return $this->hasOne(TimeTable::class);
    }

    public function charge_for() {
        return $this->hasOne(ChargeFor::class);
    }
}
