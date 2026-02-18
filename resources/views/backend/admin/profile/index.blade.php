@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>My Profile | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('') }}/dist/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{ url('') }}/dist/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
            type="text/css">
        <!-- Icons Css -->
        <link href="{{ url('') }}/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ url('') }}/dist/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">
    </head>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">My Profile</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">My Profile</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">
                                    <i class="mdi mdi-account-edit me-2"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <div class="position-relative d-inline-block">
                                                        <div class="avatar-xl mb-3">
                                                            <img src="{{ $admin->avatar ? asset($admin->avatar) : url('') }}/dist/assets/images/users/user-4.jpg"
                                                                alt="" class="img-fluid rounded-circle"
                                                                style="width: 120px; height: 120px; object-fit: cover;">
                                                        </div>
                                                    </div>

                                                    <h5 class="mb-1">{{ $admin->name }}</h5>
                                                    <p class="text-muted">{{ $admin->email }}</p>
                                                    <p class="text-muted mb-0">
                                                        <span class="badge bg-success">Administrator</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Profile Information</h4>

                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row" style="width: 150px;">Full Name</th>
                                                                <td>{{ $admin->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Email Address</th>
                                                                <td>{{ $admin->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Phone Number</th>
                                                                <td>{{ $admin->phone ?? 'Not provided' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Account Status</th>
                                                                <td><span class="badge bg-success">Active</span></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Member Since</th>
                                                                <td>{{ $admin->created_at->format('F d, Y') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Last Updated</th>
                                                                <td>{{ $admin->updated_at->diffForHumans() }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>
@endsection

@section('scripts')
    <script src="{{ url('') }}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>
@endsection
