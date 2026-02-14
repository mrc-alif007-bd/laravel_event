@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Create Venue | Veltrix - Admin & Dashboard Template</title>
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
                            <h6 class="page-title">Create New Venue</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.venue.index') }}">Venues</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Venue</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.venue.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back to Venues
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Error Alert -->
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="mdi mdi-alert-circle"></i> Error!</strong>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Success Alert -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="mdi mdi-check-circle"></i> Success!</strong>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Validation Errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong><i class="mdi mdi-alert-circle"></i> Please fix the following
                                            errors:</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <h4 class="card-title mb-4">Add New Venue</h4>

                                <!-- Venue Creation Form -->
                                <form action="{{ route('admin.venue.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!-- Venue Name -->
                                            <div class="mb-4">
                                                <label for="name" class="form-label">
                                                    Venue Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" value="{{ old('name') }}"
                                                    placeholder="Enter venue name (e.g., Grand Hall, Conference Center, Stadium)"
                                                    maxlength="50" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Maximum 50 characters</small>
                                            </div>

                                            <!-- Address -->
                                            <div class="mb-4">
                                                <label for="address" class="form-label">
                                                    Address <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    id="address" name="address" value="{{ old('address') }}"
                                                    placeholder="Enter street address" maxlength="50" required>
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Maximum 50 characters</small>
                                            </div>

                                            <!-- City -->
                                            <div class="mb-4">
                                                <label for="city" class="form-label">
                                                    City <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    id="city" name="city" value="{{ old('city') }}"
                                                    placeholder="Enter city name" maxlength="50" required>
                                                @error('city')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Maximum 50 characters</small>
                                            </div>

                                            <!-- Capacity -->
                                            <div class="mb-4">
                                                <label for="capacity" class="form-label">
                                                    Capacity <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" min="1"
                                                    class="form-control @error('capacity') is-invalid @enderror"
                                                    id="capacity" name="capacity" value="{{ old('capacity') }}"
                                                    placeholder="Enter maximum capacity" required>
                                                @error('capacity')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Minimum 1 person</small>
                                            </div>

                                            <!-- Status -->
                                            <div class="mb-4">
                                                <label for="status" class="form-label">
                                                    Status <span class="text-danger">*</span>
                                                </label>
                                                <select id="status" name="status"
                                                    class="form-select @error('status') is-invalid @enderror" required>
                                                    <option value="" {{ old('status') ? '' : 'selected' }} disabled>
                                                        Select Status</option>
                                                    <option value="active"
                                                        {{ old('status') == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="inactive"
                                                        {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Set venue availability status</small>
                                            </div>

                                            <!-- Description -->
                                            <div class="mb-4">
                                                <label for="description" class="form-label">
                                                    Description <span class="text-danger">*</span>
                                                </label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                    rows="4" maxlength="200" placeholder="Enter venue description (max 200 characters)">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">
                                                    <span id="charCount">0</span>/200 characters
                                                </small>
                                            </div>

                                            <!-- Image -->
                                            <div class="mb-4">
                                                <label for="image" class="form-label">
                                                    Venue Image
                                                </label>
                                                <input type="file" id="image" name="image"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    accept="image/jpeg,image/png,image/jpg">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">
                                                    Allowed: JPG, JPEG, PNG (Max: 2MB)<br>
                                                    Recommended size: 1200x800 pixels
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('admin.venue.index') }}"
                                                    class="btn btn-outline-secondary">
                                                    <i class="mdi mdi-close me-1"></i> Cancel
                                                </a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="mdi mdi-content-save me-1"></i> Save Venue
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
    </div>
@endsection

@section('scripts')
    <!-- JAVASCRIPT -->
    <script src="{{ asset('dist/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- App JS -->
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Character counter for description
            function updateCharCount() {
                let currentLength = $('#description').val().length;
                $('#charCount').text(currentLength);

                // Remove existing classes
                $('#charCount').removeClass('text-warning text-danger');

                // Add warning classes based on length
                if (currentLength >= 195) {
                    $('#charCount').addClass('text-danger');
                } else if (currentLength >= 180) {
                    $('#charCount').addClass('text-warning');
                }
            }

            $('#description').on('keyup change', updateCharCount);

            // Initialize on page load
            updateCharCount();
        });
    </script>
@endsection
