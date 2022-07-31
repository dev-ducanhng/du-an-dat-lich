<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\User;

class FeedbackController extends Controller
{
    public function getFeedback()
    {
        $feedbacks = Feedback::all();
        return view('feedback.index', compact('feedbacks'));
    }

    public function sendFeedback(Request $request)
    {
        $feedback = new Feedback();
        $feedback->fill($request->all());
        $feedback->save();
        $users = User::where('role_id', 0)->get();
        return redirect()->route('contact')->with(['success' => 'Gửi phản hồi thành công!']);
    }

    public function remove($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect(route('dashboard.feedback.index'))->with(['success' => 'Xóa thành công!']);
    }

}
