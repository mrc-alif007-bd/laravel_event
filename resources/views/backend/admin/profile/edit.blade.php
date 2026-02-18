@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Edit Profile | {{ config('app.name') }}</title>
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

        <!-- Dropzone Css -->
        <link href="{{ url('') }}/dist/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css">
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.profile.index') }}">Profile</a></li>
                                <li class="breadcrumb-item active">Edit Profile</li>
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
                                                        <a href="{{ route('admin.profile.change-password') }}"
                                                            class="btn btn-warning waves-effect waves-light">
                                                            <i class="mdi mdi-lock me-2"></i> Change Password
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
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">Edit Profile Information</h4>

                                                <form action="{{ route('admin.profile.update') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Avatar Upload -->
                                                    <div class="mb-4">
                                                        <label class="form-label">Profile Picture</label>
                                                        <div class="border p-3 rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <img src="{{ $admin->avatar ? asset($admin->avatar) : url('') }}/dist/assets/images/users/user-4.jpg"
                                                                        alt="" class="avatar-lg rounded-circle"
                                                                        id="avatar-preview"
                                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                                </div>
                                                                <div class="col">
                                                                    <div class="custom-file">
                                                                        <input type="file"
                                                                            class="form-control @error('avatar') is-invalid @enderror"
                                                                            id="avatar" name="avatar" accept="image/*">
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
                                                            value="{{ old('name', $admin->name) }}" required>
                                                        @error('name')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Email -->
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email Address <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" name="email"
                                                            value="{{ old('email', $admin->email) }}" required>
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Phone -->
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label">Phone Number</label>
                                                        <input type="text"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            id="phone" name="phone"
                                                            value="{{ old('phone', $admin->phone) }}"
                                                            placeholder="+1 (555) 000-0000">
                                                        @error('phone')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="mdi mdi-content-save me-2"></i> Update Profile
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
