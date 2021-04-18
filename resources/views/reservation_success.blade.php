@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Successful Reservation</div>

                <div class="card-body">
                    <div class="jumbotron">
                        <h1 class="display-4">Suit #{{$reservation->seat_id}}</h1>
                        <p class="lead"></p>
                        <hr class="my-4">
                        <p>succefully booked suit #{{$reservation->seat_id}} at Trip #{{ $reservation->seat->trip_id }} </p>
                        <p class="lead">
                          <a class="btn btn-primary btn-lg" href="{{ url('home')}}" role="button">my trips</a>
                        </p>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

