<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\DetailRating;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function getBookingListAjax(): array
    {
        $getAllBookings = Booking::with([
            'user',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate', 'discount'])->where('booking_status', Booking::BOOKING_SUCCESS)->get();

        $dataBooking = [];
        $bookingService = [];
        foreach ($getAllBookings as $booking) {
            $stylist = User::where('id', $booking->stylist)->first();
            $bookingServicePrice = 0;
            $discount = 0;
            if ($booking->discount) {
                $discount = $booking->discount->percent;
            }
            foreach ($booking->bookingService as $key => $service) {
                $bookingService[$key] = $service->service->name;
                $bookingServicePrice += $service->service->price - $service->service->price * $service->service->discount / 100;
            }
            if ($booking->status == Booking::SOLVED) {
                $status = 'Đã làm cho khách';
            } else if ($booking->status == Booking::SOLVED_YET) {
                $status = 'Chưa làm cho khách';
            } else {
                $status = 'Khách hủy';
            }
            $dataBooking[] = [
                'name'         => $booking->customer_name,
                'phone_number' => $booking->phone_number,
                'booking_date' => $booking->bookingDate->date,
                'booking_time' => $booking->booking_time,
                'stylist'      => $stylist->name,
                'payment'      => $booking->payment == Booking::PAYMENT_WITH_CARD ? 'Thanh toán trực tuyến' : 'Thanh toán tiền mặt',
                'note'         => $booking->note,
                'detail'       => [
                    'service' => $bookingService,
                    'price'   => number_format($bookingServicePrice - ($bookingServicePrice * $discount / 100), 0, "", ",") . ' VNĐ',
                ],
                'status'       => $status,
                'number'       => $booking->multiple_booking == Booking::MULTIPLE ? $booking->amount_number_booking : 0,
                'id'           => $booking->id,

            ];
        }
        return $dataBooking;
    }

    public function getAllBooking()
    {
        return view('admin.bookings.list');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateStatus(Request $request): JsonResponse
    {
        Booking::where('id', $request->id)->update([
            'status' => $request->status,
        ]);

        $booking = Booking::where('id', $request->id)->first();
        if ($request->status == 0) {
            $model_detail_rating = new DetailRating();
            $model_detail_rating->stylist_id = $booking->stylist;
            $model_detail_rating->member_id = $booking->user_id;
            $model_detail_rating->is_rating = DetailRating::RATED_YET;
            $model_detail_rating->can_edit = DetailRating::CANNOT_EDIT;

            $model_detail_rating->save();
        }

        return response()->json($request);
    }

    /**
     * Get list booking
     *
     * @return Application|Factory|View
     */
    public function getListBooking(Request $request)
    {
        $staffs = User::where('role_id', User::STYLIST_ROLE)->get();
        $bookingList = Booking::with([
            'stylistInfo',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate', 'discount'])->where('booking_status', Booking::BOOKING_SUCCESS)->orderBy('created_at', 'DESC');
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
        if ($request->filled('staff')) {
            $staff = $request->input('staff');
            $bookingList->whereHas('stylistInfo', function ($query) use ($staff) {
                $query->where('id', $staff);
            });
        }
        $getAllBookings = $bookingList->paginate(10)->withQueryString();

        return view('admin.bookings.index', compact('getAllBookings', 'staffs'));
    }

    /**
     * Update booking
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateBooking(Request $request): JsonResponse
    {
        Booking::where('id', $request['id'])->update([
            'status'         => $request['status'],
            'payment_status' => $request['status_payment'],
        ]);

        return response()->json($request);
    }

    /**
     * Check booking
     *
     * @return JsonResponse
     */
    public function checkBooking(Request $request): JsonResponse
    {
        $dateInput = BookingDate::where('date', $request['booking_date'])->first();
        $dataBooking = Booking::with(['stylistInfo', 'bookingDate'])
            ->where('booking_date', $dateInput->id)
            ->where('stylist', $request['user_id'])->where('booking_status', Booking::BOOKING_SUCCESS)
            ->get();

        return response()->json($dataBooking);
    }
}
