<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        return Booking::with('service')->orderByDesc('created_at')->paginate(15);
    }
}
