<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'related_id',
        'year',
        'transaction_code',
        'receipt_file',
        'approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

