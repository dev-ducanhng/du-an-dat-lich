<?php

namespace App\Http\Controllers;

use App\Models\DetailRating;
use App\Models\Rating;
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
        $all_stylist = [];
        foreach ($all_ratings as $key => $item) {
            $all_stylist[] = [
                'stt' => ++$key,
                'name' => $array_slylist_name[$item['stylist_id']],
                'rating' => Rating::where('user_id', $item['stylist_id'])->first()->rating,
                'is_rating' => $item['is_rating'],
                'detail_rating_id' => $item['id'],
            ];
        }

        return view('rating.list-rating', compact('user', 'array_slylist_name', 'all_ratings', 'all_stylist'));
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
            return redirect()->route('dashboard.rating.list');
        }
        if ($detail_rating->is_rating == 1) {
            return redirect()->route('dashboard.rating.list');
        }
        return view('rating.rating-stylist', compact('detail_rating', 'array_slylist_name'));
    }

    public function saveRating($detail_rating_id, Request $request)
    {
        $detail_rating = DetailRating::find($detail_rating_id);
        $detail_rating->fill($request->all());
        $detail_rating->is_rating = 1;
        $detail_rating->save();

        $model_rating = Rating::where('user_id', $detail_rating->stylist_id)->first();
        if (!$model_rating) {
            $model_rating = new Rating();
            $model_rating->user_id = $detail_rating->stylist_id;
        }
        $count_rating = DetailRating::where('stylist_id', $detail_rating->stylist_id)->groupBy('stylist_id')->count();
        $sum_rating = DetailRating::where('stylist_id', $detail_rating->stylist_id)->groupBy('stylist_id')->sum('rating');
        $model_rating->rating = ceil($sum_rating / $count_rating);
        $model_rating->save();

        return redirect()->route('dashboard.rating.list');
    }
}
