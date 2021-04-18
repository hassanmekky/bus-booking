@extends('admin.master')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Trips</h3>
                            <div class="nk-block-des text-soft">
                                {{-- <p>Welcome to Bus Booking  Dashboard .</p> --}}
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <a href="{{ route('trips.index')}}" class="btn btn-primary" >All Trips</a>
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-xxl-8">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <h5 class="card-title">Trip # {{ $trip->id }}</h5>
                                    </div>
                                    <ul class="list list-sm list-checked">
                                        <li>{{ $trip->cities()->first()->name }} To {{ $trip->cities()->orderBy('number', 'desc')->first()->name }}</li>
                                        <li><strong>Stations: </strong>
                                            @foreach ($trip->cities as $key => $city)
                                            {{ $city->name }},
                                            @endforeach
                                        </li>
                                        
                                    </ul>
                                    <div class="card-head">
                                        <h5 class="card-title">Seats And Reservations</h5>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col"># ID</th>
                                                <th scope="col">Seat Reservation</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($trip->seats as $seat)
                                            <tr>
                                                <th scope="row">{{ $seat->id }}</th>
                                                <td>
                                                    @forelse ($seat->seat_reservations as $reservation)
                                                        {{ $reservation->user->name }} - <strong>Res Date: </strong> {{ $reservation->created_at->format('Y-m-d') }} From : {{ $reservation->seat->trip->cities()->wherePivot('number',$reservation->from_station)->first()->name }} To {{ $reservation->seat->trip->cities()->wherePivot('number',$reservation->to_station)->first()->name }} <br>
                                                    @empty
                                                        no reservations yet
                                                    @endforelse
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection
