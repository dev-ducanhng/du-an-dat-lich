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
        $bookingList = Booking::with([
            'user',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate', 'Stylist', 'discount']);

        if (auth()->user()) {
            $bookingList->where('stylist', auth()->id());
            if ($request->filled('filterValue')) {
                if ($request->input('filterValue') == 'today') {
                    $bookingList->whereHas('bookingDate', function ($query) {
                        $query->where('date', now()->toDateString());
                    });
                }
                if ($request->input('filterValue') == 'solved') {
                    $bookingList->where('status', Booking::SOLVED_YET);
                }
                if ($request->input('filterValue') == 'cancel') {
                    $bookingList->where('status', Booking::CANCEL);
                }
            }
            $bookingList->orWhere('user_id', auth()->id());

        } else {
            $bookingList = Booking::with([
                'user',
                'bookingService' => function ($queryBookingService) {
                    $queryBookingService->with('service');
                },
                'bookingDate', 'Stylist', 'discount'])->where('booking_status', Booking::BOOKING_SUCCESS);
            if ($request->filled('phone_number')) {
                $bookingList->where('phone_number', 'LIKE', "%{$searchByPhoneNumber}%");
            }
            if ($request->filled('name')) {
                $bookingList->where('customer_name', 'LIKE', "%{$searchByName}%");

            }
        }
        $dataBookings = $bookingList->paginate(10)->withQueryString();


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
