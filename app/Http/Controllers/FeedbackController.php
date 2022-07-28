<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function getFeedback()
    {
        $feedbacks = Feedback::all();
        return view('feedback.index', compact('feedbacks'));
    }
}
