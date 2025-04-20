<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramRegistration extends Model
{
    protected $fillable = [
        'program_id',
        'user_id',
        'name',
        'national_id',
        'phone',
        'emergency_phone',
        'reference_id',
        'agreement',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

