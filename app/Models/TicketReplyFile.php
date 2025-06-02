<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReplyFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_reply_id',
        'file_path',
    ];

    public function reply()
    {
        return $this->belongsTo(TicketReply::class, 'ticket_reply_id');
    }
}
