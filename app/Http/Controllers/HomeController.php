<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\SeatReservation;

class HomeController extends Controller
{
    public function home()
    {
        $reservations  = SeatReservation::where('user_id',auth()->user()->id)->with('seat')->orderBy('id','desc')->get();
        return view('home',compact('reservations'));
    }
    public function index()
    {
        $trips = Trip::with('cities')->orderBy('id','desc')->get();
        return view('index',compact('trips'));
    }

}
