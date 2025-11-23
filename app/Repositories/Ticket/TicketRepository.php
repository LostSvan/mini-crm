<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;

class TicketRepository
{
    public function create($data)
    {
        return Ticket::create($data);
    }

    public function getAllWithPaginate()
    {
        return Ticket::orderBy('id', 'desc')->paginate(10);
    }

    public function getAllWithFilters($filter)
    {
        return Ticket::query()->join('customers', 'customers.id', '=', 'tickets.customer_id')->when($filter['status'] ?? null, function ($query, $status) {
            $query->where('status', $status);
        })
            ->when($filter['email'] ?? null, function ($query, $email) {
                $query->where('email', 'like', "%$email%");
            })->when($filter['phone'] ?? null, function ($query, $phone) {
                $query->where('phone', 'like', "%$phone%");
            })->when($filter['from'] ?? null, function ($query, $from) {
                $query->whereDate('tickets.created_at', '>=', $from);
            })->when($filter['to'] ?? null, function ($query, $to) {
                $query->whereDate('tickets.created_at', '<=', $to);
            })->select('tickets.*');
    }
}
