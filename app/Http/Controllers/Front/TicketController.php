<?php

namespace App\Http\Controllers\Front;

use App\Events\CreateTicketEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Tickets\StoreTicketRequest;
use App\Http\Requests\Front\Tickets\UpdateTicketRequest;
use App\Interfaces\TicketRepositoryInterface;
use App\Models\Ticket;
use App\Services\GetTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var TicketRepositoryInterface
     */
    private TicketRepositoryInterface $ticketRepo;

    /**
     * @param TicketRepositoryInterface $ticketRepo
     */
    public function __construct(TicketRepositoryInterface $ticketRepo)
    {
        $this->ticketRepo = $ticketRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Tickets using TicketRepository
        $tickets = $this->ticketRepo->index();

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        // Create new ticket record using TicketRepository
        $this->ticketRepo->store($request->except(['_token']));

        return redirect()->route('tickets.index')->with('success', 'Ticket Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        // Show the specific ticket using TicketRepository
        $ticket = $this->ticketRepo->show($ticket);

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        // Edit the specific ticket using TicketRepository
        $ticket = $this->ticketRepo->edit($ticket);

        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        // Update the specific ticket using TicketRepository
        $this->ticketRepo->update($ticket, $request->except(['_method', '_token']));

        return redirect()->route('tickets.index')->with('success', 'Ticket Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        // Delete the specific ticket using TicketRepository
        $this->ticketRepo->destroy($ticket);

        return redirect()->route('tickets.index')->with('success', 'Ticket Deleted Successfully!');
    }

    public function replies(Ticket $ticket)
    {
        $ticketID = $ticket->id;
        $replies = $ticket->replies;

        return view('tickets.ticketReplies', compact(['ticketID', 'replies']));
    }
}
