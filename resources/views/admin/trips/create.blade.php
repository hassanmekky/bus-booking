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
                                <div class="alert alert-success alert-fill alert-icon">
                                    <em class="icon ni ni-check-circle"></em> <strong>{{ Session::get('message') }}</strong></div>
                            @endif
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <h5 class="card-title">Add New Trip</h5>
                                    </div>
                                    <form action="{{ route('trips.store')}}" method="post">
                                        @csrf
                                        <div class="row g-4">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="default-06">From </label>
                                                    <div class="form-control-wrap ">
                                                        <div class="form-control-select">
                                                            <select class="form-control" id="default-06" name="from_station" required>
                                                                <option value=""></option>
                                                                @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">{{$city->name }}</option>
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
                                                                @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">{{$city->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-head">
                                                <h6 class="card-title">Cross over Stations [Taking into account the order]</h6>
                                                <div class="col-sm-6" data-select2-id="10">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select class="form-select" name="stations[]" multiple="multiple" data-placeholder="Select Multiple options">
                                                                <option value=""></option>
                                                                @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}">{{$city->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-primary">Save </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

@section('scripts')
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