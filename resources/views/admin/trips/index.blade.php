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
                            <a href="{{ route('trips.create') }}" class="btn btn-primary">Add New Trip</a>
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
                            <div class="card card-bordered card-full">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title"><span class="mr-2">Trips</span> </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner p-0 border-top">
                                    <div class="nk-tb-list nk-tb-orders">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>Trip ID.</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>From-To</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Stations</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Date</span></div>
                                            <div class="nk-tb-col tb-col-md"><span>Actions</span></div>
                                        </div>
                                        @forelse ($trips as $trip)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <span class="tb-lead"><a href="#">#{{$trip->id}}</a></span>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-lead">{{ $trip->cities()->first()->name }} To {{ $trip->cities()->orderBy('number', 'desc')->first()->name }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-lead"><a href="#">
                                                @foreach ($trip->cities as $key => $city)
                                                    {{ $city->name }},
                                                @endforeach    
                                                </a></span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-lead"><a href="#">{{ $trip->date }}</a></span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <a href="{{ route('trips.show',$trip->id) }}" class="btn btn-success" >Details</a>
                                                {{-- <button type="button" id="EditBtn" data-trip="{{ $trip->id }}" data-text="{{ $trip->from_to}}" class="btn btn-warning" >Update</button> --}}
                                                <button type="button" id="deleteBtn" data-trip="{{ $trip->id }}"  class="btn btn-danger" >Delete</button>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="nk-tb-item">
                                            <span class="tb-lead">No Trips to View</span>
                                        </div>
                                        @endforelse
                                        
                                    </div>
                                </div>
                                <div class="card-inner-sm border-top text-center d-sm-none">
                                </div>
                            </div><!-- .card -->
                        </div>
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>




<!-- Delete Modal -->
<div class="modal fade" id="deleteCityModal" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-content p-2">
                    <h4 class="modal-title">Delete Trip</h4>
                    <p class="mb-4">Are You Sure want delete <span id="deletedTrip"></span> ?</p>
                    <form id="deleteForm" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-primary">Yes </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->
@endsection

@section('scripts')
<script>
    
    $("body").on("click","#deleteBtn",function() {
        var id = $(this).data('trip');
        var url = "<?php echo route('trips.index')?>";
        var text = $(this).data('text');
        $('#deletedTrip').text(id);
        $('#deleteForm').attr('action',url +'/'+ id);
        $("#deleteCityModal").modal('show');
    });
</script>
@endsection