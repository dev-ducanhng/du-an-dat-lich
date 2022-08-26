<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DetailRating;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function ratingStylist($booking_id)
    {
        $booking = Booking::find($booking_id);
        $user = Auth::user();

        $stylists = User::where('role_id', User::STYLIST_ROLE)->get();
        $array_slylist_name = [];
        $array_stylist_phone = [];
        $array_stylist_avatar = [];
        foreach ($stylists as $item) {
            $array_slylist_name[$item['id']] = $item['name'];
            $array_stylist_phone[$item['id']] = $item['phone'];
            $array_stylist_avatar[$item['id']] = $item['avatar'];
        }

        if ($booking->user_id != $user->id) {
            return redirect()->route('history')->with('message', 'Bạn không thể đánh giá hóa đơn của người khác!');
        }

        return view('rating.rating-stylist', compact('booking', 'array_slylist_name', 'array_stylist_phone', 'array_stylist_avatar'));
    }

    public function saveRating($booking_id, Request $request)
    {
        $booking = Booking::find($booking_id);
        $stylist_name = User::find($booking->stylist)->name;
        if ($booking->status != 0) {
            return redirect()->route('history')->with('message', 'Không thể đánh giá khi chưa hoàn thành lịch cắt!');
        }
        $booking->rating = $request->rating;
        $booking->save();

        $stylist = User::find($booking->stylist);
        if (isset($stylist->total_rating) && isset($stylist->count_rating)) {
            $stylist->total_rating += $request->rating;
            $stylist->count_rating ++;
        } else {
            $stylist->total_rating = $request->rating;
            $stylist->count_rating = 1;
        }
        $stylist->save();

        return redirect()->route('history')->with('message', 'Bạn đã gửi đánh giá ' . $request->rating . ' sao cho Stylist ' . $stylist_name);
    }
}
