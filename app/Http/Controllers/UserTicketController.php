<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Storage;

class UserTicketController extends Controller
{
  
    public function index()
    {
        $tickets = auth()->user()->tickets()->latest()->get();
        return view('dashboard.tabs.tickets', compact('tickets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'department' => 'required|string|in:کارگروه فرهنگی,کارگروه محیط‌زیست,کارگروه طبیعت‌گردی,کارگروه روابط عمومی,کارگروه اداری,کارگروه فنی و آموزشی',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:4096',
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request->file('attachment')->store('ticket_attachments', 'public');
        }

        $validated['user_id'] = auth()->id();
        Ticket::create($validated);

        return back()->with('success', 'تیکت شما با موفقیت ثبت شد.');
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('ticket_attachments', 'public');
        }

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'attachment' => $path,
        ]);

        // optionally update status
        $ticket->update(['status' => 'open']);

        return back()->with('success', 'پاسخ شما ثبت شد.');
    }
}
