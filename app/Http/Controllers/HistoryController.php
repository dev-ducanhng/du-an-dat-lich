<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function history(Request $request)
    {
        $searchByPhoneNumber = $request->input('phone_number');
        $searchByName = $request->input('name');
        $dataBookings = [];
        if (auth()->user()) {
            $dataBookings = Booking::with([
                'user',
                'bookingService' => function ($queryBookingService) {
                    $queryBookingService->with('service');
                },
                'bookingDate', 'Stylist', 'discount'])->where('stylist', auth()->id());
            if ($request->filled('filterValue')) {
                if ($request->input('filterValue') == 'today') {
                    $dataBookings->whereHas('bookingDate', function ($query) {
                        $query->where('date', now()->toDateString());
                    });
                }
                if ($request->input('filterValue') == 'solved') {
                    $dataBookings->where('status', Booking::SOLVED_YET);
                }
                if ($request->input('filterValue') == 'cancel') {
                    $dataBookings->where('status', Booking::CANCEL);
                }
            }
            $dataBookings = $dataBookings->paginate(10)->withQueryString();

        } else {
            if ($request->filled('phone_number')) {
                $dataBookings = Booking::with([
                    'user',
                    'bookingService' => function ($queryBookingService) {
                        $queryBookingService->with('service');
                    },
                    'bookingDate', 'Stylist', 'discount'])
                    ->where('booking_status', Booking::BOOKING_SUCCESS)
                    ->where('phone_number', 'LIKE', "%{$searchByPhoneNumber}%");
                $dataBookings = $dataBookings->paginate(10)->withQueryString();

            }
            if ($request->filled('name')) {
                $dataBookings = Booking::with([
                    'user',
                    'bookingService' => function ($queryBookingService) {
                        $queryBookingService->with('service');
                    },
                    'bookingDate', 'Stylist', 'discount'])
                    ->where('booking_status', Booking::BOOKING_SUCCESS)
                    ->where('customer_name', 'LIKE', "%{$searchByName}%");
                $dataBookings = $dataBookings->paginate(10)->withQueryString();

            }
        }
        return view('home.history', compact('dataBookings'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateBookingStatus(Request $request): RedirectResponse
    {
        try {
            $booking = Booking::where('id', $request->input('booking_id'));
            $booking->update([
                'status' => $request->input('status'),
            ]);

            return redirect()->back()->with('success', 'Bạn đã cập nhật trạng thái đặt lịch thành công');
        } catch (\Exception $exception) {
            Log::info($exception);

            return redirect()->back()->with('error', 'Có lỗi hệ thống xảy ra. Vui lòng liên hệ với quản trị viên');
        }
    }
}
