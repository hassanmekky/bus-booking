<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Validator;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
        ]); 
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }        
        City::create($request->except(['_token']));
        Session::flash('message', 'New City Successfully Added');        
        return back();
    }

    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
        ]); 
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }            
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
