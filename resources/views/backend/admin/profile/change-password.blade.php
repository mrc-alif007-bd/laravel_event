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
                                                                id="profile-preview"
                                                                style="width: 120px; height: 120px; object-fit: cover;">
                                                        </div>
                                                    </div>

                                                    <h5 class="mb-1">{{ $admin->name }}</h5>
                                                    <p class="text-muted">{{ $admin->email }}</p>

                                                    <div class="mt-4">
                                                        <a href="{{ route('admin.profile.edit') }}"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            <i class="mdi mdi-account-edit me-2"></i> Edit Profile
                                                        </a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="text-muted">
                                                    <p class="mb-2"><i class="mdi mdi-email-outline me-2"></i>
                                                        {{ $admin->email }}</p>
                                                    <p class="mb-2"><i class="mdi mdi-phone-outline me-2"></i>
                                                        {{ $admin->phone ?? 'Not provided' }}</p>
                                                    <p class="mb-2"><i class="mdi mdi-calendar-outline me-2"></i> Joined
                                                        {{ $admin->created_at->format('M d, Y') }}</p>
                                                </div>

                                                <div class="alert alert-info mt-3 mb-0">
                                                    <i class="mdi mdi-information-outline me-2"></i>
                                                    Use a strong password that you don't use elsewhere.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Change Your Password</h4>

                                                @if (session('success'))
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        <i class="mdi mdi-check-circle me-2"></i>
                                                        {{ session('success') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                @if ($errors->any())
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        <i class="mdi mdi-alert-circle me-2"></i>
                                                        <strong>Please fix the following errors:</strong>
                                                        <ul class="mt-2 mb-0">
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                <form action="{{ route('admin.profile.update-password') }}" method="POST">
                                                    @csrf
                                                    @method('POST')

                                                    <!-- Current Password -->
                                                    <div class="mb-4">
                                                        <label for="current_password" class="form-label">Current Password
                                                            <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="mdi mdi-lock-outline"></i></span>
                                                            <input type="password"
                                                                class="form-control @error('current_password') is-invalid @enderror"
                                                                id="current_password" name="current_password"
                                                                placeholder="Enter your current password" required>
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                onclick="togglePassword('current_password', this)">
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
                                                    <div class="mb-4">
                                                        <label for="new_password" class="form-label">New Password <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="mdi mdi-lock-plus-outline"></i></span>
                                                            <input type="password"
                                                                class="form-control @error('new_password') is-invalid @enderror"
                                                                id="new_password" name="new_password"
                                                                placeholder="Enter new password" required>
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                onclick="togglePassword('new_password', this)">
                                                                <i class="mdi mdi-eye-outline"></i>
                                                            </button>
                                                            @error('new_password')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Password Strength Meter -->
                                                    <div class="mb-3" id="password-strength" style="display: none;">
                                                        <label class="form-label">Password Strength</label>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar" id="password-strength-bar"
                                                                role="progressbar" style="width: 0%;" aria-valuenow="0"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <small id="password-strength-text" class="text-muted"></small>
                                                    </div>

                                                    <!-- Password Requirements -->
                                                    <div class="mb-4 p-3 bg-light rounded">
                                                        <h6 class="mb-2">Password Requirements:</h6>
                                                        <ul class="list-unstyled mb-0">
                                                            <li id="req-length" class="text-muted mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least 8 characters
                                                            </li>
                                                            <li id="req-uppercase" class="text-muted mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least one uppercase letter
                                                            </li>
                                                            <li id="req-lowercase" class="text-muted mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least one lowercase letter
                                                            </li>
                                                            <li id="req-number" class="text-muted mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least one number
                                                            </li>
                                                            <li id="req-special" class="text-muted mb-1">
                                                                <i
                                                                    class="mdi mdi-close-circle-outline text-danger me-2"></i>
                                                                At least one special character (!@#$%^&*)
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <!-- Confirm New Password -->
                                                    <div class="mb-4">
                                                        <label for="new_password_confirmation" class="form-label">Confirm
                                                            New Password <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="mdi mdi-lock-check-outline"></i></span>
                                                            <input type="password" class="form-control"
                                                                id="new_password_confirmation"
                                                                name="new_password_confirmation"
                                                                placeholder="Re-enter new password" required>
                                                            <button class="btn btn-outline-secondary" type="button"
                                                                onclick="togglePassword('new_password_confirmation', this)">
                                                                <i class="mdi mdi-eye-outline"></i>
                                                            </button>
                                                        </div>
                                                        <div class="invalid-feedback" id="password-match-error"
                                                            style="display: none;">
                                                            Passwords do not match
                                                        </div>
                                                        <small class="text-muted">Re-enter your new password to
                                                            confirm</small>
                                                    </div>

                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary" id="submit-btn">
                                                            <i class="mdi mdi-content-save me-2"></i> Update Password
                                                        </button>
                                                        <a href="{{ route('admin.profile.index') }}"
                                                            class="btn btn-secondary">
                                                            <i class="mdi mdi-arrow-left me-2"></i> Back to Profile
                                                        </a>
                                                    </div>
                                                </form>

                                                <hr class="my-4">

                                                <div class="alert alert-warning mb-0">
                                                    <div class="d-flex">
                                                        <div class="me-3">
                                                            <i class="mdi mdi-shield-alert-outline"
                                                                style="font-size: 24px;"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="alert-heading">Password Security Tips:</h6>
                                                            <p class="mb-0">Never share your password with anyone. Use a
                                                                unique password for this account. Consider using a password
                                                                manager to generate and store strong passwords.</p>
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
    <script src="{{ url('') }}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            // Toggle password visibility
            window.togglePassword = function(inputId, button) {
                const input = document.getElementById(inputId);
                const icon = button.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('mdi-eye-outline');
                    icon.classList.add('mdi-eye-off-outline');
                } else {
                    input.type = 'password';
                    icon.classList.remove('mdi-eye-off-outline');
                    icon.classList.add('mdi-eye-outline');
                }
            };

            // Password strength checker
            $('#new_password').on('keyup', function() {
                const password = $(this).val();
                checkPasswordStrength(password);
                checkPasswordMatch();
            });

            // Password match checker
            $('#new_password_confirmation').on('keyup', function() {
                checkPasswordMatch();
            });

            function checkPasswordStrength(password) {
                if (password.length > 0) {
                    $('#password-strength').show();
                } else {
                    $('#password-strength').hide();
                    return;
                }

                let strength = 0;
                const requirements = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[!@#$%^&*]/.test(password)
                };

                // Update requirement indicators
                $('#req-length').html(
                    `<i class="mdi mdi-${requirements.length ? 'check-circle-outline text-success' : 'close-circle-outline text-danger'} me-2"></i> At least 8 characters`
                    );
                $('#req-uppercase').html(
                    `<i class="mdi mdi-${requirements.uppercase ? 'check-circle-outline text-success' : 'close-circle-outline text-danger'} me-2"></i> At least one uppercase letter`
                    );
                $('#req-lowercase').html(
                    `<i class="mdi mdi-${requirements.lowercase ? 'check-circle-outline text-success' : 'close-circle-outline text-danger'} me-2"></i> At least one lowercase letter`
                    );
                $('#req-number').html(
                    `<i class="mdi mdi-${requirements.number ? 'check-circle-outline text-success' : 'close-circle-outline text-danger'} me-2"></i> At least one number`
                    );
                $('#req-special').html(
                    `<i class="mdi mdi-${requirements.special ? 'check-circle-outline text-success' : 'close-circle-outline text-danger'} me-2"></i> At least one special character (!@#$%^&*)`
                    );

                // Calculate strength
                Object.values(requirements).forEach(value => {
                    if (value) strength += 20;
                });

                // Update progress bar
                const bar = $('#password-strength-bar');
                bar.css('width', strength + '%');

                if (strength < 40) {
                    bar.removeClass().addClass('progress-bar bg-danger');
                    $('#password-strength-text').text('Weak password');
                } else if (strength < 80) {
                    bar.removeClass().addClass('progress-bar bg-warning');
                    $('#password-strength-text').text('Medium password');
                } else {
                    bar.removeClass().addClass('progress-bar bg-success');
                    $('#password-strength-text').text('Strong password');
                }
            }

            function checkPasswordMatch() {
                const password = $('#new_password').val();
                const confirm = $('#new_password_confirmation').val();

                if (confirm.length > 0) {
                    if (password !== confirm) {
                        $('#new_password_confirmation').addClass('is-invalid');
                        $('#password-match-error').show();
                        $('#submit-btn').prop('disabled', true);
                    } else {
                        $('#new_password_confirmation').removeClass('is-invalid');
                        $('#password-match-error').hide();
                        $('#submit-btn').prop('disabled', false);
                    }
                } else {
                    $('#new_password_confirmation').removeClass('is-invalid');
                    $('#password-match-error').hide();
                    $('#submit-btn').prop('disabled', false);
                }
            }

            // Prevent form submission if passwords don't match
            $('form').on('submit', function(e) {
                const password = $('#new_password').val();
                const confirm = $('#new_password_confirmation').val();

                if (password !== confirm) {
                    e.preventDefault();
                    $('#new_password_confirmation').addClass('is-invalid');
                    $('#password-match-error').show();
                }
            });
        });
    </script>
@endsection
