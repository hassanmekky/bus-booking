<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Seat;
use App\Models\SeatReservation;
use Session;
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

    public function reserve($id)
    {
        $trip = Trip::with('cities')->findOrFail($id);
        return view('reserve',compact('trip'));
    }

    public function post_reserve($id,Request $request)
    {
        $validatedData = $request->validate([
            'from_station' => 'required',
            'to_station' => 'required|gt:from_station',
        ]);
        
        $seat = Seat::where('trip_id',$id)
                ->whereDoesntHave('seat_reservations')
                ->orWhereHas('seat_reservations', function($query) use($request){
                $query->where("to_station", "<=", $request->from_station)->orWhere("from_station",">=",$request->to_station);
        })->first();

        if($seat)
        {
            // create seat reservation
            $reservation = SeatReservation::create([
                'seat_id' => $seat->id,
                'user_id' => auth()->user()->id,
                'from_station' => $request->from_station, // from_station is station number not city id 
                'to_station' => $request->to_station, // to_station is station number not city id 
            ]);

            return view('reservation_success',compact('reservation'));
        }
        else
        {
            Session::flash('message', 'Sorry! there is no available Seats'); 
            return back();
        }
        
    }
}
