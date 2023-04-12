<?php

namespace App\Helpers;
use App\Models\MailerLiteApiKey;
use Illuminate\Support\Facades\Redirect;
use MailerLiteApi\MailerLite;

class MailerLiteHelper
{
    public static function createMailerLiteInstance()
    {
        // Retrieve the API key from the database
        $apiKeyRecord = MailerLiteApiKey::first();

        // If the API key is not found in the database, handle the error
        if (!$apiKeyRecord) {
            // Throw an exception or return an error response
            //throw new \Exception('API key not found');
            return Redirect::route('validate-api-key-form')->with('error', 'API key not found');
        }

        // Create a MailerLite instance with the API key from the database
        $mailerLite = new MailerLite($apiKeyRecord->api_key);

        return $mailerLite;
    }
}
