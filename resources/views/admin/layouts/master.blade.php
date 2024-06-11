<!DOCTYPE html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::to('assets/images/logo-sm.png')}}">
    <link href="{{ URL::to('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

    @includeIf('admin.layouts.css')
</head>
<body data-sidebar="dark">

<!-- Begin page -->
<div id="layout-wrapper">
    @includeIf('admin.layouts.menu')

        <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- Container-fluid starts-->
            @yield('content')
            <!-- Container-fluid Ends-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="bx bx-check-circle display-4 text-success"></i>
                            </div>
                            <h5>Confirm Save Changes</h5>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-light w-md" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary w-md" data-bs-dismiss="modal" onclick="nextTab()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        @includeIf('admin.layouts.footer')
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
@includeIf('admin.layouts.right-sidebar')
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
@includeIf('admin.layouts.js')

<!-- ckeditor -->
<script src="{{asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
<!-- init js -->
<script src="{{asset('assets/js/pages/form-editor.init.js')}}"></script>

<!-- apexcharts -->
<script src="{{ URL::to('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- Plugins js-->
<script src="{{ URL::to('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ URL::to('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>

<!-- dashboard init -->
<script src="{{ URL::to('assets/js/pages/dashboard.init.js')}}"></script>

<!-- App js -->
<script src="{{ URL::to('assets/js/app.js')}}"></script>
<script src="{{ URL::to('assets/ajax/jquery.validate.min.js')}}"></script>

</body>
</html>
