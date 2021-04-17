@extends('admin.master')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Cities</h3>
                            <div class="nk-block-des text-soft">
                                {{-- <p>Welcome to Bus Booking  Dashboard .</p> --}}
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">Add New City</button>
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
                                            <h6 class="title"><span class="mr-2">Cities</span> </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner p-0 border-top">
                                    <div class="nk-tb-list nk-tb-orders">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col"><span>City ID.</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Name</span></div>
                                            <div class="nk-tb-col tb-col-md"><span>Actions</span></div>
                                        </div>
                                        @forelse ($cities as $city)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col">
                                                <span class="tb-lead"><a href="#">#{{$city->id}}</a></span>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-lead">{{ $city->name }}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <button type="button" id="EditBtn" data-city="{{ $city->id }}" data-text="{{ $city->name}}" class="btn btn-warning" >Update</button>
                                                <button type="button" id="deleteBtn" data-city="{{ $city->id }}" data-text="{{ $city->name}}" class="btn btn-danger" >Delete</button>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="nk-tb-item">
                                            <span class="tb-lead">No Cities to View</span>
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

 <!-- Modal Form -->
 <div class="modal fade" tabindex="-1" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New City</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('cities.store') }}" class="form-validate is-alter" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="full-name">City Name</label>
                        <div class="form-control-wrap">
                            <input type="text" name="name" class="form-control" id="full-name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tabs -->
 <!-- Edit Modal Form -->
 <div class="modal fade" tabindex="-1" id="editCityModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update City</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action=""  method="post" id="editForm">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="full-name">City Name</label>
                        <div class="form-control-wrap">
                            <input type="text" name="name"  class="form-control" id="editedCity" required>
                        </div>
                        <input type="hidden" name="_method" value="put"> 

                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tabs -->


<!-- Delete Modal -->
<div class="modal fade" id="deleteCityModal" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-content p-2">
                    <h4 class="modal-title">Delete City</h4>
                    <p class="mb-4">Are You Sure want delete <span id="deletedCity"></span> ?</p>
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
    
    $("body").on("click","#EditBtn",function() {
        var id = $(this).data('city');
        var url = "<?php echo route('cities.index')?>";
        var text = $(this).data('text');
        $('#editedCity').val(text);
        $('#editForm').attr('action',url +'/'+ id );
        $("#editCityModal").modal('show');
    });

    $("body").on("click","#deleteBtn",function() {
        var id = $(this).data('city');
        var url = "<?php echo route('cities.index')?>";
        var text = $(this).data('text');
        $('#deletedCity').text(text);
        $('#deleteForm').attr('action',url +'/'+ id);
        $("#deleteCityModal").modal('show');
    });
</script>
@endsection