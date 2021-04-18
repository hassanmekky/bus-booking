@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">make reservation</div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item active" >Trip Info</li>
                        <li class="list-group-item">{{ $trip->cities()->first()->name }} To {{ $trip->cities()->orderBy('number', 'desc')->first()->name }}</li>
                        <li class="list-group-item"><strong>Stations:</strong>
                            @foreach ($trip->cities as $key => $city)
                            {{ $city->name }},
                            @endforeach
                        </li>
                        <li class="list-group-item">Date: {{ $trip->date }}</li>
                      </ul>
                      <hr>
                      <div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                <strong>{{ Session::get('message') }}</strong></div>
                        @endif
                      <form action="{{ url('trip/'.$trip->id.'/reserve')}}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-06">From </label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" id="default-06" name="from_station" required>
                                                <option value=""></option>
                                                @foreach ($trip->cities as $city)
                                                <option value="{{ $city->pivot->number }}">{{$city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="default-06">To</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" id="default-06" name="to_station" required>
                                                <option value=""></option>
                                                @foreach ($trip->cities as $city)
                                                <option value="{{ $city->pivot->number }}">{{$city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">reserve </button>
                                </div>
                            </div>
                        </div>
                    </form>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    
    $(document).ready(function(){  
        $("select").on('focus', function () {
            $("select").find("option[value='"+ $(this).val() + "']").attr('disabled', false);
        }).change(function() {
            $("select").not(this).find("option[value='"+ $(this).val() + "']").attr('disabled', true);
        });

    }); 
</script>
@endsection