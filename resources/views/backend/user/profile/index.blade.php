@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>My Profile | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('dist/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
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
                                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">My Profile</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('user.profile.edit') }}" class="btn btn-primary">
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
                                                            <img src="{{ $user->avatar ? asset($user->avatar) : asset('dist/assets/images/users/avatar-1.jpg') }}"
                                                                alt="" class="img-fluid rounded-circle"
                                                                style="width: 120px; height: 120px; object-fit: cover;">
                                                        </div>
                                                    </div>

                                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                                    <p class="text-muted">{{ $user->email }}</p>
                                                    <p class="text-muted mb-0">
                                                        <span class="badge bg-info">Member</span>
                                                    </p>
                                                </div>

                                                <hr class="my-4">

                                                <div class="text-muted">
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-phone me-2"></i>
                                                        {{ $user->phone ?? 'Phone not provided' }}
                                                    </p>
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-map-marker me-2"></i>
                                                        {{ $user->address ?? 'Address not provided' }}
                                                    </p>
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-calendar me-2"></i>
                                                        Joined {{ $user->created_at->format('F Y') }}
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
                                                                <th scope="row" style="width: 180px;">Full Name</th>
                                                                <td>{{ $user->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Email Address</th>
                                                                <td>{{ $user->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Phone Number</th>
                                                                <td>{{ $user->phone ?? 'Not provided' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Address</th>
                                                                <td>{{ $user->address ?? 'Not provided' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Account Status</th>
                                                                <td>
                                                                    @if ($user->email_verified_at)
                                                                        <span class="badge bg-success">Verified</span>
                                                                    @else
                                                                        <span class="badge bg-warning">Unverified</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Member Since</th>
                                                                <td>{{ $user->created_at->format('F d, Y') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Last Updated</th>
                                                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                @if (!$user->email_verified_at)
                                                    <div class="mt-4 p-3 bg-soft-warning rounded">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i
                                                                    class="mdi mdi-alert-circle text-warning font-size-18"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1">Email Not Verified</h6>
                                                                <p class="mb-0 text-muted">Please verify your email address
                                                                    to access all features.</p>
                                                            </div>
                                                            <div class="flex-shrink-0">
                                                                <a href="{{ route('verification.notice') }}"
                                                                    class="btn btn-warning btn-sm">Verify Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Quick Stats -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card bg-soft-primary">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i
                                                                    class="mdi mdi-ticket-confirmation text-primary font-size-24"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1">Total Bookings</h6>
                                                                <h4 class="mb-0">{{ $totalBookings ?? 0 }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card bg-soft-success">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i
                                                                    class="mdi mdi-currency-usd text-success font-size-24"></i>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="mb-1">Total Payments</h6>
                                                                <h4 class="mb-0">{{ $totalPayments ?? 0 }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
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
    <script src="{{ asset('dist/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>
@endsection
