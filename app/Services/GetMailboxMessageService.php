<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GetMailboxMessageService
{
    public function getMessage()
    {
        // Mailtrap Api Response
        $response = Http::get('https://mailtrap.io/api/v1/inboxes/' . env('MAILTRAP_INBOX_ID') . '/messages?api_token=' . env('MAILTRAP_API_TOKEN'));

        // Convert Response To A Readable Array
        $responseData = $response->json();

        // Select Random Message From The Email Box
        $message = $responseData[mt_rand(0, count($responseData)-1)];

        // Required Data To Submit A Ticket
        $messageSubject     = $message['subject'];
        $messageFromEmail   = $message['from_email'];
        $messageToEmail     = $message['to_email'];

        // Message Content Stored In A txt File On Mailtrap Server, So We're Going To Visit This txt File URL (Path)
        $messageContentUrl = 'https://mailtrap.io' . $message['txt_path'] . '?api_token=' . env('MAILTRAP_API_TOKEN');

        // Get The Content From The txt File
        $messageContent = file_get_contents($messageContentUrl);

        // The Final Data To Be Stored As A New Ticket Into The Database
        $data = [
            'email'     => $messageFromEmail,
            'subject'   => $messageSubject,
            'content'   => $messageContent,
        ];

        return $data;
    }
}
