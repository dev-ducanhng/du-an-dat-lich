<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Rating;
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
            DB::raw("MONTH(created_at) as month_name, year(created_at) as year"),
            DB::raw('max(created_at) as createdAt'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month_name', 'year')
            ->orderBy('createdAt', 'ASC')
            ->get();
        $months = collect(range(1, 12))->map(
            function ($month) use ($countBookingPerMonth) {
                $match = $countBookingPerMonth->firstWhere('month_name', $month);
                return $match ? $match['count'] : 0;
            }
        );

        $countBookingByStatus = Booking::select(
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

        $ratings = Booking::whereYear('created_at', date('Y'))->select(
            DB::raw("(COUNT(*)) as rating, stylist, sum(rating) as total"),
        )->groupBy('stylist')->orderBy('total', 'DESC')->get();
        $dataRating = [];
        foreach ($ratings as $rating) {
            if ($rating->status == User::ACTIVE) {
                $user = User::where('id', $rating->stylist)->first();
                $dataRating[] = [
                    'rating'  => $rating->rating,
                    'stylish' => $user->name,
                    'point'   => $rating->total / $rating->rating,
                ];
            }
        }

        return view('admin.dashboard',
            compact('user', 'bookings', 'stylists', 'services', 'months', 'totalPrice', 'countBookingByStatus', 'dataRating'));
    }
}
