<?php

namespace App\Console\Commands;

use App\Interfaces\TicketRepositoryInterface;
use App\Services\GetMailboxMessageService;
use Illuminate\Console\Command;

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
    public function handle(GetMailboxMessageService $mailboxMsg)
    {
        // Create new ticket record using TicketRepository
//        $this->ticketRepo->store($mailboxMsg->getMessage());
//
//        $this->info('Successfully Added hourly ticket from a mailbox fetched message.');
    }
}
