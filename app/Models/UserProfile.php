<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'father_name', 'birth_date', 'national_id', 'gender', 'mobile',
        'province', 'city', 'address', 'postal_code',
        'emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relation',
        'insurance_number', 'insurance_issue_date', 'insurance_expiration_date', 'insurance_file',
        'blood_type', 'health_conditions', 'allergies',
        'experience_level', 'personal_equipment', 'completed_courses',
        'id_card_scan', 'profile_photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
