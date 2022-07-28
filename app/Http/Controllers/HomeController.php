<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\BookingDate;
use App\Models\BookingService;
use App\Models\BookingTime;
use App\Models\Discount;
use App\Models\Service;
use App\Models\User;
use App\Modules\PaymentModule;
use App\Modules\SendSMSModule;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Vonage\Client;

class HomeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $models = Service::all();
        $services = [];
        $priceDiscount = '';
        foreach ($models as $item) {

            if ($item->discount != '' || $item->discount != null) {
                $priceDiscount = $item->price - (($item->price / 100) * $item->discount);
            }
            $item->priceDiscount = $priceDiscount;

        }
        return view('home.index',compact('models'));
    }

    /**
     * @param $date
     * @return array
     */
    public function bookingDate($date): array
    {
        $bookingDate = BookingDate::with('bookingTime')->where('date', $date)->get();

        return $bookingDate->toArray()[0]['booking_time'];
    }

    /**
     * @return Application|Factory|View
     */
    public function booking()
    {
        $user = Auth::user();
        $services = Service::all();
        $stylists = User::where('role_id', User::STYLIST_ROLE)->where('status', User::ACTIVE)->get();
        $bookingDate = BookingDate::with('bookingTime')->get();

        return view('home.booking', compact('user', 'services', 'stylists', 'bookingDate'));
    }

    /**
     * @throws Client\Exception\Exception
     * @throws ClientExceptionInterface
     * @throws Exception
     */
    public function postBooking(BookingRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $dateInput = BookingDate::where('date', $request->input('booking_date'))->first();
            $timeInput = BookingTime::where('id', $request->input('booking_time'))->first();
            $search = escape_like($request->input('discount'));
            $discountCode = Discount::where('code_discount', 'LIKE', "%{$search}%")
                ->whereDate('end_date', '>=', now()->toDateString())->first();
            if ($search) {
                if (! $discountCode) {
                    return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ. Vui lòng nhập lại')->withInput();
                }
            }
            $dataInput = [
                'user_id'               => Auth::id() ?? null,
                'phone_number'          => Auth::user()->phone_number ?? $request->input('phone_number'),
                'status'                => Booking::SOLVED_YET,
                'discount_id'           => $discountCode->id ?? null,
                'customer_name'         => Auth::user()->name ?? $request->input('customer_name'),
                'multiple_booking'      => $request->input('multiple_booking') ? Booking::MULTIPLE : Booking::SINGLE,
                'amount_number_booking' => $request->input('amount_number_booking') ?? null,
                'booking_code'          => $request->input('multiple_booking') ? random_int(100000, 999999) : null,
                'booking_date'          => $dateInput->id,
                'booking_time'          => $timeInput->time,
                'stylist'               => $request->input('stylist'),
                'note'                  => $request->input('note'),
            ];
            $dataBooking = Booking::create($dataInput);
            foreach ($request->input('service') as $service) {
                BookingService::create([
                    'booking_id' => $dataBooking->id,
                    'service_id' => $service,
                ]);
            }
            $bookingTimes = BookingTime::where('id', $request->input('booking_time'));
            $maxService = $bookingTimes->first()->max_service - 1;
            $bookingTimes->update([
                'max_service' => $maxService,
            ]);
            if ($bookingTimes->first()->max_service == 0) {
                $bookingTimes->update([
                    'status' => BookingTime::INACTIVE_STATUS,
                ]);
            }

            DB::commit();

            return redirect()->route('cart', $dataBooking->id);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::info($exception);
            return redirect()->back()->with('error', 'Đã có lỗi hệ thống xảy ra. Vui lòng liên hệ với quản trị viên để biết thêm chi tiết')->withInput();
        }

    }

    /**
     * @return Application|Factory|View
     */
    public function listService()
    {
        $models = Service::all();
        $services = [];
        $priceDiscount = '';
        foreach ($models as $item) {

            if ($item->discount != '' || $item->discount != null) {
                $priceDiscount = $item->price - (($item->price / 100) * $item->discount);
            }
            $item->priceDiscount = $priceDiscount;

        }

        return view('home.listService', compact('models'));
    }

    /**
     * @param $bookingID
     * @return Application|Factory|View
     */
    public function cart($bookingID)
    {
        $bookingDetail = Booking::with([
            'user',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate'])->where('id', $bookingID)->first();
        $stylish = User::where('id', $bookingDetail->stylist)->first();
        $dateBooking = get_weekday_name($bookingDetail->bookingDate->date);

        return view('home.cart', compact('bookingDetail', 'dateBooking', 'stylish'));
    }

    public function confirmBooking($bookingId, Request $request): RedirectResponse
    {
        try {
            $bookingDetail = Booking::with([
                'user',
                'bookingService' => function ($queryBookingService) {
                    $queryBookingService->with('service');
                },
                'bookingDate'])->where('id', $bookingId)->first();
            if ($request->input('payment_method') == Booking::PAYMENT_WITH_CARD) {
                $payment = new PaymentModule();
                $payment->payment($bookingDetail, $bookingId);
            }

            return redirect()->route('success', $bookingId);
        } catch (Exception $exception) {
            Log::info($exception);

            return redirect()->back();
        }

    }

    /**
     * @param $bookingId
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function bookingSuccess($bookingId, Request $request)
    {
        $bookingDetail = Booking::with([
            'user',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate'])->where('id', $bookingId)->first();
        if ($request->input('vnp_ResponseCode') == "00") {
            $bookingDetail->update([
                'payment' => Booking::PAYMENT_WITH_CARD,
            ]);
        }
        $bookingDetail->update([
            'booking_status' => Booking::BOOKING_SUCCESS,
        ]);
        if ($request->input('vnp_ResponseCode') == "24" ||
            $request->input('vnp_ResponseCode') == "13" ||
            $request->input('vnp_ResponseCode') == "51") {
            $bookingDetail->update([
                'booking_status' => Booking::BOOKING_FAILED,
            ]);
            return redirect()->route('cart', $bookingId)
                ->with('error', 'Bạn chưa thanh toán thành công. Vui lòng thanh toán lại hoặc chọn hình thức thanh toán khác để xác nhận đặt lịch');
        }
        $sendSMS = new SendSMSModule();
        $sendSMS->sendSMS($bookingDetail, $bookingDetail->multiple_booking);

        return view('home.booking-success');
    }

    /**
     * Cancel booking
     *
     * @param $bookingId
     * @return RedirectResponse
     */
    public function cancelBooking($bookingId): RedirectResponse
    {
        $booking = Booking::where('id', $bookingId)->first();

        $bookingDetail = Booking::with([
            'user',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate'    => function ($queryBookingTime) use ($booking) {
                $queryBookingTime->with(['bookingTime' => function ($bookingTime) use ($booking) {
                    $bookingTime->where('time', date('G:i', strtotime($booking->booking_time)));
                }]);
            }])->where('id', $bookingId)->first();
        $addService = $bookingDetail->bookingDate->bookingTime[0]->max_service + 1;
        $changeBookingTime = BookingTime::where('id', $bookingDetail->bookingDate->bookingTime[0]->id);
        $changeBookingTime->update([
            'max_service' => $addService,
        ]);
        if ($changeBookingTime->first()->max_service > 0) {
            $changeBookingTime->update([
                'status' => BookingTime::ACTIVE_STATUS,
            ]);
        }
        Booking::destroy($bookingId);

        return redirect()->home('index');
    }

    /**
     * @param $bookingID
     * @return Application|Factory|View
     */
    public function editBooking($bookingID)
    {
        $user = Auth::user();
        $services = Service::all();
        $stylists = User::where('role_id', User::STYLISH_ROLE)->where('status', User::ACTIVE)->get();
        $bookingDate = BookingDate::with('bookingTime')->get();
        $booking = Booking::where('id', $bookingID)->first();

        $bookingDetail = Booking::with([
            'user',
            'bookingService' => function ($queryBookingService) {
                $queryBookingService->with('service');
            },
            'bookingDate'    => function ($queryBookingTime) use ($booking) {
                $queryBookingTime->with(['bookingTime' => function ($bookingTime) use ($booking) {
                    $bookingTime->where('time', date('G:i', strtotime($booking->booking_time)));
                }]);
            }])->where('id', $bookingID)->first();
        $bookingServiceId = [];
        foreach ($bookingDetail->bookingService as $service) {
            $bookingServiceId[] = $service->service->id;
        }

        return view('home.edit-booking', compact('user', 'services', 'stylists', 'bookingDate', 'bookingDetail', 'bookingServiceId'));
    }

    /**
     * @param BookingRequest $request
     * @param $bookingID
     * @return RedirectResponse
     */
    public function saveEditBooking(BookingRequest $request, $bookingID): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $dateInput = BookingDate::where('date', $request->input('booking_date'))->first();
            $timeInput = BookingTime::where('id', $request->input('booking_time'))->first();
            $booking = Booking::where('id', $bookingID)->first();

            $dataInput = [
                'user_id'               => Auth::id() ?? null,
                'phone_number'          => Auth::user()->phone_number ?? $request->input('phone_number'),
                'status'                => Booking::SOLVED_YET,
                'discount_id'           => null,
                'customer_name'         => Auth::user()->name ?? $request->input('customer_name'),
                'multiple_booking'      => $request->input('multiple_booking') ? Booking::MULTIPLE : Booking::SINGLE,
                'amount_number_booking' => $request->input('amount_number_booking') ?? null,
                'booking_code'          => $request->input('multiple_booking') ? random_int(100000, 999999) : null,
                'booking_date'          => $dateInput->id,
                'booking_time'          => $timeInput->time,
                'stylist'               => $request->input('stylist'),
                'note'                  => $request->input('note'),
            ];
            $bookingDetail = Booking::with([
                'user',
                'bookingService' => function ($queryBookingService) {
                    $queryBookingService->with('service');
                },
                'bookingDate'    => function ($queryBookingTime) use ($booking) {
                    $queryBookingTime->with(['bookingTime' => function ($bookingTime) use ($booking) {
                        $bookingTime->where('time', date('G:i', strtotime($booking->booking_time)));
                    }]);
                }])->where('id', $bookingID)->first();
            $addService = $bookingDetail->bookingDate->bookingTime[0]->max_service + 1;
            $bookingTimeChange = BookingTime::where('id', $bookingDetail->bookingDate->bookingTime[0]->id);
            $bookingTimeChange->update([
                'max_service' => $addService,
            ]);
            if ($bookingTimeChange->first()->max_service > 0) {
                $bookingTimeChange->update([
                    'status' => BookingTime::ACTIVE_STATUS,
                ]);
            }

            Booking::where('id', $bookingID)->update($dataInput);

            foreach ($request->input('service') as $service) {
                $bookingService = BookingService::where('service_id', $service)->where('booking_id', $bookingID);
                $bookingServiceClone = BookingService::where('service_id', $service)->where('booking_id', $bookingID)->get()->toArray();
                if (count($bookingServiceClone) > 0) {
                    $bookingService->update([
                        'booking_id' => $bookingID,
                        'service_id' => $service,
                    ]);
                } else {
                    BookingService::create([
                        'booking_id' => $bookingID,
                        'service_id' => $service,
                    ]);
                }
            }
            $bookingTimes = BookingTime::where('id', $request->input('booking_time'));
            $maxService = $bookingTimes->first()->max_service - 1;
            $bookingTimes->update([
                'max_service' => $maxService,
            ]);
            if ($bookingTimes->first()->max_service <= 0) {
                $bookingTimes->update([
                    'status' => BookingTime::INACTIVE_STATUS,
                ]);
            }
            DB::commit();

            return redirect()->route('cart', $bookingID);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::info($exception);
            return redirect()->back()->with('error', 'Đã có lỗi hệ thống xảy ra. Vui lòng liên hệ với quản trị viên để biết thêm chi tiết')->withInput();
        }
    }

    public function introduce()
    {
        return view('home.introduce');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function blog()
    {
        return view('home.blog');
    }

    public function detailService()
    {
        return view('home.detail-service');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkDiscountCode(Request $request): JsonResponse
    {
        $search = escape_like($request->input('discount'));
        $discountCode = Discount::where('code_discount', 'LIKE', "%{$search}%")
            ->whereDate('end_date', '>=', now()->toDateString())->first();
        if ($discountCode) {
            $dataResponse = [
                'exist'   => true,
                'percent' => $discountCode->percent,
            ];
        } else {
            $dataResponse = [
                'exist'   => false,
                'percent' => 0,
            ];
        }

        return response()->json($dataResponse);
    }
}
