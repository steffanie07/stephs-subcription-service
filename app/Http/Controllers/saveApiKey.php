<?php
use Illuminate\Http\Request;
use App\Models\MailerLiteApiKey; 
use MailerLiteApi\MailerLite;





public function validateApiKey(Request $request)
{
    $apiKey = $request->input('api_key');

    $mailerLite = new MailerLite($apiKey);
    $accountApi = $mailerLite->accounts();

    try {
        $account = $accountApi->get();

        // Save the API key to the database
        $mailerLiteApiKey = new MailerLiteApiKey();
        $mailerLiteApiKey->api_key = $apiKey;
        $mailerLiteApiKey->save();

        // Redirect the user to the main page
        return redirect()->route('subscribers.index');
    } catch (\Exception $e) {
        // If the API key is not valid, redirect back to the form with an error message
        return redirect()->route('validate-api-key-form')->with('error', 'Invalid API key');
    }
}
