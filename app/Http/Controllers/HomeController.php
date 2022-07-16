<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
    public function booking()
    {
        return view('home.booking');
    }
    public function service()
    {
        return view('home.service');
    }
}
