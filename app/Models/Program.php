<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function report()
    {
        return $this->hasOne(ProgramReport::class);
    }
    
    protected $fillable = [
        'title', 'slug', 'region', 'execution_date', 'type',
        'difficulty_level', 'peak_altitude', 'capacity',
        'member_cost', 'guest_cost', 'description', 'cover_image'
    ];

    public function registrations()
    {
        return $this->hasMany(ProgramRegistration::class);
    }
    
}

