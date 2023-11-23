<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'address',
        'level',
        'medical_situation',
        'medical_situation_file',
        'chargeFor_id',
        'classRoom_id',
        'an_exception_id'
    ];

    public function chargeFar() {
        return $this->belongsTo(ChargeFor::class, 'chargeFor_id');
    }

    public function classRoom() {
        return $this->belongsTo(ClassRoom::class, 'classRoom_id');
    }

    public function an_exception() {
        return $this->belongsTo(AnException::class);
    }

    public function issue() {
        return $this->hasOne(Issue::class);
    }

    public function results() {
        return $this->hasMany(Result::class);
    }

    public function payment_status() {
        return $this->hasOne(PaymentStatus::class);
    }
    public function parent() {
        return $this->hasOne(Father::class);
    }

    // public function getCreatedAtColumn()
    // {
    //     return date('Y-m-d');
    // }

}
