<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title', 'description', 'start_date' , 'end_date',
        'has_transport',
        'departure_place_tehran', 'departure_tehran_datetime',
        'departure_karaj_datetime', 'departure_lat_tehran', 'departure_lon_tehran',
        'departure_place_karaj', 'departure_lat_karaj', 'departure_lon_karaj',
        'required_equipment', 'required_meals',
        'is_free', 'member_cost', 'guest_cost',
        'card_number', 'sheba_number', 'card_holder', 'bank_name',
        'is_registration_open', 'registration_deadline',
    ];

    protected $casts = [
        'has_transport' => 'boolean',
        'is_free' => 'boolean',
        'is_registration_open' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function photos()
    {
        return $this->hasMany(ProgramPhoto::class);
    }

    public function roles()
    {
        return $this->hasMany(\App\Models\ProgramUserRole::class);
    }
    
    public function userRoles()
    {
        return $this->hasMany(ProgramUserRole::class);
    }


    public function leader() { return $this->belongsTo(User::class, 'leader_id'); }
    public function assistant_leader() { return $this->belongsTo(User::class, 'assistant_leader_id'); }
    public function technical_manager() { return $this->belongsTo(User::class, 'technical_manager_id'); }
    public function guide() { return $this->belongsTo(User::class, 'guide_id'); }
    public function support() { return $this->belongsTo(User::class, 'support_id'); }
}

