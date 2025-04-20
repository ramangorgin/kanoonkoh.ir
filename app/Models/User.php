<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
        'father_name', 'gender', 'birth_date', 'national_id',
        'phone_number', 'emergency_phone', 'address_line',
        'city', 'province', 'postal_code', 'marital_status',
        'introducer', 'profile_photo',
    ];
    
    
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }   
    public function membershipPayments()
    {
        return $this->hasMany(MembershipPayment::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function sportInsurances()
    {
        return $this->hasMany(SportInsurance::class);
    }


}
