<?php

namespace App\Services\Ticket;

use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Ticket\TicketRepository;

class TicketService
{
    public function __construct(private CustomerRepository $customer, private TicketRepository $ticket){}
    public function createFormRequest(StoreTicketRequest $request)
    {
        $customer = $this->customer->firstOrCreate(
            $request->customer_phone,
            $request->customer_name,
            $request->customer_email);

        $ticket = $this->ticket->create([
            $request->subject,
            $request->text
        ]);

        return $ticket;
    }

    public function updateStatusTicket(UpdateTicketRequest $request)
    {

    }
}
