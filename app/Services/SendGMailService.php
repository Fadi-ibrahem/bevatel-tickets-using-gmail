<?php

namespace App\Services;

use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class SendGMailService
{

    private $email;
    private $name;
    private $client_id;
    private $client_secret;
    private $token;
    private $provider;

    /**
     * Default Constructor
     */
    public function __construct()
    {
        $this->email            = env('GMAIL_FROM_ADDRESS');
        $this->email_name       = env('GMAIL_FROM_USERNAME');
        $this->client_id        = env('GMAIL_API_CLIENT_ID');
        $this->client_secret    = env('GMAIL_API_CLIENT_SECRET');
        $this->provider         = new Google(
            [
                'clientId'      => $this->client_id,
                'clientSecret'  => $this->client_secret
            ]
        );

    }

    /**
     * Send Email via PHPMailer Library
     */
    public function sendEmail(String $token, String $toEmail, String $subject, String $content)
    {
        $this->token = $token;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider'          => $this->provider,
                        'clientId'          => $this->client_id,
                        'clientSecret'      => $this->client_secret,
                        'refreshToken'      => $this->token,
                        'userName'          => $this->email
                    ]
                )
            );

            $mail->setFrom($this->email, $this->name);
            $mail->addAddress($toEmail);
            $mail->Subject = $subject;
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $body = $content;
            $mail->msgHTML($body);
            $mail->AltBody = 'This is a plain text message body';
            if( $mail->send() ) {
                return true;
            } else {
                return false;
            }
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Exception: ' . $e->getMessage());
        }
    }
}
