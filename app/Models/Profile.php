<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'father_name',
        'national_id',
        'personal_photo',
        'phone',
        'emergency_phone',
        'province',
        'city',
        'address',
        'postal_code',
        'previous_courses',
    ];

    protected $casts = [
        'previous_courses' => 'array',
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
 use HasFactory;
}