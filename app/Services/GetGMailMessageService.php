<?php

namespace App\Services;

use Webklex\IMAP\Facades\Client;

class GetGMailMessageService
{
    public function getMessage()
    {
        // Connect With IMAP Server
        $client = Client::account('default');
        $client->connect();

        // An Array To Hold All Unseen Messages After Iterations
        $allUnseenMessages = [];

        // Get All Folders
        $folders = $client->getFolders();
        
        // Loop Through Folders
        foreach($folders as $folder) {
            // Get Unseen Messages With Limiting Result 10 To Avoid High Execution Time 
            $unseenMessages = $folder->query()->unseen()->limit(10)->get();

            // Loop Through Unseen Messages To Structure A New Array Of Just Unseen Messages
            foreach($unseenMessages as $message){
                $allUnseenMessages[] = $message;
            }
        }

        // Get Only One Random Messages From $allUnseenMessages Array
        $message = $allUnseenMessages[array_rand($allUnseenMessages)];
        
        // Edit The Message Make It As Seen To Avoid Fetching It Again
        $message->setFlag('Seen');

        // Required Data To Submit A Ticket
        $messageSubject     = $message->getSubject()[0];
        $messageFromEmail   = $message->getFrom()[0]->mail;
        $messageToEmail     = $message->getTo()[0]->mail;
        $messageContent     = ($message->hasTextBody()) ? $message->getTextBody() : $message->getHTMLBody();

        // The Final Data To Be Stored As A New Ticket Into The Database
        $data = [
            'email'     => $messageFromEmail,
            'subject'   => $messageSubject,
            'content'   => $messageContent,
        ];

        return $data;
    }
}
