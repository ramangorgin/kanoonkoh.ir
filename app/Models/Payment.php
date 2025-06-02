<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use App\Models\Course;
use App\Models\User;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'type', 'related_id', 'date', 'transaction_code',
        'receipt_file', 'approved'
    ];

    protected $casts = [
        'date' => 'datetime',
        'approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relatedProgram()
    {
        return $this->belongsTo(Program::class, 'related_id')->where('type', 'program');
    }

    public function relatedCourse()
    {
        return $this->belongsTo(Course::class, 'related_id')->where('type', 'course');
    }
}
