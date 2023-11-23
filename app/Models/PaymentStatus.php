<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_fees',
        'payment_status',
        'description',
        'student_id'
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
