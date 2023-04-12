<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\MailerLiteApiKey;

class ApiKeyValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_api_key_is_accepted()
    {
         $validApiKey = MailerLiteApiKey::first();

        $response = $this->post('/validate-api-key', [
            'api_key' => $validApiKey,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('mailer_lite_api_keys', [
            'api_key' => $validApiKey,
        ]);
    }


    public function test_invalid_api_key_is_rejected()
    {
        $invalidApiKey = 'invalid_api_key';

        $response = $this->post('/validate-api-key', [
            'api_key' => $invalidApiKey,
        ]);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('mailer_lite_api_keys', [
            'api_key' => $invalidApiKey,
        ]);
    }

    public function test_create_new_subscriber_with_valid_data()
    {
        $subscriberData = [
            'email' => 'test@example.com',
            'name' => 'Stephanie Style',
            'country' => 'Malta',
        ];

        $response = $this->post('/subscribers', $subscriberData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('subscribers', $subscriberData);
    }

    public function test_create_new_subscriber_with_invalid_data()
    {
        $subscriberData = [
            'email' => 'invalid_email',
            'name' => 'Stephanie Style',
            'country' => 'Malta',
        ];

        $response = $this->post('/subscribers', $subscriberData);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('subscribers', $subscriberData);
    }

}
