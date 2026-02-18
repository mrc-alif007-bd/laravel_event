@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Change Password | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Change Password</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.profile.index') }}">Profile</a></li>
                                <li class="breadcrumb-item active">Change Password</li>
                            </ol>
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

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
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
                                                    <div class="avatar-xl mb-3">
                                                        <img src="{{ Auth::guard('admin')->user()->avatar ? asset(Auth::guard('admin')->user()->avatar) : url('') }}/dist/assets/images/users/user-4.jpg"
                                                            alt="" class="img-fluid rounded-circle"
                                                            style="width: 120px; height: 120px; object-fit: cover;">
                                                    </div>
                                                    <h5 class="mb-1">{{ Auth::guard('admin')->user()->name }}</h5>
                                                    <p class="text-muted">{{ Auth::guard('admin')->user()->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Change Your Password</h4>

                                                <form action="{{ route('admin.profile.update-password') }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Current Password -->
                                                    <div class="mb-3">
                                                        <label for="current_password" class="form-label">Current Password
                                                            <span class="text-danger">*</span></label>
                                                        <input type="password"
                                                            class="form-control @error('current_password') is-invalid @enderror"
                                                            id="current_password" name="current_password" required>
                                                        @error('current_password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        <small class="text-muted">Enter your current password to verify it's
                                                            you</small>
                                                    </div>

                                                    <!-- New Password -->
                                                    <div class="mb-3">
                                                        <label for="new_password" class="form-label">New Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password"
                                                            class="form-control @error('new_password') is-invalid @enderror"
                                                            id="new_password" name="new_password" required>
                                                        @error('new_password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        <small class="text-muted">Minimum 8 characters</small>
                                                    </div>

                                                    <!-- Confirm New Password -->
                                                    <div class="mb-3">
                                                        <label for="new_password_confirmation" class="form-label">Confirm
                                                            New Password <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control"
                                                            id="new_password_confirmation" name="new_password_confirmation"
                                                            required>
                                                    </div>

                                                    <!-- Password Strength Meter -->
                                                    <div class="mb-3">
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar" id="password-strength-bar"
                                                                role="progressbar" style="width: 0%;" aria-valuenow="0"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <small class="text-muted" id="password-strength-text">Enter a
                                                            password to see strength</small>
                                                    </div>

                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary" id="submit-btn">
                                                            <i class="mdi mdi-lock-reset me-2"></i> Update Password
                                                        </button>
                                                        <a href="{{ route('admin.profile.index') }}"
                                                            class="btn btn-secondary">
                                                            <i class="mdi mdi-arrow-left me-2"></i> Back to Profile
                                                        </a>
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

    <!-- Password Strength Meter Script -->
    <script>
        $(document).ready(function() {
            $('#new_password').on('keyup', function() {
                var password = $(this).val();
                var strength = 0;
                var bar = $('#password-strength-bar');
                var text = $('#password-strength-text');

                if (password.length >= 8) strength += 25;
                if (password.match(/[a-z]+/)) strength += 25;
                if (password.match(/[A-Z]+/)) strength += 25;
                if (password.match(/[0-9]+/)) strength += 15;
                if (password.match(/[$@#&!]+/)) strength += 10;

                bar.css('width', strength + '%');

                if (strength < 30) {
                    bar.removeClass('bg-success bg-warning').addClass('bg-danger');
                    text.text('Weak password');
                } else if (strength < 60) {
                    bar.removeClass('bg-success bg-danger').addClass('bg-warning');
                    text.text('Medium password');
                } else {
                    bar.removeClass('bg-warning bg-danger').addClass('bg-success');
                    text.text('Strong password');
                }
            });

            // Confirm password match
            $('#new_password_confirmation').on('keyup', function() {
                var password = $('#new_password').val();
                var confirm = $(this).val();

                if (password !== confirm) {
                    $(this).addClass('is-invalid');
                    $('#submit-btn').prop('disabled', true);
                } else {
                    $(this).removeClass('is-invalid');
                    $('#submit-btn').prop('disabled', false);
                }
            });
        });
    </script>
@endsection
