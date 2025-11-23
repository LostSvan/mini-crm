<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Models\Ticket;
use App\Services\Ticket\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function __construct(private TicketService $ticket){}
    public function index(Request $request)
    {
        $tickets = $this->ticket->getAllTickets($request);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('customer', 'media');
        return view('admin.tickets.show', compact('ticket'));
    }

    public function updateStatus(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket = $this->ticket->updateStatusTicket($ticket, $request->status);

        return redirect()->back()->with('success', 'Статус обновлен');
    }

    public function destroy(Ticket $ticket)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'У вас нет прав на удаление тикетов');
        }

        $this->ticket->delete($ticket);

        return redirect()->back()->with('success', 'Тикет удалён');
    }

}
