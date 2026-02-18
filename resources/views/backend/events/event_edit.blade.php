@extends('backend.layouts.master')

@section('head')
    <head>
        <meta charset="utf-8">
        <title>Edit Event | Veltrix - Admin & Dashboard Template</title>
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

        <!-- SweetAlert CSS -->
        <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
        
        <style>
            /* Force all select elements to be visible */
            select, 
            select.form-select, 
            select.form-control,
            #status,
            select[name="status"] {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                pointer-events: auto !important;
            }
        </style>
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
                            <h6 class="page-title">Edit Event</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}">Events</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back to Events
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-alert-circle me-2"></i> {{ session('error') }}
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

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title">Update Event Information</h4>
                                    <span class="badge bg-info">ID: #{{ $event->id }}</span>
                                </div>

                                <p class="card-title-desc mb-4">
                                    Edit event details below. Fields marked with <span class="text-danger">*</span> are required.
                                </p>

                                <form id="eventForm" action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="title" class="form-label">
                                                    Event Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" 
                                                       id="title" 
                                                       name="title"
                                                       value="{{ old('title', $event->title) }}"
                                                       class="form-control @error('title') is-invalid @enderror"
                                                       placeholder="Enter event title" 
                                                       maxlength="50" 
                                                       required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Minimum 3, maximum 50 characters</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="venue_id" class="form-label">
                                                    Venue <span class="text-danger">*</span>
                                                </label>
                                                <select id="venue_id" 
                                                        name="venue_id"
                                                        class="form-select @error('venue_id') is-invalid @enderror" 
                                                        required>
                                                    <option value="">Select Venue</option>
                                                    @foreach ($venues as $venue)
                                                        <option value="{{ $venue->id }}"
                                                            {{ old('venue_id', $event->venue_id) == $venue->id ? 'selected' : '' }}>
                                                            {{ $venue->name }} ({{ $venue->city }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('venue_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Choose where the event takes place</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">
                                                    Event Type <span class="text-danger">*</span>
                                                </label>
                                                <select id="category_id" 
                                                        name="category_id"
                                                        class="form-select @error('category_id') is-invalid @enderror" 
                                                        required>
                                                    <option value="">Select Type</option>
                                                    <option value="1" {{ old('category_id', $event->category_id) == '1' ? 'selected' : '' }}>Paid</option>
                                                    <option value="0" {{ old('category_id', $event->category_id) == '0' ? 'selected' : '' }}>Free</option>
                                                </select>
                                                @error('category_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Select pricing model for this event</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="price" class="form-label">
                                                    Price <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" 
                                                           step="0.01" 
                                                           min="0" 
                                                           id="price" 
                                                           name="price"
                                                           value="{{ old('price', $event->price) }}"
                                                           class="form-control @error('price') is-invalid @enderror"
                                                           placeholder="0.00" 
                                                           required>
                                                </div>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Enter 0 for free events</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Select Option -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">
                                                    Status <span class="text-danger">*</span>
                                                </label>
                                                <select id="status" 
                                                        name="status"
                                                        class="form-select @error('status') is-invalid @enderror" 
                                                        required
                                                        style="display: block !important; visibility: visible !important;">
                                                    <option value="">-- Select Status --</option>
                                                    <option value="1" {{ old('status', $event->status) == '1' ? 'selected' : '' }}>Up Coming</option>
                                                    <option value="2" {{ old('status', $event->status) == '2' ? 'selected' : '' }}>Completed</option>
                                                    <option value="3" {{ old('status', $event->status) == '3' ? 'selected' : '' }}>Canceled</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Select the current status of the event</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Event Image</label>
                                                <input type="file" 
                                                       id="image" 
                                                       name="image"
                                                       class="form-control @error('image') is-invalid @enderror"
                                                       accept="image/jpeg,image/png,image/jpg">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted">Allowed: JPG, JPEG, PNG (Max: 2MB)</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea id="description" 
                                                          name="description" 
                                                          rows="4" 
                                                          maxlength="200"
                                                          class="form-control @error('description') is-invalid @enderror"
                                                          placeholder="Enter event description (optional)">{{ old('description', $event->description) }}</textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @else
                                                    <small class="text-muted"><span id="descCount">0</span>/200 characters (optional)</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    @if ($event->image && $event->image != 'event_image/noimage.jpg')
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <label class="form-label">Current Image</label>
                                            <div class="border p-3 rounded">
                                                <img src="{{ asset($event->image) }}" alt="{{ $event->title }}"
                                                    width="150" class="img-thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Image Preview -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <label class="form-label">New Image Preview</label>
                                            <div id="imagePreview" class="border p-3 rounded d-none">
                                                <img src="" alt="New Event Preview" class="img-thumbnail" style="max-width: 150px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('admin.event.index') }}" class="btn btn-outline-secondary">
                                                    <i class="mdi mdi-close me-1"></i> Cancel
                                                </a>
                                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                                    <i class="mdi mdi-content-save me-1"></i> Update Event
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

    <!-- SweetAlert -->
    <script src="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- App JS -->
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>

    <!-- Custom Scripts -->
    <script>
        $(document).ready(function() {
            // Force status dropdown to be visible
            $('#status').css({
                'display': 'block',
                'visibility': 'visible',
                'opacity': '1'
            });

            // Character counter for description
            function updateDescriptionCount() {
                var length = $('#description').val().length;
                $('#descCount').text(length);
            }

            updateDescriptionCount();
            $('#description').on('input', updateDescriptionCount);

            // Image preview
            $('#image').on('change', function() {
                const file = this.files[0];
                if (file) {
                    // Check file size (2MB limit)
                    if (file.size > 2 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File Too Large',
                            text: 'Image size must be less than 2MB',
                            confirmButtonColor: '#556ee6'
                        });
                        $(this).val('');
                        $('#imagePreview').addClass('d-none');
                        return;
                    }

                    // Check file type
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (!validTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid File Type',
                            text: 'Please upload a valid image file (JPG, JPEG, or PNG)',
                            confirmButtonColor: '#556ee6'
                        });
                        $(this).val('');
                        $('#imagePreview').addClass('d-none');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview img').attr('src', e.target.result);
                        $('#imagePreview').removeClass('d-none');
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreview').addClass('d-none');
                }
            });

            // Price field handling based on event type
            $('#category_id').on('change', function() {
                if ($(this).val() === '0') { // Free event
                    $('#price').val('0.00').prop('readonly', true).addClass('bg-light');
                } else {
                    $('#price').prop('readonly', false).removeClass('bg-light');
                }
            });

            // Trigger on page load if current event is free
            if ($('#category_id').val() === '0') {
                $('#price').prop('readonly', true).addClass('bg-light');
            }

            // Form validation
            $('#eventForm').on('submit', function(e) {
                var status = $('#status').val();
                
                if (!status) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please select an event status',
                        confirmButtonColor: '#556ee6'
                    });
                    return false;
                }
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endsection