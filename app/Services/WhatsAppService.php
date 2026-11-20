<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    // public function sendTemplateMessage($to)
    // {
    //     $phoneNumberId = config('services.whatsapp.phone_number_id');
    //     $token = config('services.whatsapp.access_token');
    //     $version = config('services.whatsapp.api_version', 'v25.0');

    //     $response = Http::withToken($token)
    //         ->post("https://graph.facebook.com/{$version}/{$phoneNumberId}/messages", [
    //             'messaging_product' => 'whatsapp',
    //             'to' => $to,
    //             'type' => 'template',
    //             'template' => [
    //                 'name' => 'invoice_received',
    //                 'language' => [
    //                     'code' => 'en',
    //                 ],
    //                 'components' => [
    //                     [
    //                         'type' => 'body',
    //                         'parameters' => [
    //                             ['type' => 'text', 'text' => 'Customer Name'],
    //                             ['type' => 'text', 'text' => '1001'],
    //                             ['type' => 'text', 'text' => '1500'],
    //                         ],
    //                     ],
    //                 ],
    //             ],
    //         ]);

    //     return $response->json();
    // }
    public function sendTemplateMessage($to, $customerName, $invoiceNo, $amount)
    {
        $phoneNumberId = config('services.whatsapp.phone_number_id');
        $token = config('services.whatsapp.access_token');
        $version = config('services.whatsapp.api_version', 'v25.0');

        $response = Http::withToken($token)
            ->post("https://graph.facebook.com/{$version}/{$phoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => preg_replace('/\D/', '', $to),
                'type' => 'template',
                'template' => [
                    'name' => 'invoice_received',
                    'language' => ['code' => 'en'],
                    'components' => [
                        [
                            'type' => 'body',
                            'parameters' => [
                                ['type' => 'text', 'text' => $customerName],
                                ['type' => 'text', 'text' => $invoiceNo],
                                ['type' => 'text', 'text' => $amount],
                            ],
                        ],
                    ],
                ],
            ]);

        return $response->json();
    }

    public function uploadDocument($pdfContent, $fileName)
    {
        $phoneNumberId = config('services.whatsapp.phone_number_id');
        $token = config('services.whatsapp.access_token');
        $version = config('services.whatsapp.api_version', 'v25.0');

        $response = Http::withToken($token)
            ->attach('file', $pdfContent, $fileName, [
                'Content-Type' => 'application/pdf',
            ])
            ->post(
                "https://graph.facebook.com/{$version}/{$phoneNumberId}/media",
                [
                    'messaging_product' => 'whatsapp',
                    'type' => 'application/pdf',
                ]
            );

        return $response->json();
    }

    public function sendDocumentMessage($to, $mediaId, $fileName, $caption)
    {
        $phoneNumberId = config('services.whatsapp.phone_number_id');
        $token = config('services.whatsapp.access_token');
        $version = config('services.whatsapp.api_version', 'v25.0');

        $response = Http::withToken($token)
            ->post(
                "https://graph.facebook.com/{$version}/{$phoneNumberId}/messages",
                [
                    'messaging_product' => 'whatsapp',
                    'to' => $to,
                    'type' => 'document',
                    'document' => [
                        'id' => $mediaId,
                        'filename' => $fileName,
                        'caption' => $caption,
                    ],
                ]
            );

        return $response->json();
    }

    public function sendInvoicePdfTemplate($to, $mediaId, $fileName, $customerName, $invoiceNo, $amount)
    {
        $phoneNumberId = config('services.whatsapp.phone_number_id');
        $token = config('services.whatsapp.access_token');
        $version = config('services.whatsapp.api_version', 'v25.0');

        $response = Http::withToken($token)
            ->post(
                "https://graph.facebook.com/{$version}/{$phoneNumberId}/messages",
                [
                    'messaging_product' => 'whatsapp',
                    'to' => $to,
                    'type' => 'template',
                    'template' => [
                        'name' => 'invoice_with_pdf',
                        'language' => [
                            'code' => 'en',
                        ],
                        'components' => [
                            [
                                'type' => 'header',
                                'parameters' => [
                                    [
                                        'type' => 'document',
                                        'document' => [
                                            'id' => $mediaId,
                                            'filename' => $fileName,
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'type' => 'body',
                                'parameters' => [
                                    ['type' => 'text', 'text' => (string) $customerName],
                                    ['type' => 'text', 'text' => (string) $invoiceNo],
                                    ['type' => 'text', 'text' => (string) $amount],
                                ],
                            ],
                        ],
                    ],
                ]
            );

        return $response->json();
    }
}
