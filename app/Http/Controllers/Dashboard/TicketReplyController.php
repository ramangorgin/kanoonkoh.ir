<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketReplyController extends Controller
{
    public function store(Request $request, $ticket_id)
    {
        $ticket = Ticket::where('id', $ticket_id)
            ->where(function ($q) {
                $q->where('user_id', auth()->id());
            })->firstOrFail();

        $data = $request->validate([
            'message' => 'required|string',
            'attachments.*' => 'nullable|file|max:2048',
        ]);

        $attachments = [];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachments[] = $file->store('tickets/attachments', 'public');
            }
        }

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $data['message'],
            'attachments' => $attachments,
        ]);

        $ticket->update(['closed' => false]);

        return back()->with('success', 'پاسخ شما ثبت شد.');
    }
}
