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
            .bg-light-success{background-color:#c7f3de!important}
            .bg-light-danger{background-color:#f5a7a4!important}

            .app-card .app-card-body.has-card-actions{
                position:relative;
                padding-right:1rem !important
            }
            .app-card .app-card-body .app-card-actions{
                display:inline-block;
                width:30px;
                height:30px;
                text-align:center;
                border-radius:50%;
                position:absolute;
                z-index:10;
                right:.75rem;
                top:.75rem
            }
            .app-card .app-card-body .app-card-actions:hover{
                background:#f5f6fe
            }
            .app-card .app-card-body .app-card-actions .dropdown-menu{
                font-size:.8125rem
            }
            .app-card-doc:hover{
                box-shadow:0 .5rem 1rem rgba(0,0,0,.15) !important
            }
            .app-card-doc .app-card-thumb-holder{
                background:#e9eaf1;
                text-align:center;
                position:relative;
                height:112px
            }
            .app-card-doc .app-card-thumb-holder .app-card-thumb{
                overflow:hidden;
                position:absolute;
                left:0;
                top:0;
                width:100%;
                height:100%;
                background:#000
            }
            .app-card-doc .app-card-thumb-holder .thumb-image{
                -webkit-opacity:.7;
                -moz-opacity:.7;
                opacity:.7;
                width:100%;
                height:auto
            }
            .app-card-doc .app-card-thumb-holder:hover{
                background:#fafbff
            }
            .app-card-doc .app-card-thumb-holder:hover .thumb-image{
                -webkit-opacity:1;
                -moz-opacity:1;
                opacity:1
            }
            .app-card-doc .app-card-thumb-holder .badge{
                position:absolute;
                right:.5rem;
                top:.5rem
            }
            .app-card-doc .app-card-thumb-holder .icon-holder{
                font-size:40px;
                display:inline-block;
                margin:0 auto;
                width:80px;
                height:80px;
                border-radius:50%;
                background:#fff;
                padding-top:10px
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .pdf-file
            {
                color:#da2d27
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .text-file{
                color:#66a0fd
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .excel-file{
                color:#0da95f
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .ppt-file{
                color:#f4b400
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .video-file{
                color:#935dc1
            }
            .app-card-doc .app-card-thumb-holder .icon-holder .zip-file{
                color:#252930
            }
            .app-card-doc .app-doc-title{
                font-size:.875rem
            }
            .app-card-doc .app-doc-title a{
                color:#252930
            }
            .app-card-doc .app-doc-title.truncate{
                max-width:calc(100% - 30px);
                display:inline-block;
                overflow:hidden;
                text-overflow:ellipsis;
                white-space:nowrap
            }
            .app-card-doc .app-doc-meta{
                font-size:.75rem
            }

            .whatsapp-chat {
                bottom: 10%;
                right: 10px;
                position: fixed;
            }

            .views {
                cursor: pointer;
                display: inline-block;
                color: #9c9c9e;
            }
        </style>
@endpush
    <!-- start page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Land Management</h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{route('land.create')}}" class="btn btn-sm bg-primary text-white">Add Land</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-rep-plugin view-section" id="table" >
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th data-priority="1"></th>
                                        <th data-priority="1"> Name</th>
                                        <th data-priority="1"> Price</th>
                                        <th data-priority="1"> Size</th>
                                        <th data-priority="1"> Location</th>
                                        <th data-priority="1" class="text-end"> Status</th>
                                        <th data-priority="1" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lands as $land)
                                    <tr>
                                        <td data-priority="1">{{ $land->id }}</td>
                                        <td data-priority="1">{{$land->property->name}}</td>
                                        <td data-priority="1">XAF{{ $land->amount }}</td>
                                        <td data-priority="1">{{ $land->size }}</td>
                                        <td data-priority="1"> {{$land->property->city}}</td>
                                        <td data-priority="1" class="text-end">
                                            <form method="POST" action="{{route('activate-property')}}"
                                                class="active-deactive-form">
                                                @csrf
                                                <input name="property_id" value="{{$land->property->id}}" hidden/>
                                                <input name="current_status" value="{{$land->property->status}}" hidden/>
                                                <div class="form-check form-switch">
                                                    @if($land->property->status)
                                                        <input name="de_activate" class="btn btn-sm
                                                        btn-outline-danger" type="submit"
                                                            value="De-Active">
                                                    @else
                                                        <input name="activate" class="btn btn-sm
                                                        btn-outline-success" type="submit"
                                                            value=" Activate ">
                                                    @endif

                                                </div>
                                            </form>
                                        </td>
                                        <td data-priority="1" class="text-end">
                                            <form action="{{ route('land.destroy',$land->id) }}" method="Post">
                                                <a class="btn btn-success" href=""> <i class='bx bxs-show'></i></a>
                                                <a class="btn btn-primary" href="{{ route('land.edit',$land->id) }}"> <i class='bx bxs-pencil'></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"> <i class='bx bxs-trash'></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @foreach ($lands as $land)
                    <div class="col-6 col-md-4 col-xl-3 col-xxl-2 view-section" id="cards" style="display: none;">
                        <div class="app-card app-card-doc shadow-sm  h-100">
                            <div class="app-card-thumb-holder p-3">
                                <div class="app-card-thumb">
                                    <img class="thumb-image" src="/uploads/images/property/land/{{json_decode($land->property->image)[0]}}" alt="">
                                </div>
                                    <a class="app-card-link-mask" href="#file-link"></a>
                            </div>
                            <div class="app-card-body p-3 has-card-actions">
                                
                                <h4 class="app-doc-title truncate mb-0"><a href="#file-link">{{$land->property->name}}</a></h4>
                                <div class="app-doc-meta">
                                    <ul class="list-unstyled mb-0">
                                        <li><span class="text-muted">Price:</span> {{$land->property->amount}}</li>
                                        <li><span class="text-muted">Size:</span> {{$land->size}}</li>
                                        <li><span class="text-muted">Location:</span> {{$land->property->city}}</li>
                                    </ul>
                                </div><!--//app-doc-meta-->
                                
                                <div class="app-card-actions">
                                    <div class="dropdown">
                                        <div class="dropdown-toggle no-toggle-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots-vertical" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                            </svg>
                                        </div><!--//dropdown-toggle-->
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                                                <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                </svg>View</a></li>
                                                                                        <li><a class="dropdown-item" href="{{ route('land.edit',$land->id) }}"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>Edit</a></li>
                                                                                        <li><hr class="dropdown-divider"></li>
                                                                                        <li><a class="dropdown-item" href="#"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>Delete</a>
                                            </li>
                                        </ul>
                                    </div><!--//dropdown-->
                                </div><!--//app-card-actions-->
                                    
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div><!--//col-->
                    @endforeach
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <ul class="whatsapp-chat">
        <li class="views view-active" data-target="#table">
        <i data-feather="align-justify"></i>
        </li>
        <li class="views" data-target="#cards">
        <i data-feather="square"></i>
        </li>
    </ul>
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

        <script text="text/javascript">
             $(document).ready(function() {
            $('.views').on('click', function() {
                // Remove 'active' class from all nav items
                $('.views').removeClass('view-active');
                
                // Add 'active' class to the clicked nav item
                $(this).addClass('view-active');
                
                // Hide all sections
                $('.view-section').hide();
                
                // Show the target section
                var target = $(this).data('target');
                $(target).show();
            });
        });
        </script>

    
    @endpush
@endsection