<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Ticket\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Ticket;

class TicketController extends Controller
{
    public function __construct(private TicketService $ticket){}
    public function index(Request $request)
    {
//        $status = $request->get('status');
//        $email = $request->get('email');
//        $phone = $request->get('phone');
//        $from = $request->get('from');
//        $to = $request->get('to');

//        $tickets = \App\Models\Ticket::when($status, function ($query) use ($status) {
//            $query->where('status', 'like', $status);
//        })->get();
        $tickets = $this->ticket->getAllTickets($request);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show()
    {

    }

    public function updateStatus()
    {

    }
}
