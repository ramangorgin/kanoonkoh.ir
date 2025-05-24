<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->tickets()->latest()->get();
        return view('dashboard.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('dashboard.tickets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Auth::user()->tickets()->create($data);

        return redirect()->route('dashboard.tickets.index')->with('success', 'تیکت شما ثبت شد.');
    }

    public function show(Ticket $ticket)
    {
        abort_if($ticket->user_id !== Auth::id(), 403);
        return view('dashboard.tickets.show', compact('ticket'));
    }
}
