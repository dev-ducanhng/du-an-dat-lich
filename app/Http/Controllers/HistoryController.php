<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function history(Request $request)
    {
        $dataBookings = [];
        $searchByPhoneNumber = $request->input('phone_number');
        $searchByName = $request->input('name');
        $searchByCode = $request->input('code');

        if (auth()->user()) {
            $dataBookings = Booking::where('stylist', auth()->id())->orWhere('user_id', auth()->id())->with([
                    'user',
                    'bookingService' => function ($queryBookingService) {
                        $queryBookingService->with('service');
                    },
                    'bookingDate', 'Stylist', 'discount'])->paginate(10)->withQueryString();
        } else {
            if ($request->filled('phone_number')) {
                $dataBookings = Booking::where('phone_number', 'LIKE', "%{$searchByPhoneNumber}%")->with([
                        'user',
                        'bookingService' => function ($queryBookingService) {
                            $queryBookingService->with('service');
                        },
                        'bookingDate', 'Stylist', 'discount'])->paginate(10)->withQueryString();
            }
            if ($request->filled('code')) {
                $dataBookings = Booking::where('customer_name', 'LIKE', "%{$searchByName}%")->with([
                    'user',
                    'bookingService' => function ($queryBookingService) {
                        $queryBookingService->with('service');
                    },
                    'bookingDate', 'Stylist', 'discount'])->paginate(10)->withQueryString();
            }
            if ($request->filled('code')) {
                $dataBookings = Booking::where('booking_code', 'LIKE', "%{$searchByCode}%")->with([
                    'user',
                    'bookingService' => function ($queryBookingService) {
                        $queryBookingService->with('service');
                    },
                    'bookingDate', 'Stylist', 'discount'])->paginate(10)->withQueryString();
            }
        }
        return view('home.history', compact('dataBookings'));
    }
}
