@extends('backend.layouts.master')

@section('head')
    <head>
        <meta charset="utf-8">
        <title>Edit Venue | Veltrix - Admin & Dashboard Template</title>
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
                            <h6 class="page-title">Edit Venue</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.venue.index') }}">Venues</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Venue</li>
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

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle me-2"></i> Please fix the following errors:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title">Update Venue Information</h4>
                                    <div>
                                        <span class="badge bg-info">ID: #{{ $venue->id }}</span>
                                    </div>
                                </div>

                                <p class="card-title-desc mb-4">
                                    Edit the venue details below. Fields marked with <span class="text-danger">*</span> are required.
                                </p>

                                <form action="{{ route('admin.venue.update', $venue->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    Venue Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       id="name" 
                                                       name="name" 
                                                       value="{{ old('name', $venue->name) }}"
                                                       class="form-control @error('name') is-invalid @enderror" 
                                                       maxlength="50" 
                                                       placeholder="Enter venue name"
                                                       required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Maximum 50 characters</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city" class="form-label">
                                                    City <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       id="city" 
                                                       name="city" 
                                                       value="{{ old('city', $venue->city) }}"
                                                       class="form-control @error('city') is-invalid @enderror" 
                                                       maxlength="50" 
                                                       placeholder="Enter city name"
                                                       required>
                                                @error('city')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Maximum 50 characters</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">
                                                    Address <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       id="address" 
                                                       name="address" 
                                                       value="{{ old('address', $venue->address) }}"
                                                       class="form-control @error('address') is-invalid @enderror" 
                                                       maxlength="50" 
                                                       placeholder="Enter street address"
                                                       required>
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Maximum 50 characters</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="capacity" class="form-label">
                                                    Capacity <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" 
                                                       min="1" 
                                                       id="capacity" 
                                                       name="capacity" 
                                                       value="{{ old('capacity', $venue->capacity) }}"
                                                       class="form-control @error('capacity') is-invalid @enderror" 
                                                       placeholder="Enter maximum capacity"
                                                       required>
                                                @error('capacity')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Minimum 1 person</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">
                                                    Status <span class="text-danger">*</span>
                                                </label>
                                                <select id="status" 
                                                        name="status" 
                                                        class="form-select @error('status') is-invalid @enderror" 
                                                        required>
                                                    <option value="">Select Status</option>
                                                    <option value="active" {{ old('status', $venue->status) === 'active' ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="inactive" {{ old('status', $venue->status) === 'inactive' ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Set venue availability status</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">
                                                    Venue Image
                                                </label>
                                                <input type="file" 
                                                       id="image" 
                                                       name="image" 
                                                       class="form-control @error('image') is-invalid @enderror"
                                                       accept="image/*">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Allowed formats: JPG, PNG, GIF (Max: 2MB)</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">
                                                    Description <span class="text-danger">*</span>
                                                </label>
                                                <textarea id="description" 
                                                          name="description" 
                                                          rows="4" 
                                                          maxlength="200"
                                                          class="form-control @error('description') is-invalid @enderror" 
                                                          placeholder="Enter venue description, features, or notes"
                                                          required>{{ old('description', $venue->description) }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Maximum 200 characters ({{ strlen(old('description', $venue->description)) }}/200)</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    @if ($venue->image)
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <label class="form-label">Current Image</label>
                                            <div class="border p-3 rounded">
                                                <img src="{{ asset($venue->image) }}" 
                                                     alt="{{ $venue->name }}" 
                                                     width="150" 
                                                     class="img-thumbnail">
                                                <div class="mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" 
                                                               type="checkbox" 
                                                               name="remove_image" 
                                                               id="remove_image" 
                                                               value="1">
                                                        <label class="form-check-label text-danger" for="remove_image">
                                                            <i class="mdi mdi-delete"></i> Remove current image
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('admin.venue.index') }}" class="btn btn-outline-secondary">
                                                    <i class="mdi mdi-cancel me-1"></i> Cancel
                                                </a>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="mdi mdi-content-save me-1"></i> Update Venue
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <span class="text-muted">
                            &copy; {{ date('Y') }} Veltrix - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
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
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Character counter for description
            $('#description').on('input', function() {
                var length = $(this).val().length;
                var max = $(this).attr('maxlength');
                $('small.text-muted:contains("/200")').text('Maximum 200 characters (' + length + '/' + max + ')');
                
                if (length > max - 20) {
                    $('small.text-muted:contains("/200")').addClass('text-warning');
                } else {
                    $('small.text-muted:contains("/200")').removeClass('text-warning');
                }
            });

            // Preview image before upload
            $('#image').on('change', function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // Remove existing preview if any
                        $('.image-preview').remove();
                        
                        // Add new preview
                        $('#image').after(
                            '<div class="mt-2 image-preview">' +
                            '<img src="' + e.target.result + '" width="150" class="img-thumbnail">' +
                            '</div>'
                        );
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Remove image checkbox functionality
            $('#remove_image').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#image').prop('disabled', true).addClass('bg-light');
                } else {
                    $('#image').prop('disabled', false).removeClass('bg-light');
                }
            });

            // Form validation before submit
            $('form').on('submit', function(e) {
                var capacity = $('#capacity').val();
                if (capacity < 1) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Capacity must be at least 1',
                        confirmButtonColor: '#556ee6'
                    });
                }
            });
        });
    </script>

    <!-- SweetAlert (if needed for additional features) -->
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonColor: '#556ee6'
        });
    </script>
    @endif
@endsection