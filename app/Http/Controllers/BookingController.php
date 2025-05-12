<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Notifications\BookingConfirmed;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    public function index()
    {
        try {
            $bookings = Booking::paginate(10);
            return response()->json($bookings, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Something went wrong'], 500);
        }
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string',
            'user_id'      => 'required|exists:users,id',
            'phone'        => 'required|string',
            'service_id'   => 'required|exists:services,id',
            'scheduled_at' => 'required|date|after:now',
        ]);

        try {
            $alreadyBooked = Booking::where('user_id', $validated['user_id'])
                ->where('service_id', $validated['service_id'])
                ->where('status', 'pending')
                ->first() ? true : false;

            if ($alreadyBooked) {
                return response()->json(['error' => 'You already have a pending booking for this service'], 400);
            }

            $booking = Booking::create($validated + ['status' => 'pending']);

            Notification::route('mail', env('ADMIN_EMAIL'))
                ->notify(new BookingConfirmed($booking));

            return response()->json($booking);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Something went wrong'], 500);
        }


    }

    public function show(Booking $booking)
    {
        try {
            $booking->load('service');
            return response()->json($booking, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Something went wrong'], 500);
        }

    }

    public function destroy(Booking $booking)
    {
        try {
            $booking->delete();
            return response()->noContent();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage() ?? 'Something went wrong'], 500);
        }
    }
}
