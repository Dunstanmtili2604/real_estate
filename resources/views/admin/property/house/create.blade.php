@extends('admin.layouts.master')
@section('title',  __('messages.global.dashboard'))
@section('content')
@push('css')
    
        <link href="{{ URL::to('assets/css/custom.css') }}" rel="stylesheet" type="text/css" >
        <!-- DataTables -->
        <link href="{{ URL::to('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::to('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ URL::to('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <style>
            .hide {
            display: none;
            }

            .hidden{
                display: none;
            }
        </style>
@endpush
    <!-- start page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add House</h4>
                </div>
                <div class="card-body p-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="room" value="room"/>
                                    <label class="form-check-label" for="type">Room</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="studio" value="studio"/>
                                    <label class="form-check-label" for="type">Studio</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="apartment" value="apartment"/>
                                    <label class="form-check-label" for="type">apartment</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="hidden" action="{{ route('room.store') }}"  method="post" enctype="multipart/form-data" id="room-form">
                       @csrf
                       <div class="row">
                            <h2>Add Room</h2>
                            <input type="text" name="type" value="House" class="form-control" hidden>
                            <input type="text" name="house-type" value="Room" class="form-control" hidden>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Name</label>
                                    <input type="text" name="name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Room Type</label>
                                    <select class="form-select" aria-label="Default select example" name="room-type">
                                        <option selected></option>
                                        <option>Simple</option>
                                        <option>Modern</option>
                                        <option>Ultra-modern</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Region</label>
                                    <select class="form-control form-select" id="inputVendor" name="region_id">
                                        <option>Choose a region</option>

                                        @foreach($regions as $item)
                                            <option value="{{$item->id}}">{{$item->designation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">City</label>
                                    <input type="text" name="city" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Quater</label>
                                    <input type="text" name="quater" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Description</label>
                                    <textarea class="form-control" name="description" id="ckeditor-classic"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Bathroom</label>
                                    <select class="form-select" aria-label="Default select example" name="bathroom">
                                        <option selected></option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Kitchen</label>
                                    <select class="form-select" aria-label="Default select example" name="kitchen">
                                        <option selected></option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Balcony</label>
                                    <select class="form-select" aria-label="Default select example" name="balcony">
                                        <option selected></option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Price</label>
                                    <input type="text" name="price" class="form-control" >
                                </div>
                            </div>
                            {{-- Image Upload Section --}}
                            <div class="col-xl-12 mb-3">
                                <div class="forn-group control">
                                    <label for="img">Images <strong class="is-small">(Tip: Upload more the one photograph [Max
                                            Image Size: 4MB])</strong></label>
                                    <div class="input-group control-group increment">
                                        <input type="file" name="filename[]" class="form-control" multiple>
                                        <div class="input-group-append input-group-btn">
                                            <button class="btn btn-success is-success addmore" type="button"><i class="glyphicon glyphicon-plus"></i>More</button>
                                        </div>
                                    </div>

                                    <div class="clone hide">
                                        <div class="control-group input-group" style="margin-top:10px">
                                            <input type="file" name="filename[]" class="form-control">
                                            <div class="input-group-append input-group-btn">
                                                <button class="btn btn-danger is-danger" type="button"><i
                                                        class="glyphicon glyphicon-remove"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('filename'))
                                <span>
                                    <strong class="has-text-danger">{{ $errors->first('filename') }}</strong>
                                </span> @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="fence" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Fence</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="parking" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Parking</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="pool" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Pool</label>
                                </div>
                            </div>
                            <div class="col-xl-12">
                               <div class="form-group mb-3">
                                    <input type="radio" class="btn-check" name="action" id="success-outlined" value="buy" autocomplete="off">
                                    <label class="btn btn-outline-success" for="success-outlined">sell</label>

                                    <input type="radio" class="btn-check" name="action" id="danger-outlined" value="rent" autocomplete="off">
                                    <label class="btn btn-outline-warning" for="danger-outlined">Rent</label>
                                </div>
                            </div>
                       </div>
                       <div class="mt-4">
                              <button  type="submit"  id="btnSubmit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </form>
                    <form class="hidden" action="{{ route('studio.store') }}"  method="post" enctype="multipart/form-data" id="studio-form">
                       @csrf
                       <div class="row">
                            <h2>Add Studio</h2>
                            <input type="text" name="type" value="House" class="form-control" hidden>
                            <input type="text" name="house-type" value="Studio" class="form-control" hidden>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Name</label>
                                    <input type="text" name="name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Studio Type</label>
                                    <select class="form-select" aria-label="Default select example" name="studio-type">
                                        <option selected></option>
                                        <option>Simple</option>
                                        <option>Modern</option>
                                        <option>Ultra-modern</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Region</label>
                                    <select class="form-control form-select" id="inputVendor" name="region_id">
                                        <option>Choose a region</option>

                                        @foreach($regions as $item)
                                            <option value="{{$item->id}}">{{$item->designation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">City</label>
                                    <input type="text" name="city" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Quater</label>
                                    <input type="text" name="quater" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group mb-3">
                                <label class="form-label" for="formrow-firstname-input">Description</label>
                                    <textarea class="form-control" name="description" id="studio-ckeditor-classic"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Bathroom</label>
                                    <select class="form-select" aria-label="Default select example" name="bathroom">
                                        <option selected></option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Kitchen</label>
                                    <select class="form-select" aria-label="Default select example" name="kitchen">
                                        <option selected></option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Balcony</label>
                                    <select class="form-select" aria-label="Default select example" name="balcony">
                                        <option selected></option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Price</label>
                                    <input type="text" name="price" class="form-control" >
                                </div>
                            </div>
                            {{-- Image Upload Section --}}
                            <div class="col-xl-12 mb-3">
                                <div class="forn-group control">
                                    <label for="img">Images <strong class="is-small">(Tip: Upload more the one photograph [Max
                                            Image Size: 4MB])</strong></label>
                                    <div class="input-group control-group increment">
                                        <input type="file" name="filename[]" class="form-control" multiple>
                                        <div class="input-group-append input-group-btn">
                                            <button class="btn btn-success is-success addmore" type="button"><i class="glyphicon glyphicon-plus"></i>More</button>
                                        </div>
                                    </div>

                                    <div class="clone hide">
                                        <div class="control-group input-group" style="margin-top:10px">
                                            <input type="file" name="filename[]" class="form-control">
                                            <div class="input-group-append input-group-btn">
                                                <button class="btn btn-danger is-danger" type="button"><i
                                                        class="glyphicon glyphicon-remove"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('filename'))
                                <span>
                                    <strong class="has-text-danger">{{ $errors->first('filename') }}</strong>
                                </span> @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="fence" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Fence</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="parking" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Parking</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="pool" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Pool</label>
                                </div>
                            </div>
                            <div class="col-xl-12">
                               <div class="form-group mb-3">
                                    <input type="radio" class="btn-check" name="action" id="studio-success-outlined" value="buy" autocomplete="off">
                                    <label class="btn btn-outline-success" for="studio-success-outlined">sell</label>

                                    <input type="radio" class="btn-check" name="action" id="studio-danger-outlined" value="rent" autocomplete="off">
                                    <label class="btn btn-outline-warning" for="studio-danger-outlined">Rent</label>
                                </div>
                            </div>
                       </div>
                       <div class="mt-4">
                              <button  type="submit"  id="btnSubmit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </form>
                    <form class="hidden" action="{{ route('apartment.store') }}"  method="post" enctype="multipart/form-data" id="apartment-form">
                       @csrf
                       <div class="row">
                            <h2>Add Apartment</h2>
                            <input type="text" name="type" value="House" class="form-control" hidden>
                            <input type="text" name="house-type" value="Apartment" class="form-control" hidden>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Name</label>
                                    <input type="text" name="name" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Apartment Type</label>
                                    <select class="form-select" aria-label="Default select example" name="apartment-type">
                                        <option selected></option>
                                        <option>Simple</option>
                                        <option>Modern</option>
                                        <option>Ultra-modern</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Region</label>
                                    <select class="form-control form-select" id="inputVendor" name="region_id">
                                        <option>Choose a region</option>

                                        @foreach($regions as $item)
                                            <option value="{{$item->id}}">{{$item->designation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">City</label>
                                    <input type="text" name="city" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Quater</label>
                                    <input type="text" name="quater" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="form-group mb-3">
                                <label class="form-label" for="formrow-firstname-input">Description</label>
                                    <textarea class="form-control" name="description" id="studio-ckeditor-classic"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Number of living rooms</label>
                                    <input type="number" name="livingroom" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Number of bedrooms</label>
                                    <input type="number" name="bedroom" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Number of bathrooms</label>
                                    <input type="number" name="bathroom" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Number of kitchens</label>
                                    <input type="number" name="kitchen" class="form-control" >
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Balcony</label>
                                    <select class="form-select" aria-label="Default select example" name="balcony">
                                        <option selected></option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Price</label>
                                    <input type="text" name="price" class="form-control" >
                                </div>
                            </div>
                            {{-- Image Upload Section --}}
                            <div class="col-xl-12 mb-3">
                                <div class="forn-group control">
                                    <label for="img">Images <strong class="is-small">(Tip: Upload more the one photograph [Max
                                            Image Size: 4MB])</strong></label>
                                    <div class="input-group control-group increment">
                                        <input type="file" name="filename[]" class="form-control" multiple>
                                        <div class="input-group-append input-group-btn">
                                            <button class="btn btn-success is-success addmore" type="button"><i class="glyphicon glyphicon-plus"></i>More</button>
                                        </div>
                                    </div>

                                    <div class="clone hide">
                                        <div class="control-group input-group" style="margin-top:10px">
                                            <input type="file" name="filename[]" class="form-control">
                                            <div class="input-group-append input-group-btn">
                                                <button class="btn btn-danger is-danger" type="button"><i
                                                        class="glyphicon glyphicon-remove"></i> Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('filename'))
                                <span>
                                    <strong class="has-text-danger">{{ $errors->first('filename') }}</strong>
                                </span> @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="fence" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Fence</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                               <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="parking" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Parking</label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" name="pool" value="available" type="checkbox" role="switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Pool</label>
                                </div>
                            </div>
                            <div class="col-xl-12">
                               <div class="form-group mb-3">
                                    <input type="radio" class="btn-check" name="action" id="apartment-success-outlined" value="buy" autocomplete="off">
                                    <label class="btn btn-outline-success" for="apartment-success-outlined">sell</label>

                                    <input type="radio" class="btn-check" name="action" id="apartment-danger-outlined" value="rent" autocomplete="off">
                                    <label class="btn btn-outline-warning" for="apartment-danger-outlined">Rent</label>
                                </div>
                            </div>
                       </div>
                       <div class="mt-4">
                              <button  type="submit"  id="btnSubmit" class="btn btn-primary waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div>
             <!-- end card -->
           </div> <!-- end col -->
    </div>

    @push('scripts')
              <!-- pristine js -->
              <script src="{{ URL::to('assets/libs/pristinejs/pristine.min.js')}}"></script>
        <!-- form validation -->
        <script src="{{ URL::to('assets/js/pages/form-validation.init.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{ URL::to('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::to('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::to('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ URL::to('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::to('assets/js/pages/datatables.init.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
        
            $(".addmore").click(function(){ 
                console.log('works')
                var html = $(".clone").html();
                $(".increment").after(html);
            });
        
            $("body").on("click",".is-danger",function(){ 
                $(this).parents(".control-group").remove();
            });
        
            });
        </script>

        <script text="text/javascript">
            $(document).ready(function(){
            $('#room').click(function(){
                $('#room-form').show();
                $('#studio-form').hide();
                $('#apartment-form').hide();
                $('#guest-form').hide();
            });

            $('#studio').click(function(){
                $('#studio-form').show();
                $('#room-form').hide();
                $('#apartment-form').hide();
                $('#guest-form').hide();
            });

            $('#apartment').click(function(){
                $('#apartment-form').show();
                $('#room-form').hide();
                $('#studio-form').hide();
                $('#guest-form').hide();
            });
        });
        </script>

    
    @endpush
@endsection