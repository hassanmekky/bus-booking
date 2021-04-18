@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Trips</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">From To</th>
                            <th scope="col">Stations</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($trips as $key => $trip)
                             <tr>
                                <th scope="row">{{ $key + 1}}</th>
                                <td>{{ $trip->cities()->first()->name }} To {{ $trip->cities()->orderBy('number', 'desc')->first()->name }}</td>
                                <td>
                                    @foreach ($trip->cities as $key => $city)
                                    {{ $city->name }},
                                    @endforeach
                                </td>
                                <td>{{$trip->date }}</td>
                                <td><a href="{{ url('trip/'.$trip->id.'/reserve') }}" class="btn btn-primary">Make Reservation</a></td>
                              </tr>
                            @empty
                                <tr>
                                    <td colspan="4">no trips available</td>
                                </tr>
                            @endforelse
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

