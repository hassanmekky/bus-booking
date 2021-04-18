<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\City;
use App\Models\Seat;
use Validator;
use Session;

class TripController extends Controller
{
    
    public function index()
    {
        $trips = Trip::with('cities')->get();
        return view('admin.trips.index',compact('trips'));
    }

   
    public function create()
    {
        $isEdit = false;
        $cities = City::get();
        return view('admin.trips.create',compact('isEdit','cities'));
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_station' => 'required',
            'to_station' => 'required',
            'stations' => 'required',
        ]); 
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $trip = new Trip;
        $trip->save();

        $number = 1;
        $trip->cities()->attach($request->from_station,['number' => $number]);
        $number++;
        foreach($request->stations as $station)
        {
            $trip->cities()->attach($station,['number' => $number]);
            $number++;
        }
        $trip->cities()->attach($request->to_station,['number' => $number]);

        // add seats
        for($i = 0; $i < 12 ; $i++)
        {
            $seat = new Seat;
            $seat->trip_id = $trip->id;
            $seat->save();
        }

        Session::flash('message', 'Trip Added successfully');        
        return back();
    }

    
    public function show($id)
    {
        $trip = Trip::with('seats')->with('cities')->findOrFail($id);
        return view('admin.trips.details',compact('trip'));
    }

    
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();
        Session::flash('message', 'trip Deleted');        
        return back();
    }
}
