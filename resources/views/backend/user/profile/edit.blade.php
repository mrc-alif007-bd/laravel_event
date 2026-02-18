@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Edit Profile | {{ config('app.name') }}</title>
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

        <!-- Dropzone Css -->
        <link href="{{ asset('dist/assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css">
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
                            <h6 class="page-title">Edit Profile</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.profile.index') }}">Profile</a></li>
                                <li class="breadcrumb-item active">Edit Profile</li>
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
                        <i class="mdi mdi-alert-circle me-2"></i>Please fix the errors below
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
                                                                id="profile-preview"
                                                                style="width: 120px; height: 120px; object-fit: cover;">
                                                        </div>
                                                    </div>

                                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                                    <p class="text-muted">{{ $user->email }}</p>

                                                    <div class="mt-4">
                                                        <a href="{{ route('user.profile.change-password') }}"
                                                            class="btn btn-warning waves-effect waves-light">
                                                            <i class="mdi mdi-lock me-2"></i> Change Password
                                                        </a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="text-muted">
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-email-outline me-2"></i>
                                                        {{ $user->email }}
                                                    </p>
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-phone-outline me-2"></i>
                                                        {{ $user->phone ?? 'Not provided' }}
                                                    </p>
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-map-marker-outline me-2"></i>
                                                        {{ $user->address ?? 'Address not provided' }}
                                                    </p>
                                                    <p class="mb-2">
                                                        <i class="mdi mdi-calendar-outline me-2"></i>
                                                        Joined {{ $user->created_at->format('M d, Y') }}
                                                    </p>
                                                </div>

                                                @if (!$user->email_verified_at)
                                                    <div class="mt-3 p-2 bg-soft-warning rounded">
                                                        <small class="text-warning">
                                                            <i class="mdi mdi-alert-circle me-1"></i>
                                                            Email not verified
                                                        </small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Edit Profile Information</h4>

                                                <form action="{{ route('user.profile.update') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Avatar Upload -->
                                                    <div class="mb-4">
                                                        <label class="form-label">Profile Picture</label>
                                                        <div class="border p-3 rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <img src="{{ $user->avatar ? asset($user->avatar) : asset('dist/assets/images/users/avatar-1.jpg') }}"
                                                                        alt="" class="avatar-lg rounded-circle"
                                                                        id="avatar-preview"
                                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                                </div>
                                                                <div class="col">
                                                                    <div class="custom-file">
                                                                        <input type="file"
                                                                            class="form-control @error('avatar') is-invalid @enderror"
                                                                            id="avatar" name="avatar"
                                                                            accept="image/*">
                                                                        <small class="text-muted">Upload a new profile
                                                                            picture (JPEG, PNG, GIF - max 2MB)</small>
                                                                        @error('avatar')
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Name -->
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Full Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="name" name="name"
                                                            value="{{ old('name', $user->name) }}" required>
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Email (Read Only) -->
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email Address</label>
                                                        <input type="email" class="form-control bg-light"
                                                            id="email" value="{{ $user->email }}" readonly disabled>
                                                        <small class="text-muted">Email cannot be changed. Contact support
                                                            if needed.</small>
                                                    </div>

                                                    <!-- Phone -->
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">Phone Number</label>
                                                        <input type="text"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            id="phone" name="phone"
                                                            value="{{ old('phone', $user->phone) }}"
                                                            placeholder="+1 (555) 000-0000">
                                                        @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Address -->
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                                            placeholder="Enter your full address">{{ old('address', $user->address ?? '') }}</textarea>
                                                        @error('address')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Bio/About -->
                                                    <div class="mb-3">
                                                        <label for="bio" class="form-label">About Me</label>
                                                        <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4"
                                                            placeholder="Tell us a little about yourself">{{ old('bio', $user->bio ?? '') }}</textarea>
                                                        @error('bio')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Notification Preferences -->
                                                    <div class="mb-4">
                                                        <label class="form-label">Notification Preferences</label>
                                                        <div class="border p-3 rounded">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="email_notifications" name="email_notifications"
                                                                    value="1"
                                                                    {{ old('email_notifications', $user->email_notifications ?? true) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="email_notifications">
                                                                    Receive email notifications about bookings and events
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="sms_notifications" name="sms_notifications"
                                                                    value="1"
                                                                    {{ old('sms_notifications', $user->sms_notifications ?? false) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="sms_notifications">
                                                                    Receive SMS notifications (if phone number is provided)
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="mdi mdi-content-save me-2"></i> Update Profile
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

    <!-- Image Preview Script -->
    <script>
        $(document).ready(function() {
            $('#avatar').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatar-preview').attr('src', e.target.result);
                    $('#profile-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
