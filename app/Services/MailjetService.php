<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MailjetService
{
    protected $apiKey;
    protected $secretKey;

    public function __construct()
    {
        $this->apiKey = '30c952da49f12c2be8621ebf5ffd191a';
        $this->secretKey = 'daaf83789db44ffa560cec092c604ea5';
    }

    public function sendEmail($toEmail, $toName, $subject, $textPart, $attachments = [], $htmlPart = null)
{
    $message = [
        "From" => [
            "Email" => "support@sirsonite.in",
            "Name" => "Sirsonite"
        ],
        "To" => [
            [
                "Email" => 'shreyaunhale@sirsonite.com',
                "Name" => $toName
            ]
        ],
        "Subject" => $subject,
        "TextPart" => $textPart,
        "Attachments" => $attachments
    ];

    // ✅ Add HTML support
    if ($htmlPart) {
        $message["HTMLPart"] = $htmlPart;
    }

    return Http::withBasicAuth($this->apiKey, $this->secretKey)
        ->post('https://api.mailjet.com/v3.1/send', [
            "Messages" => [$message]
        ]);
}
}
