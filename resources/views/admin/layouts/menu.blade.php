@php
   use App\MyHelpers;
   use Illuminate\Support\Facades\Auth;
@endphp
@php
    $authData = Auth::user();
    $notificationCount = $authData->unreadNotifications()->count();
    $role = Auth::user()->role;
    $status = Auth::user()->status;
@endphp
<?php
$available_locales = config('app.available_locales');
$current_locale = app()->getLocale();
?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="24"> <span class="logo-txt">{{__(config('app.name'))}}</span>
                    </span>
                </a>

                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="24"> <span class="logo-txt">{{__(config('app.name'))}}</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="{{__("messages.global.search")}}">
                    <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{__("messages.global.search")}}" aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    @if ($current_locale == config('app.available_locales.English'))
                        <img class="me-2" src="{{asset('assets/images/flags/us.jpg')}}" alt="Header Language" height="16">
                    @endif

                    @if ($current_locale == config('app.available_locales.French'))
                    <img class="me-2" src="{{asset('assets/images/flags/french.jpg')}}" alt="Header Language" height="16">
                    @endif
                </button>

                <div class="dropdown-menu dropdown-menu-end">
                    @foreach($available_locales as $locale_name => $available_locale)
                        @if($available_locale === $current_locale)
                            <span class="ml-2 mr-2 text-gray-700 d-none">{{ $locale_name }}</span>
                        @else
                    <a class="dropdown-item" href="language/{{ $available_locale }}">
                        @if ($current_locale != config('app.available_locales.English'))
                            <img class="me-2" src="{{asset('assets/images/flags/us.jpg')}}" alt="Header Language" height="16">
                        @endif

                        @if ($current_locale != config('app.available_locales.French'))
                        <img class="me-2" src="{{asset('assets/images/flags/french.jpg')}}" alt="Header Language" height="16">
                        @endif 
                        {{ $locale_name }}
                    </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell" class="icon-lg"></i>
                    @if($notificationCount > 0)
                      <span class="badge bg-danger rounded-pill">{{ $notificationCount  }}</span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-notifications-dropdown">
                 @forelse($authData->notifications as $notification)
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">{{ $notification->data['title']  }} </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="small text-reset text-decoration-underline"> {{MyHelpers::getDiffOfDate($notification->created_at) }}</a>
                            </div>
                        </div>
                    </div>
                    @empty
                 @endforelse

                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span> {{__("messages.admin.view_more")}}</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Start right Side bar toggle-->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item right-bar-toggle me-2">
                    <i data-feather="settings" class="icon-lg"></i>
                </button>
            </div>
            <!-- End right Side bar toggle-->

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{!empty($authData->image) ?
                                          url('uploads/images/profile/' . $authData->image):
                                          url('uploads/images/user_default_image.png')}}"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium"> {{$authData->name}} </span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> {{__("messages.global.profile")}}</a>
                    <a class="dropdown-item" href="#"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> {{__("messages.global.lock_screen")}} </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('logout') }}"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> {{__("messages.global.logout")}}</a>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- ========== Left Sidebar Start ========== -->
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"> {{__("messages.global.menu")}}</li>
                <li>
                    <a href="#">
                    <i data-feather="grid"></i>
                        <span data-key="t-dashboard"> {{__('messages.global.dashboard')}}</span>
                    </a>
                </li>
                @if($role === 'admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="users"></i>
                        <span data-key="t-apps">User Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('agent-list') }}">
                                <i data-feather="circle"></i>
                                <span data-key="t-chat"> Agents</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i data-feather="circle"></i>
                                <span data-key="t-chat"> Clients</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                @if($status)
                <li>
                    <a href="#">
                    <i data-feather="grid"></i>
                        <span data-key="t-dashboard"> Property Listing</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="list"></i>
                        <span data-key="t-apps">  Properties</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       
                        <li>
                            <a href="{{route('land.index')}}">
                                <i data-feather="circle"></i>
                                <span data-key="t-calender"> Land</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('house.index')}}">
                                <i data-feather="circle"></i>
                                <span data-key="t-calender"> House</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{route('vehicle.index')}}">
                                <i data-feather="circle"></i>
                                <span data-key="t-calender"> Vehicle</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->


