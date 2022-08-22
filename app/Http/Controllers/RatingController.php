<?php

namespace App\Http\Controllers;

use App\Models\DetailRating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function listRating()
    {
        $user = Auth::user();

        $stylists = User::where('role_id', User::STYLIST_ROLE)->get();
        $array_slylist_name = [];
        foreach ($stylists as $item) {
            $array_slylist_name[$item['id']] = $item['name'];
        }

        $all_ratings = DetailRating::where('member_id', $user->id)->get();

        return view('rating.list-rating', compact('user', 'array_slylist_name', 'all_ratings'));
    }

    public function ratingStylist($detail_rating_id)
    {
        $detail_rating = DetailRating::find($detail_rating_id);

        $stylists = User::where('role_id', User::STYLIST_ROLE)->get();
        $array_slylist_name = [];
        foreach ($stylists as $item) {
            $array_slylist_name[$item['id']] = $item['name'];
        }

        if (Auth::user()->id != $detail_rating->member_id) {
            return redirect('dashboard.rating.list');
        }
        return view('rating.rating-stylist', compact('detail_rating', 'array_slylist_name'));
    }
}
