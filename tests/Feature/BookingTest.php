<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_creation()
    {
        $user = User::factory()->create();
        $service = Service::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'name' => 'John Doe',
            'user_id' => $user->id,
            'phone' => '1234567890',
            'service_id' => $service->id,
            'scheduled_at' => now()->addDay()->toDateTimeString(),
        ]);

        $response->assertStatus(200)->assertJsonStructure(['id']);
    }

    public function test_booking_status_retrieval()
    {
        $booking = Booking::factory()->for(Service::factory())->create();

        $response = $this->getJson("/api/bookings/{$booking->id}");
        $response->assertStatus(200)->assertJsonPath('id', $booking->id);
    }
}
