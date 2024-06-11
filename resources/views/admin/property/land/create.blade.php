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
        </style>
@endpush
    <!-- start page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Land</h4>
                </div>
                <div class="card-body p-4">
                <form action="{{ route('land.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                       <div class="row">
                       <input type="text" name="type" value="Land" class="form-control" hidden>
                       <div class="col-xl-6 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="formrow-firstname-input">Name</label>
                                <input type="text" name="name" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6 col">
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
                        <div class="col-xl-6 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="formrow-firstname-input">City</label>
                                <input type="text" name="city" class="form-control" >
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
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
                        <div class="col-md-6 col">
                           <div class="form-group mb-3">
                                <label class="form-label" for="formrow-firstname-input">Size</label>
                                <input type="number" name="size" class="form-control" >
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label" for="formrow-firstname-input">Price</label>
                                <input type="text" name="price" class="form-control" >
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <div class="row">
                               <img id="preview" src="#" alt="your image" class="mt-3 col-md-4" style="display:none;"/>
                            </div>
                           <div class="form-group  mb-3 increment">
                                <label class="form-label" for="formrow-firstname-input">Images</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="image" id="selectImage" multiple>
                                    <div class="">
                                        <button class="btn btn-success is-success addmore" type="button">More</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clone hide">
                                <div class="control-group form-group" style="margin-top:10px">
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="image">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger is-danger" type="button"><i
                                                class="glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        {{-- Image Upload Section --}}
                    <div class="col-md-12 mb-3">
                        <div class="forn-group control">
                            <label for="img">Images <strong class="is-small">(Tip: Upload more the one photograph [Max
                                    Image Size: 4MB])</strong></label>
                            <div class="input-group control-group increment">
                                <input type="file" name="filename[]" class="form-control" multiple>
                                <div class="input-group-append input-group-btn">
                                    <button class="btn btn-success is-success addmore" type="button"><i
                                            class="glyphicon glyphicon-plus"></i>More</button>
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
                        <div class="col-xl-12">
                        </div>
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
              var html = $(".clone").html();
              $(".increment").after(html);
          });
    
          $("body").on("click",".is-danger",function(){ 
              $(this).parents(".control-group").remove();
          });
    
        });
    </script>

    
    @endpush
@endsection