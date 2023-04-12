<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriber;
use MailerLiteApi\MailerLite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Helpers\MailerLiteHelper;
use App\Models\MailerLiteApiKey;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */

   public function index()
{   
    $apiKeyExists = MailerLiteApiKey::exists();
    if (!$apiKeyExists) {
        return redirect()->route('validate-api-key-form');
    }else{
    $response = $this->fetchSubscribers();
    $errorMessage = null;
    if ($response['success']) {
        $subscribers = $response['data'];
    } else {
        $subscribers = [];
        // Pass the error message to the view
        $errorMessage = $response['message'];
    }
   
    return view('subscribers', compact('subscribers', 'errorMessage'));
}
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $apiKeyExists = MailerLiteApiKey::exists();
    if (!$apiKeyExists) {
        return redirect()->route('validate-api-key-form');
    }else{
    return view('create_subscribers');
    }
}
    /**
     * Store a newly created resource in storage.
     */
   
  
public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'name' => 'required',
        'country' => 'required',
    ]);

   $mailerLite = MailerLiteHelper::createMailerLiteInstance();
    $subscribersApi = $mailerLite->subscribers();

    // Check if the email address already exists in the subscribers list
    $existingSubscriber = $subscribersApi->find($request->input('email'));

  if ($existingSubscriber && isset($existingSubscriber->email)) {
        // If the email already exists, return an error message
        return redirect()->back()->with('error', 'Subscriber with this email already exists.');
    }
  
    // Create the new subscriber
    $subscriber = [
        'email' => $request->input('email'),
        'name' => $request->input('name'),
        'fields' => [
            'country' => $request->input('country'),
        ],
    ];

    try {
        $createdSubscriber = $subscribersApi->create($subscriber);

        
        return redirect()->route('subscribers.index')->with('success', 'Subscriber added successfully.');

    } catch (\Exception $e) {
        // Handle API errors as needed
        return redirect()->back()->with('error', 'Error creating subscriber: ' . $e->getMessage());
    }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  

    public function edit($id)
    {
    $mailerLite = MailerLiteHelper::createMailerLiteInstance();
    $subscribersApi = $mailerLite->subscribers();

    try {
        $subscriber = $subscribersApi->find($id);
        return view('edit', ['subscriber' => (array)$subscriber]);
    } catch (\Exception $e) {
        // Handle API errors as needed
        return Redirect::route('subscribers.index')->with('error', 'Error editing subscriber: ' . $e->getMessage());
    }
}


public function delete(Request $request, $id)
{
     $mailerLite = MailerLiteHelper::createMailerLiteInstance();
    $subscribersApi = $mailerLite->subscribers();

    try {
        // Delete the subscriber
        $subscribersApi->delete($id);

        // Log the response
        Log::info('Success: Subscriber deleted. ID: ' . $id);

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error deleting subscriber: ' . $e->getMessage());

        // Handle API errors as needed
        return response()->json(['success' => false, 'message' => 'Error deleting subscriber: ' . $e->getMessage()]);
    }
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
     $mailerLite = MailerLiteHelper::createMailerLiteInstance();
    $subscribersApi = $mailerLite->subscribers();

    try {
        $subscriber = $subscribersApi->find($id);

        if ($request->isMethod('post')) {
            // Update the subscriber data
            $updatedFields = [
                'name' => $request->input('name'),
                'fields' => [
                    'country' => $request->input('country'),
                ],
            ];

            // Save the updated subscriber
            $subscribersApi->update($id, $updatedFields);

            // Redirect to subscribers.index with success message
            return Redirect::route('subscribers.index')->with('success', 'Subscriber updated successfully');
        }

    } catch (\Exception $e) {
        // Handle API errors as needed
        return Redirect::route('subscribers.index')->with('error', 'Error editing subscriber: ' . $e->getMessage());
    }

    return view('edit', ['subscriber' => (array)$subscriber]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


   public function fetchSubscribers()
{
   $mailerLite = MailerLiteHelper::createMailerLiteInstance();
    $subscribersApi = $mailerLite->subscribers();
    try {
        $subscribers = $subscribersApi->get();

        foreach ($subscribers as $subscriber) {
            $country = isset($subscriber->fields) && isset($subscriber->fields->country)
                        ? $subscriber->fields->country
                        : '';
              
            // Update or create the subscriber in the database
           
        }
        return ['success' => true, 'data' => $subscribers->toArray()];
    } catch (\Exception $e) {
        // Log the error
        \Log::error('Error fetching subscribers: ' . $e->getMessage());

        // Return an error response
        return ['success' => false, 'message' => 'Failed to fetch subscribers.'];
    }
}


public function validateApiKey(Request $request)
{
    $apiKey = $request->input('api_key');

    $mailerLite = new MailerLite($apiKey);

    $accountsApi =  $mailerLite->stats();
      
    try {
        $account = $accountsApi->get();

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


}
