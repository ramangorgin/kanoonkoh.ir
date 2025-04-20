<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'cover_image', 'type', 'difficulty_level',
        'peak_altitude', 'region', 'start_location', 'capacity', 'is_registration_open',
        'view_count', 'execution_date', 'registration_deadline',
        'departure_date_tehran', 'departure_time_tehran', 'departure_place_tehran',
        'departure_date_karaj', 'departure_time_karaj', 'departure_place_karaj',
        'leader_id', 'assistant_leader_id', 'technical_manager_id',
        'support_id', 'guide_id', 'member_cost', 'guest_cost',
        'required_equipment', 'required_meals', 'notes_for_participants',
        'has_insurance_required', 'status',
    ];
    public function registrations()
    {
        return $this->hasMany(ProgramRegistration::class);
    }

}
