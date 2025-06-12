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
        'phone',
        'emergency_phone',
        'province',
        'city',
        'address',
        'postal_code',
        'previous_courses',
        'personal_photo',
        'blood_type',
        'job',
        'referrer',
        'height_cm',
        'weight_km',
        'medical_conditions',
        'allergies',
        'medications',
        'had_surgery',
        'emergency_contact_name',
        'emergency_contact_relation',
        'role',
        'membership_level',
        'membership_status',
        'membership_date',
        'points'
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
