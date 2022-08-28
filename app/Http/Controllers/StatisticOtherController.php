<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatisticOtherController extends Controller
{
    /**
     * Statistic other
     *
     * @return Application|Factory|View
     */
    public function statisticOther(Request $request)
    {
        $stylists = User::where('role_id', User::STYLIST_ROLE)->get();
        $dataStylist = $this->getStylist($request);
        $totalPrice = $this->getTotalPrice($request);

        return view('admin.statistic', compact('stylists', 'dataStylist', 'totalPrice'));
    }

    /**
     * Statistic by Stylist
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function staticByStylist(Request $request): JsonResponse
    {

        $dataStylist = $this->getStylist($request);
        $data = [];
        foreach ($dataStylist as $stylist) {
            $data [] = [
                'name'          => $stylist->name,
                'numberBooking' => count($stylist->bookings),
            ];
        }

        return response()->json($data);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getStylist($request)
    {
        $stylistLists = User::where('role_id', User::STYLIST_ROLE)
            ->where('status', User::ACTIVE);
        if ($request->filled('startDate')) {
            $startDate = $request->input('startDate');
            $stylistLists->with(['bookings' => function ($query) use ($startDate) {
                $query->with('bookingDate')->whereHas('bookingDate', function ($queryDate) use ($startDate) {
                    $queryDate->where('date', '>=', $startDate);
                });
            }]);
        }
        if ($request->filled('endDate')) {
            $endDate = $request->input('endDate');
            $stylistLists->with(['bookings' => function ($query) use ($endDate) {
                $query->with('bookingDate')->whereHas('bookingDate', function ($queryDate) use ($endDate) {
                    $queryDate->where('date', '<=', $endDate);
                });
            }]);
        }
        if ($request->filled('stylistId') && $request->input('stylistId') != 0) {
            $stylistId = $request->input('stylistId');
            $stylistLists->where('id', $stylistId);
        }

        return $stylistLists->get();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function staticTurnover(Request $request): JsonResponse
    {
        $countBooking = $this->getTotalPrice($request);

        return response()->json($countBooking);
    }

    /**
     * @param $request
     * @return array
     */
    public function getTotalPrice($request): array
    {
        $getAllBookings = Booking::with([
            'user',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate', 'discount'])->where('booking_status', Booking::BOOKING_SUCCESS);
        $getBookingCancel = Booking::with([
            'user',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate', 'discount'])->where('status', Booking::CANCEL);
        if ($request->filled('startDateCount')) {
            $startDateCount = $request->input('startDateCount');
            $getAllBookings->with('bookingDate')->whereHas('bookingDate', function ($query) use ($startDateCount) {
                $query->whereDate('date', '>=', $startDateCount);
            });
            $getBookingCancel->with('bookingDate')->whereHas('bookingDate', function ($query) use ($startDateCount) {
                $query->whereDate('date', '>=', $startDateCount);
            });
        }
        if ($request->filled('endDateCount')) {
            $endDateCount = $request->input('endDateCount');
            $getAllBookings->with('bookingDate')->whereHas('bookingDate', function ($query) use ($endDateCount) {
                $query->whereDate('date', '<=', $endDateCount);
            });
            $getBookingCancel->with('bookingDate')->whereHas('bookingDate', function ($query) use ($endDateCount) {
                $query->whereDate('date', '<=', $endDateCount);
            });
        }
        if ($request->filled('month') && $request->input('month') != 0) {
            $month = $request->input('month');
            $getAllBookings->with('bookingDate')->whereHas('bookingDate', function ($query) use ($month) {
                $query->whereMonth('date', $month);
            });
            $getBookingCancel->with('bookingDate')->whereHas('bookingDate', function ($query) use ($month) {
                $query->whereMonth('date', $month);
            });
        }
        $dataBooking = [];
        $bookingLists = $getAllBookings->get();
        foreach ($bookingLists as $booking) {
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

        return [
            'totalPrice'    => number_format($totalPrice, 0, '', ",") . ' VNĐ',
            'totalBooking'  => count($dataBooking) ?? 0,
            'bookingCancel' => count($getBookingCancel->get()->toArray()) ?? 0,
        ];
    }
}
