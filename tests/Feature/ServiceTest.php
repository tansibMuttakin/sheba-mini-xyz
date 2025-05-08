<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Service;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
