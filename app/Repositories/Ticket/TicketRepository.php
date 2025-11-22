<?php

namespace App\Repositories\Ticket;

use App\Models\Ticket;

class TicketRepository
{
    public function create($data)
    {
        return Ticket::create($data);
    }
}
