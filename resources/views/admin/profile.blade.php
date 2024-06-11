@php
    use Illuminate\Support\Facades\Auth;
    $data = Auth::user();
@endphp
@extends('admin.layouts.master')
@section('title',  __('messages.global.dashboard'))
@section('content')
    @push('css')
    @endpush
  <!-- start page title -->
  <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">{{__("messages.global.profile")}}</h4>
                </div>
                <div class="card-body row">
                    <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <form id="profile_image" method="POST" action="{{route('profile-image-update')
                                        }}" enctype="multipart/form-data">
                                            @csrf
                                            <img id="show_image" src="{{!empty($data->image) ?
                                                url('uploads/images/profile/' . $data->image):
                                                url('uploads/images/user_default_image.png')}}"
                                                alt="User Image"
                                                class="rounded-circle p-1 bg-primary" width="110">
                                            <div class="mt-3">
                                                <h4>{{$data->name}}</h4>
                                                <label for="file-upload" class="btn btn-outline-primary"
                                                    style="border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                                                    <i class="bx bxs-cloud-upload"></i> upload photo
                                                </label>
                                                <input name="image" id="file-upload" type="file" style="display: none"/>
                                                <input class="btn btn-primary" type="submit" value="Save" />
                                                <div>
                                                    <small style="color: #e20000" class="error" id="image-error"></small>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="d-flex align-items-center mb-3">User Info</h4>
                                    <br>
                                    <form id="info_form" action="{{route('profile-info-update')}}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">{{__("auth.full_name")}}</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="name" type="text" class="form-control" value="{{$data->name}}"
                                                    required autofocus/>
                                                <small style="color: #e20000" class="error" id="name-error"></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">{{__("auth.phone_number")}}</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="mobile" type="text" class="form-control"
                                                    value="{{$data->mobile}}" placeholder="Your phone number" />
                                                <small style="color: #e20000" class="error" id="phone_number-error"></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Username</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="username" type="text" class="form-control"
                                                    value="{{$data->username}}" required/>
                                                <small style="color: #e20000" class="error" id="username-error"></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="email" type="email" class="form-control" value="{{$data->email}}" required/>
                                                <small style="color: #e20000" class="error" id="email-error"></small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Address</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input name="address" type="text"
                                                    class="form-control"
                                                    value="{{$data->address}}" placeholder="Your address"/>
                                                <small style="color: #e20000" class="error" id="address-error"></small>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Save Changes"
                                                />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="d-flex align-items-center mb-3">Change Password</h4>
                                            <br>
                                            <form id="password_form" action="{{route('profile-password-update')}}"
                                                method="POST">
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Current Password</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input name="password" type="password" class="form-control" required />
                                                        <small style="color: #e20000" class="error" id="password-error"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">New Password</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input name="new_password" type="password" class="form-control" autofocus/>
                                                        <small style="color: #e20000" class="error"
                                                            id="new_password-error"></small>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <h6 class="mb-0">Confirm Password</h6>
                                                    </div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input name="confirm_password" type="password" class="form-control"
                                                            autofocus/>
                                                        <small style="color: #e20000" class="error" id="confirm_password-error"></small>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3"></div>
                                                    <div class="col-sm-9 text-secondary">
                                                        <input type="submit" class="btn btn-primary px-4" value="Save"/>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
function displayDate() {
    alert("Hello! I am an alert box!!");
}
</script>
    @endpush
@endsection