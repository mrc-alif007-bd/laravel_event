@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Change Password | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Change Password</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.profile.index') }}">Profile</a></li>
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

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle me-2"></i>{{ session('error') }}
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
                                                        <img src="{{ $user->avatar ? asset($user->avatar) : asset('dist/assets/images/users/avatar-1.jpg') }}"
                                                            alt="" class="img-fluid rounded-circle"
                                                            style="width: 120px; height: 120px; object-fit: cover;">
                                                    </div>
                                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                                    <p class="text-muted">{{ $user->email }}</p>
                                                    <p class="text-muted mb-0">
                                                        <span class="badge bg-info">Member</span>
                                                        @if ($user->email_verified_at)
                                                            <span class="badge bg-success">Verified</span>
                                                        @endif
                                                    </p>
                                                </div>

                                                <hr class="my-3">

                                                <div class="text-muted small">
                                                    <p class="mb-1">
                                                        <i class="mdi mdi-shield-lock-outline me-2"></i>
                                                        Password must be secure
                                                    </p>
                                                    <p class="mb-1">
                                                        <i class="mdi mdi-clock-outline me-2"></i>
                                                        Last changed:
                                                        {{ $user->password_updated_at ? $user->password_updated_at->diffForHumans() : 'Never' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Change Your Password</h4>

                                                <form action="{{ route('user.profile.update-password') }}" method="POST">
                                                    @csrf
                                                    @method('POST')

                                                    <!-- Current Password -->
                                                    <div class="mb-3">
                                                        <label for="current_password" class="form-label">Current Password
                                                            <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="password"
                                                                class="form-control @error('current_password') is-invalid @enderror"
                                                                id="current_password" name="current_password" required
                                                                placeholder="Enter your current password">
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                id="toggleCurrentPassword">
                                                                <i class="mdi mdi-eye-outline"></i>
                                                            </button>
                                                            @error('current_password')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <small class="text-muted">Enter your current password to verify
                                                            it's you</small>
                                                    </div>

                                                    <!-- New Password -->
                                                    <div class="mb-3">
                                                        <label for="new_password" class="form-label">New Password
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="password"
                                                                class="form-control @error('new_password') is-invalid @enderror"
                                                                id="new_password" name="new_password" required
                                                                placeholder="Enter new password">
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                id="toggleNewPassword">
                                                                <i class="mdi mdi-eye-outline"></i>
                                                            </button>
                                                            @error('new_password')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Confirm New Password -->
                                                    <div class="mb-3">
                                                        <label for="new_password_confirmation" class="form-label">Confirm
                                                            New Password
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control"
                                                                id="new_password_confirmation"
                                                                name="new_password_confirmation" required
                                                                placeholder="Confirm new password">
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                id="toggleConfirmPassword">
                                                                <i class="mdi mdi-eye-outline"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Password Requirements -->
                                                    <div class="mb-3 p-3 bg-light rounded">
                                                        <h6 class="mb-2">Password Requirements:</h6>
                                                        <ul class="list-unstyled mb-0" id="password-requirements">
                                                            <li id="req-length" class="text-muted small mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least 8 characters
                                                            </li>
                                                            <li id="req-lowercase" class="text-muted small mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least one lowercase letter
                                                            </li>
                                                            <li id="req-uppercase" class="text-muted small mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least one uppercase letter
                                                            </li>
                                                            <li id="req-number" class="text-muted small mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least one number
                                                            </li>
                                                            <li id="req-special" class="text-muted small mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least one special character (!@#$%^&*)
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <!-- Password Strength Meter -->
                                                    <div class="mb-4">
                                                        <label class="form-label">Password Strength</label>
                                                        <div class="progress" style="height: 8px;">
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
                                                        <a href="{{ route('user.profile.index') }}"
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
    <script src="{{ asset('dist/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <!-- Password Strength and Validation Script -->
    <script>
        $(document).ready(function() {
            // Toggle password visibility
            function togglePassword(inputId, button) {
                const input = $(inputId);
                const type = input.attr('type') === 'password' ? 'text' : 'password';
                input.attr('type', type);
                $(button).find('i').toggleClass('mdi-eye-outline mdi-eye-off-outline');
            }

            $('#toggleCurrentPassword').click(function() {
                togglePassword('#current_password', this);
            });

            $('#toggleNewPassword').click(function() {
                togglePassword('#new_password', this);
            });

            $('#toggleConfirmPassword').click(function() {
                togglePassword('#new_password_confirmation', this);
            });

            // Password strength checker
            $('#new_password').on('keyup', function() {
                var password = $(this).val();
                var strength = 0;
                var bar = $('#password-strength-bar');
                var text = $('#password-strength-text');

                // Check requirements
                var hasLength = password.length >= 8;
                var hasLowercase = /[a-z]/.test(password);
                var hasUppercase = /[A-Z]/.test(password);
                var hasNumber = /[0-9]/.test(password);
                var hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);

                // Update requirement icons
                $('#req-length i').attr('class', hasLength ?
                    'mdi mdi-check-circle-outline text-success me-2' :
                    'mdi mdi-close-circle-outline text-danger me-2');
                $('#req-lowercase i').attr('class', hasLowercase ?
                    'mdi mdi-check-circle-outline text-success me-2' :
                    'mdi mdi-close-circle-outline text-danger me-2');
                $('#req-uppercase i').attr('class', hasUppercase ?
                    'mdi mdi-check-circle-outline text-success me-2' :
                    'mdi mdi-close-circle-outline text-danger me-2');
                $('#req-number i').attr('class', hasNumber ?
                    'mdi mdi-check-circle-outline text-success me-2' :
                    'mdi mdi-close-circle-outline text-danger me-2');
                $('#req-special i').attr('class', hasSpecial ?
                    'mdi mdi-check-circle-outline text-success me-2' :
                    'mdi mdi-close-circle-outline text-danger me-2');

                // Calculate strength
                if (hasLength) strength += 25;
                if (hasLowercase) strength += 20;
                if (hasUppercase) strength += 20;
                if (hasNumber) strength += 20;
                if (hasSpecial) strength += 15;

                bar.css('width', strength + '%').attr('aria-valuenow', strength);

                if (strength < 40) {
                    bar.removeClass('bg-success bg-warning').addClass('bg-danger');
                    text.text('Weak password');
                } else if (strength < 70) {
                    bar.removeClass('bg-success bg-danger').addClass('bg-warning');
                    text.text('Medium password');
                } else {
                    bar.removeClass('bg-warning bg-danger').addClass('bg-success');
                    text.text('Strong password');
                }
            });

            // Confirm password match
            $('#new_password, #new_password_confirmation').on('keyup', function() {
                var password = $('#new_password').val();
                var confirm = $('#new_password_confirmation').val();
                var submitBtn = $('#submit-btn');

                if (password !== confirm) {
                    $('#new_password_confirmation').addClass('is-invalid');
                    submitBtn.prop('disabled', true);
                } else {
                    $('#new_password_confirmation').removeClass('is-invalid');
                    submitBtn.prop('disabled', false);
                }

                // Also disable if password doesn't meet requirements
                if (password.length < 8 || !/[a-z]/.test(password) || !/[A-Z]/.test(password) ||
                    !/[0-9]/.test(password) || !/[!@#$%^&*]/.test(password)) {
                    submitBtn.prop('disabled', true);
                } else if (password === confirm) {
                    submitBtn.prop('disabled', false);
                }
            });
        });
    </script>
@endsection
