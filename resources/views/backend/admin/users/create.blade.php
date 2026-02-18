@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Create User | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Create User</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                                <li class="breadcrumb-item active">Create User</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Create New User</h4>

                                <form action="{{ route('admin.users.store') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Name -->
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Full Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" value="{{ old('name') }}" placeholder="Enter full name"
                                                    required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Email -->
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address <span
                                                        class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" value="{{ old('email') }}"
                                                    placeholder="Enter email address" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Phone -->
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                    name="phone" value="{{ old('phone') }}"
                                                    placeholder="Enter phone number">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Role -->
                                            <div class="mb-3">
                                                <label for="role" class="form-label">User Role</label>
                                                <select class="form-control @error('role') is-invalid @enderror"
                                                    id="role" name="role">
                                                    <option value="user"
                                                        {{ old('role', 'user') == 'user' ? 'selected' : '' }}>Regular User
                                                    </option>
                                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                                        Admin</option>
                                                </select>
                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Password -->
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password" name="password" placeholder="Enter password"
                                                        required>
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="togglePassword('password', this)">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </button>
                                                </div>
                                                <small class="text-muted">Minimum 6 characters</small>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Confirm Password -->
                                            <div class="mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm Password
                                                    <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                        id="password_confirmation" name="password_confirmation"
                                                        placeholder="Confirm password" required>
                                                    <button class="btn btn-outline-secondary" type="button"
                                                        onclick="togglePassword('password_confirmation', this)">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Password Strength Meter -->
                                    <div class="mb-4" id="password-strength" style="display: none;">
                                        <label class="form-label">Password Strength</label>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar" id="password-strength-bar" role="progressbar"
                                                style="width: 0%;"></div>
                                        </div>
                                        <small id="password-strength-text" class="text-muted"></small>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-account-plus me-2"></i> Create User
                                        </button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left me-2"></i> Back to Users
                                        </a>
                                    </div>
                                </form>
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
        $('#password').on('keyup', function() {
            const password = $(this).val();

            if (password.length > 0) {
                $('#password-strength').show();

                let strength = 0;
                const requirements = {
                    length: password.length >= 6,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /[0-9]/.test(password),
                    special: /[!@#$%^&*]/.test(password)
                };

                // Calculate strength
                if (requirements.length) strength += 20;
                if (requirements.uppercase) strength += 20;
                if (requirements.lowercase) strength += 20;
                if (requirements.number) strength += 20;
                if (requirements.special) strength += 20;

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
            } else {
                $('#password-strength').hide();
            }
        });

        // Password match checker
        $('#password_confirmation').on('keyup', function() {
            const password = $('#password').val();
            const confirm = $(this).val();

            if (confirm.length > 0) {
                if (password !== confirm) {
                    $(this).addClass('is-invalid');
                    $(this).removeClass('is-valid');
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                }
            } else {
                $(this).removeClass('is-invalid is-valid');
            }
        });
    </script>
@endsection
