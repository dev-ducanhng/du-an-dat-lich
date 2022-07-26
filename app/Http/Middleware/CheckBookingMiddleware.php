<?php

namespace App\Http\Middleware;

use App\Models\Booking;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckBookingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bookingId = substr($request->fullUrl(), -2);
        $bookingDetail = Booking::where('id', $bookingId)->first();
        if ($bookingDetail->booking_status == Booking::BOOKING_SUCCESS) {
            return redirect()->back()->with('error', 'Bạn không thể thực hiện các tác vụ này khi đã đặt lịch thành công. Xin cám ơn!');
        } else {
            return $next($request);
        }
    }
}
