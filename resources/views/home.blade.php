@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">my trips</div>

                <div class="card-body">
                    <table class="table">
                    <thead>
                        <tr>
                          <th scope="col"># trip</th>
                          <th scope="col">Trip alias</th>
                          <th scope="col"># seat</th>
                          <th scope="col">Reservation Date</th>
                          <th scope="col">Reservation Station From</th>
                          <th scope="col">Reservation Station to</th>

                        </tr>
                      </thead>
                      <tbody>
                          @forelse ($reservations as $reservation)
                           <tr>
                              <th scope="row">#{{ $reservation->seat->trip_id}}</th>
                              <td>{{ $reservation->seat->trip->cities()->first()->name }} To {{ $reservation->seat->trip->cities()->orderBy('number', 'desc')->first()->name }}</td>
                              <td>#{{ $reservation->seat_id }}</td>
                              <td>{{$reservation->created_at->format('Y-m-d') }}</td>
                              <td>{{ $reservation->seat->trip->cities()->wherePivot('number',$reservation->from_station)->first()->name }}</td>
                              <td>{{ $reservation->seat->trip->cities()->wherePivot('number',$reservation->to_station)->first()->name }}</td>
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
