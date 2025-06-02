<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('user')->latest();
    
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('subject', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%"));
        }
    
        $tickets = $query->paginate(10);
        return view('admin.tickets.index', compact('tickets'));
    }
    

    public function show(Ticket $ticket)
    {
        $ticket->load('replies.user');
        return view('admin.tickets.show', compact('ticket'));
    }

    public function close(Ticket $ticket)
    {
        $ticket->status = 'closed';
        $ticket->save();
        return back()->with('success', 'تیکت بسته شد.');
    }

    public function reopen(Ticket $ticket)
    {
        $ticket->status = 'open';
        $ticket->save();
        return back()->with('success', 'تیکت دوباره باز شد.');
    }

    public function toggleStatus($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->closed = !$ticket->closed;
        $ticket->save();

        return redirect()->route('admin.tickets.index')->with('success', 'وضعیت تیکت با موفقیت تغییر یافت.');
    }

}
