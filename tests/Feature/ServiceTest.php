<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_listing()
    {
        Service::factory()->count(3)->create();

        $response = $this->getJson('/api/services');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }
}
