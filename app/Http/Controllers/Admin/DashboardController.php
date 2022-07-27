<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $bookings = Booking::where('booking_status', Booking::BOOKING_SUCCESS)->get();
        $stylists = User::where('role_id', User::STYLIST_ROLE)->where('status', User::ACTIVE)->get();
        $services = Service::all();
        $countBookingPerMonth = Booking::select(
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw('max(created_at) as createdAt'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->orderBy('createdAt', 'ASC')
            ->get();
        $countBookingByStatus= Booking::select(
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTHNAME(created_at) as month_name"),
            DB::raw('max(created_at) as createdAt'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name')
            ->where('booking_status', Booking::BOOKING_SUCCESS)
            ->orderBy('createdAt', 'ASC')
            ->get();

        $getAllBookings = Booking::with([
            'user',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate', 'discount'])->where('booking_status', Booking::BOOKING_SUCCESS)->get();

        $dataBooking = [];
        foreach ($getAllBookings as $booking) {
            $bookingServicePrice = 0;
            $discount = 0;
            if ($booking->discount) {
                $discount = $booking->discount->percent;
            }
            foreach ($booking->bookingService as $service) {
                $bookingServicePrice += $service->service->price - $service->service->price * $service->service->discount / 100;
            }

            $dataBooking[] = [
                'price' => $bookingServicePrice - ($bookingServicePrice * $discount / 100),
            ];
        }
        $totalPrice = 0;
        foreach ($dataBooking as $price) {
            $totalPrice += $price['price'];
        }

        return view('admin.dashboard',
            compact('user', 'bookings', 'stylists', 'services', 'countBookingPerMonth', 'totalPrice', 'countBookingByStatus'));
    }
}
