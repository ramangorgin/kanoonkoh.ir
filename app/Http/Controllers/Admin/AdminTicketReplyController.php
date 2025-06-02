<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTicketReplyController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'message' => 'required|string',
            'attachments.*' => 'file|max:2048',
        ]);

        $reply = $ticket->replies()->create([
            'user_id' => auth()->id(),
            'message' => $data['message'],
        ]);

        if ($request->hasFile('attachments')) {
            $files = [];
            foreach ($request->file('attachments') as $file) {
                $files[] = $file->store('ticket_attachments', 'public');
            }
            $reply->attachments = $files;
            $reply->save();
        }

        return back()->with('success', 'پاسخ ارسال شد.');
    }

}
