<?php

namespace App\Repositories;

use App\Events\CreateTicketEvent;
use App\Interfaces\TicketRepositoryInterface;
use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface
{
    public function index()
    {
        return Ticket::all()->sortDesc();
    }

    public function store(array $data)
    {
        // Create New Ticket Record
        Ticket::create($data);

        // Trigger the event
        event(new CreateTicketEvent($data));
    }

    public function show(Ticket $ticket)
    {
        return $ticket;
    }

    public function edit(Ticket $ticket)
    {
        return $ticket;
    }

    public function update(Ticket $ticket, array $data)
    {
        $ticket->update($data);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
    }

}
