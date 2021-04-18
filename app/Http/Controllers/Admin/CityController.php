<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Session;

class CityController extends Controller
{
   
    public function index()
    {
        $cities = City::get();
        return view('admin.cities.index',compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
        ]); 
            
        City::create($request->except(['_token']));
        Session::flash('message', 'New City Successfully Added');        
        return back();
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3',
        ]); 
              
        $city = City::findOrFail($id);
        $city->update($request->except(['_token']));
        Session::flash('message', 'City updated');        
        return back();
    }

    
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        Session::flash('message', 'City Deleted');        
        return back();
    }
}
