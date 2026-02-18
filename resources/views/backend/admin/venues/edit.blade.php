@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Edit Venue | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Edit Venue</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.venues.index') }}">Venues</a></li>
                                <li class="breadcrumb-item active">Edit Venue</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Edit Venue: {{ $venue->name }}</h4>

                                <form action="{{ route('admin.venues.update', $venue->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Name -->
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Venue Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                                    name="name" value="{{ old('name', $venue->name) }}"
                                                    placeholder="Enter venue name" maxlength="50" required>
                                                <small class="text-muted">Maximum 50 characters</small>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- City -->
                                            <div class="mb-3">
                                                <label for="city" class="form-label">City <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('city') is-invalid @enderror" id="city"
                                                    name="city" value="{{ old('city', $venue->city) }}"
                                                    placeholder="Enter city" maxlength="50" required>
                                                <small class="text-muted">Maximum 50 characters</small>
                                                @error('city')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" value="{{ old('address', $venue->address) }}"
                                            placeholder="Enter full address" maxlength="100" required>
                                        <small class="text-muted">Maximum 100 characters</small>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Capacity -->
                                            <div class="mb-3">
                                                <label for="capacity" class="form-label">Capacity <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-account-group"></i></span>
                                                    <input type="number"
                                                        class="form-control @error('capacity') is-invalid @enderror"
                                                        id="capacity" name="capacity"
                                                        value="{{ old('capacity', $venue->capacity) }}"
                                                        placeholder="Maximum number of people" min="1" required>
                                                </div>
                                                @error('capacity')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Status -->
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control @error('status') is-invalid @enderror"
                                                    id="status" name="status" required>
                                                    <option value="">Select Status</option>
                                                    <option value="active"
                                                        {{ old('status', $venue->status) == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="inactive"
                                                        {{ old('status', $venue->status) == 'inactive' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                    <option value="maintenance"
                                                        {{ old('status', $venue->status) == 'maintenance' ? 'selected' : '' }}>
                                                        Under Maintenance</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            rows="4" placeholder="Enter venue description (optional)" maxlength="200">{{ old('description', $venue->description) }}</textarea>
                                        <small class="text-muted">Maximum 200 characters</small>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="mb-4">
                                        <label class="form-label">Venue Image</label>
                                        <div class="border p-3 rounded">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="{{ $venue->image ? asset($venue->image) : url('') }}/dist/assets/images/venues/default-venue.jpg"
                                                        alt="Preview" class="avatar-lg rounded" id="image-preview"
                                                        style="width: 120px; height: 120px; object-fit: cover;">
                                                </div>
                                                <div class="col">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="form-control @error('image') is-invalid @enderror"
                                                            id="image" name="image" accept="image/*">
                                                        <small class="text-muted">Upload new venue image (JPEG, PNG, JPG,
                                                            GIF - max 2MB). Leave empty to keep current image.</small>
                                                        @error('image')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save me-2"></i> Update Venue
                                        </button>
                                        <a href="{{ route('admin.venues.index') }}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left me-2"></i> Back to Venues
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
        $(document).ready(function() {
            // Image preview
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });

            // Character counter for description
            $('#description').on('keyup', function() {
                var length = $(this).val().length;
                var remaining = 200 - length;
                if (remaining < 0) {
                    $(this).val($(this).val().substring(0, 200));
                }
            });
        });
    </script>
@endsection
