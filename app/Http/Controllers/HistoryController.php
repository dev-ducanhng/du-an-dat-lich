<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history(Request $request)
    {
        $bookings = null;
        if (auth()->user()) {
            $bookings = Booking::where('stylist', auth()->id())->orWhere('user_id', auth()->id())->get();
        } else {
            if ($request->filled('phone_number')) {
                $searchByPhoneNumber = $request->input('phone_number');
                $bookings = Booking::where('phone_number', 'LIKE', "%{$searchByPhoneNumber}%")->get();
            }
        }

        return view('home.history', compact('bookings'));
    }
}
