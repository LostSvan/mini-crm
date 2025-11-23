<?php

namespace App\Services\Ticket;

use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Models\Ticket;
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
            'subject' => $request->subject,
            'text' => $request->text,
            'customer_id' => $customer->id,
            'status' => 'new'
        ]);

        if ($request->hasFile('м')) {
            $ticket->addMedia($request->file('file'))->toMediaCollection('ticket_file');
        }
        return $ticket;
    }

    public function getStatistics()
    {
        return [
            'day' => Ticket::day()->count(),
            'month' => Ticket::month()->count(),
            'week' =>Ticket::week()->count()
        ];
    }

    public function getStatisticPeriod($period)
    {
        if (!method_exists(Ticket::class, 'scope'.ucfirst($period))) {
            return ['error' => "Есть только такие периоды: 'day', 'week'', 'month'"];
        }
        return [
            $period => Ticket::$period()->count()
        ];
    }

    public function getAllTickets($request)
    {
        $filters = $request->only(['status', 'from', 'to', 'phone', 'email']);

        if (!empty(array_filter($filters))) {
            return $this->ticket->getAllWithFilters($filters)->orderByDesc('id')
                ->paginate(10);
        }

        return $this->ticket->getAllWithPaginate();
    }

    public function updateStatusTicket($ticket, $status)
    {
        $ticket->status = $status;
        if ($status === 'done') {
            $ticket->answered_at = now();
        }

        $ticket->save();

        return $ticket;
    }

    public function delete(Ticket $ticket)
    {
        return $ticket->delete();
    }
}
