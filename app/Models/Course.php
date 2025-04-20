<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'cover_image',
        'title',
        'description',
        'event_dates',
        'capacity',
        'instructor_id',
        'has_certificate',
        'event_time',
        'price',
    ];

    protected $casts = [
        'event_dates' => 'array',
        'has_certificate' => 'boolean',
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }
}
