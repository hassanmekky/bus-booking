<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Trip;
use App\Models\SeatReservation;


class ReservationController extends Controller
{
    public function available_seats(Request $request)
    {
        $data =  $request->validate([
            'trip_id' => 'required',
            'from_station' => 'required',
            'to_station' => 'required',
        ]);
        $trip = Trip::with('cities')->findOrFail($request->trip_id);
        $from_station_number = $trip->cities()->where('city_id',$request->from_station)->first()->pivot->number;
        $to_station_number = $trip->cities()->where('city_id',$request->to_station)->first()->pivot->number;

        $seats = $this->get_available_seats($trip->id,$from_station_number,$to_station_number);

        return response()->json([
            'success' => true,
            'data' => $seats
        ]);
    }

    public function book_seat(Request $request)
    {
        $data =  $request->validate([
            'trip_id' => 'required',
            'from_station' => 'required',
            'to_station' => 'required',
        ]);

        $trip = Trip::with('cities')->findOrFail($request->trip_id);
        $from_station_number = $trip->cities()->where('city_id',$request->from_station)->first()->pivot->number;
        $to_station_number = $trip->cities()->where('city_id',$request->to_station)->first()->pivot->number;

        $seat = $this->get_available_seats($trip->id,$from_station_number,$to_station_number)->first();

        if($seat)
        {
            // create seat reservation
            $reservation = SeatReservation::create([
                'seat_id' => $seat->id,
                'user_id' => auth()->user()->id,
                'from_station' => $request->from_station, // from_station is station number not city id 
                'to_station' => $request->to_station, // to_station is station number not city id 
            ]);

            return response()->json([
                'success' => true,
                'seat_id' => $reservation->seat_id,
                'message' => 'seat Booked Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'sorry there is no available seat',
            ]);
        }
    }

    protected function get_available_seats($trip_id, $from_station_number,$to_station_number)
    {
        return Seat::where('trip_id',$trip_id)
                ->whereDoesntHave('seat_reservations')
                ->orWhereHas('seat_reservations', function($query) use($from_station_number, $to_station_number){
                $query->where("to_station", "<=", $from_station_number)->orWhere("from_station",">=",$to_station_number);
                })->get();
    }
}
