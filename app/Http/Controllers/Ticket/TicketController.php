<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Resources\Ticket\TicketResource;
use App\Services\Ticket\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(
        private TicketService $ticket
    ){}

    public function store(StoreTicketRequest $request)
    {
        try {
            $ticket = $this->ticket->createFormRequest($request);
            return TicketResource::make($ticket)->response()->setStatusCode(201);
        }catch (\Throwable $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function statistics(Request $request)
    {
        $period = $request->get('period');
        if (!empty($period)) {
            return $this->ticket->getStatisticPeriod($period);
        }
        return response()->json(
            $this->ticket->getStatistics()
        );
    }

}
