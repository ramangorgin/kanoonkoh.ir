<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // روابط

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function insurance()
    {
        return $this->hasOne(Insurance::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class)->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

        public function programRegistrations()
    {
        return $this->hasMany(ProgramRegistration::class);
    }

    public function courseRegistrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }
    public function transactions()
    {
        return $this->hasMany(\App\Models\Transaction::class);
    }    
}
