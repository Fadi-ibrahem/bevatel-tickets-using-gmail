<?php

namespace App\Interfaces;

use App\Models\Ticket;

interface TicketRepositoryInterface
{
    public function index();

    public function store(Array $data);

    public function show(Ticket $ticket);

    public function edit(Ticket $ticket);

    public function update(Ticket $ticket, Array $data);

    public function destroy(Ticket $ticket);
}
