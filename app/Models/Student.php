<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'gender',
        'address',
        'phone_parent',
        'level',
        'join_date',
        'chargeFor_id',
        'classRoom_id'
    ];

    public function chargeFar() {
        return $this->belongsTo(ChargeFor::class, 'chargeFor_id');
    }

    public function classRoom() {
        return $this->belongsTo(ClassRoom::class, 'classRoom_id');
    }

    public function issue() {
        return $this->hasOne(Issue::class);
    }

    public function results() {
        return $this->hasMany(Result::class);
    }
}
