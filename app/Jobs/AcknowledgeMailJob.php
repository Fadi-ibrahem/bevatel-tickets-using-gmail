<?php

namespace App\Jobs;

use App\Services\SendGMailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;

class AcknowledgeMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SendGMailService $mail)
    {
        $token = Session::get('gtoken');
        $subject = 'This Is Subject From Bevatel Tikcet Management App With Mail Tracking For (Ticket Acknowledge) Hiring Task';
        $content = 'Hello <b>Everyone</b>,<br><br>This Is Email Body From Bevatel Tikcet Management App With Mail Tracking For (Ticket Acknowledge) Hiring Task in Laravel Project with Gmail OAuth2 and PHPMailer.<br><br>Thank you,<br><b>Fady Ibrahem</b>';
        $mail->sendEmail($token, 'fadyibrahem.dev@gmail.com', $subject, $content);
    }
}
