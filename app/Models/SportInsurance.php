<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportInsurance extends Model
{
    protected $fillable = ['user_id', 'expiration_date', 'file_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

