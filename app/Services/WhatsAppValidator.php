<?php

namespace App\Services;

use GuzzleHttp\Client;

class WhatsAppValidator
{
    public function validate($number)
    {
        $client = new Client();
        
        try {
            $response = $client->post('https://whatsapp-number-validator3.p.rapidapi.com/WhatsappNumberHasItBulkWithToken', [
                'headers' => [
                    'x-rapidapi-key' => '0e95d8075bmsh8bbfe35ba552e46p1b4e74jsna5c641c772b7',
                    'x-rapidapi-host' => 'whatsapp-number-validator3.p.rapidapi.com',
                    'Content-Type' => 'application/json'
                ],
                'json' => ['phone_numbers' => [$number]]
            ]);
            
            $result = json_decode($response->getBody(), true);
            return $result[0]['status'] === 'valid';
            
        } catch (\Exception $e) {
            return false;
        }
    }
}