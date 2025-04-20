<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'user_id',
        'height_cm',
        'weight_kg',
        'blood_type',
        'medical_conditions',
        'allergies',
        'medications',
        'emergency_notes',
        'physical_limitations',
        'last_medical_check',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
