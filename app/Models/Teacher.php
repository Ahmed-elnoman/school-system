<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'image',
        'gender',
        'address',
        'phone',
        'department_id',
        'salary',
        'join_date'
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function timeTables() {
        return $this->hasMany(TimeTable::class);
    }

    public function freeze() {
        return $this->hasMany(Freeze::class);
    }
}
