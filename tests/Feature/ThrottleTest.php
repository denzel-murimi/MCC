<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Test;

class ThrottleTest extends TestCase
{
    #[Test]
    public function contact_form_is_throttled_after_three_requests()
    {
        $payload = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'message' => 'Hello, this is a test message.'
        ];

        // First 3 requests should succeed (302 redirect back)
        for ($i = 0; $i < 3; $i++) {
            $response = $this->post('/contact', $payload);
            $response->assertStatus(302); // or whatever your normal response is
        }

        // 4th request should be throttled
        $response = $this->post('/contact', $payload);
        $response->assertStatus(429);
    }
} 