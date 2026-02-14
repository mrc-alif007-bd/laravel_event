@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Create Event Type | Veltrix - Admin & Dashboard Template</title>
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
                            <h6 class="page-title">Create New Event Type</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Event Types</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Create Event Type</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back to Event Types
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong><i class="mdi mdi-alert-circle"></i> Error!</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><i class="mdi mdi-check-circle"></i> Success!</strong>
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <h4 class="card-title mb-4">Add New Event Type</h4>

                                <!-- Event Type Creation Form -->
                                <form action="{{ route('admin.category.store') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <!-- Event Type Name (matches 'name' column) -->
                                            <div class="mb-4">
                                                <label for="name" class="form-label">
                                                    Event Type Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" value="{{ old('name') }}"
                                                    placeholder="Enter event type name (e.g., Music Festival, Conference, Workshop, Sports)"
                                                    maxlength="100" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Maximum 100 characters</small>
                                            </div>

                                            <!-- Description (matches 'description' column) -->
                                            <div class="mb-4">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                                    rows="4" maxlength="200" placeholder="Enter event type description (max 200 characters)">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">
                                                    <span id="charCount">0</span>/200 characters
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="card-footer bg-transparent border-top">
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('admin.category.index') }}"
                                                        class="btn btn-outline-secondary">
                                                        <i class="mdi mdi-close me-1"></i> Cancel
                                                    </a>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="mdi mdi-content-save me-1"></i> Save Event Type
                                                        </button>
                                                    </div>
                                                </div>
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

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <span class="text-muted">
                            &copy; {{ date('Y') }} Veltrix - Crafted with <i class="mdi mdi-heart text-danger"></i> by
                            Themesbrand
                        </span>
                    </div>
                </div>
            </div>
        </footer>
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
            $('#description').on('keyup change', function() {
                let currentLength = $(this).val().length;
                $('#charCount').text(currentLength);

                // Visual warning when approaching limit
                if (currentLength >= 180) {
                    $('#charCount').addClass('text-warning');
                } else {
                    $('#charCount').removeClass('text-warning');
                }

                if (currentLength >= 195) {
                    $('#charCount').addClass('text-danger');
                } else {
                    $('#charCount').removeClass('text-danger');
                }
            });

            // Trigger on page load if there's old input
            $('#description').trigger('keyup');

            // Form validation
            $('form').on('submit', function(e) {
                let name = $('#name').val().trim();
                let description = $('#description').val().trim();
                let isValid = true;
                let errorMessage = '';

                if (name === '') {
                    errorMessage += 'Event Type Name is required.\n';
                    isValid = false;
                } else if (name.length > 100) {
                    errorMessage += 'Event Type Name cannot exceed 100 characters.\n';
                    isValid = false;
                }

                if (description.length > 200) {
                    errorMessage += 'Description cannot exceed 200 characters.\n';
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    alert(errorMessage);
                }
            });
        });
    </script>
@endsection
