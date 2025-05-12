<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot([
            'certificate_file', 'submitted_by', 'status', 'notes'
        ])->withTimestamps();
    }

    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }

}
