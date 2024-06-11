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
        </style>
@endpush
    <!-- start page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Agent Management</h4>
                </div>
                <div class="card-body p-4">
                    <div class="table-rep-plugin">
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                    <tr>
                                        <th data-priority="1"></th>
                                        <th data-priority="1">Name</th>
                                        <th data-priority="1">Phone</th>
                                        <th data-priority="1">Username</th>
                                        <th data-priority="1">Status</th>
                                        <th data-priority="1" class="text-end"> Status</th>
                                        <th data-priority="1" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td data-priority="1">{{ $item->id }}</td>
                                        <td data-priority="1">{{$item->name}}</td>
                                        <td data-priority="1">{{$item->mobile}}</td>
                                        <td data-priority="1">{{$item->username}}</td>
                                        <td data-priority="1">
                                            @if($item->status)
                                                <div class="badge rounded-pill bg-light-success text-success w-100">active</div>
                                            @else
                                                <div class="badge rounded-pill bg-light-danger text-danger w-100">Not active</div>
                                            @endif
                                        </td>
                                        <td data-priority="1" class="text-end">
                                           <form method="POST" action="{{route('activate-agent')}}" class="active-deactive-form">
                                                @csrf
                                                <input name="agent_id" value="{{$item->id}}" hidden/>
                                                <input name="current_status" value="{{$item->status}}" hidden/>
                                                <div class="form-check form-switch">
                                                    @if($item->status)
                                                        <input name="de_activate" class="btn btn-sm
                                                        btn-danger" type="submit"
                                                            value="De-Active">
                                                    @else
                                                        <input name="activate" class="btn btn-sm
                                                        btn-success" type="submit"
                                                            value=" Activate ">
                                                    @endif

                                                </div>
                                            </form>
                                        </td>
                                        <td data-priority="1" class="text-end">
                                         <div class="d-flex order-actions">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal-{{$item->id}}"><i class='bx bxs-show'></i></button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleVerticallycenteredModal-{{$item->id}}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Agent Details</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img src="{{url('uploads/images/profile/' . $item->photo)}}"
                                                                    class="card-img-top" style="max-width: 300px; margin-left:
                                                                        10px">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Name : <span style="font-weight:
                                                                        lighter">{{$item->name}}</span>
                                                                    </h5>
                                                                    <h5 class="card-title">Email : <span style="font-weight:
                                                                        lighter">{{$item->email}}</span>
                                                                    </h5>
                                                                    <h5 class="card-title">Username : <span style="font-weight:
                                                                        lighter">{{$item->username}}</span>
                                                                    </h5>
                                                                    <h5 class="card-title">Address : <span style="font-weight:
                                                                        lighter">{{$item->address ?  : 'No address
                                                                        '}}</span>
                                                                    </h5>
                                                                    <h5 class="card-title">Phone Number : <span style="font-weight:
                                                                        lighter">{{$item->phone_number ? : 'No phone number'}}</span>
                                                                    </h5>
                                                                    <h5 class="card-title">Status : <span style="font-weight:
                                                                        lighter">
                                                                            @if($item->status)
                                                                                <span style="color: lime">active</span>
                                                                            @else
                                                                                <span style="color: red">Not active</span>
                                                                            @endif
                                                                        </span>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="" class="ms-3 btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleDangerModal-{{$item->id}}"><i class='bx bxs-trash'></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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

    
    @endpush
@endsection