<?php

namespace App\Console\Commands;

use App\Mail\AcknowledgeMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Services\GetGMailMessageService;
use App\Interfaces\TicketRepositoryInterface;

class HourlyTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively fetch new message from a mailbox then make a new ticket with it.';

    /**
     * A property to hold the responsible repository for this controller
     * @var TicketRepositoryInterface
     */
    private TicketRepositoryInterface $ticketRepo;

    /**
     * Create a new command instance.
     * @param TicketRepositoryInterface $ticketRepo
     *
     * @return void
     */
    public function __construct(TicketRepositoryInterface $ticketRepo)
    {
        $this->ticketRepo = $ticketRepo;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(GetGMailMessageService $mailboxMsg)
    {
        // Create new ticket record using TicketRepository
        $this->ticketRepo->store($mailboxMsg->getMessage());

        $this->info('Successfully Added hourly ticket from a GMail mailbox fetched message.');
    }
}
