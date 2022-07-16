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
    public function listService()
    {
        return view('home.listService');
    }
    public function history()
    {
        return view('home.history');
    }
    public function cart()
    {
        return view('home.cart');
    }
}
