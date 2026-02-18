@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Edit Event | {{ config('app.name') }}</title>
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

        <!-- Date Picker -->
        <link href="{{ url('') }}/dist/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css"
            rel="stylesheet">
        <!-- Time Picker -->
        <link href="{{ url('') }}/dist/assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css"
            rel="stylesheet">
        <!-- Select2 -->
        <link href="{{ url('') }}/dist/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
                                <li class="breadcrumb-item active">Edit Event</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Edit Event: {{ $event->title }}</h4>

                                <form action="{{ route('admin.events.update', $event->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Title -->
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Event Title <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                                    name="title" value="{{ old('title', $event->title) }}" required>
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <!-- Venue -->
                                            <div class="mb-3">
                                                <label for="venue_id" class="form-label">Venue <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2 @error('venue_id') is-invalid @enderror"
                                                    id="venue_id" name="venue_id" required>
                                                    <option value="">Select Venue</option>
                                                    @foreach ($venues as $venue)
                                                        <option value="{{ $venue->id }}"
                                                            {{ old('venue_id', $event->venue_id) == $venue->id ? 'selected' : '' }}>
                                                            {{ $venue->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('venue_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <!-- Category -->
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Category <span
                                                        class="text-danger">*</span></label>
                                                <select
                                                    class="form-control select2 @error('category_id') is-invalid @enderror"
                                                    id="category_id" name="category_id" required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <!-- Event Date -->
                                            <div class="mb-3">
                                                <label for="event_date" class="form-label">Event Date <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    <input type="text"
                                                        class="form-control datepicker @error('event_date') is-invalid @enderror"
                                                        id="event_date" name="event_date"
                                                        value="{{ old('event_date', $event->event_date) }}"
                                                        autocomplete="off" required>
                                                </div>
                                                @error('event_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <!-- Start Time -->
                                            <div class="mb-3">
                                                <label for="start_time" class="form-label">Start Time <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                                                    <input type="text"
                                                        class="form-control timepicker @error('start_time') is-invalid @enderror"
                                                        id="start_time" name="start_time"
                                                        value="{{ old('start_time', $event->start_time) }}"
                                                        autocomplete="off" required>
                                                </div>
                                                @error('start_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <!-- End Time -->
                                            <div class="mb-3">
                                                <label for="end_time" class="form-label">End Time <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                                                    <input type="text"
                                                        class="form-control timepicker @error('end_time') is-invalid @enderror"
                                                        id="end_time" name="end_time"
                                                        value="{{ old('end_time', $event->end_time) }}"
                                                        autocomplete="off" required>
                                                </div>
                                                @error('end_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <!-- Total Tickets -->
                                            <div class="mb-3">
                                                <label for="total_tickets" class="form-label">Total Tickets <span
                                                        class="text-danger">*</span></label>
                                                <input type="number"
                                                    class="form-control @error('total_tickets') is-invalid @enderror"
                                                    id="total_tickets" name="total_tickets"
                                                    value="{{ old('total_tickets', $event->total_tickets) }}"
                                                    min="1" required>
                                                @error('total_tickets')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Is Paid -->
                                            <div class="mb-3">
                                                <label class="form-label">Ticket Type <span
                                                        class="text-danger">*</span></label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="is_paid"
                                                            id="paid_yes" value="1"
                                                            {{ old('is_paid', $event->is_paid) == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="paid_yes">
                                                            Paid
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="is_paid"
                                                            id="paid_no" value="0"
                                                            {{ old('is_paid', $event->is_paid) == '0' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="paid_no">
                                                            Free
                                                        </label>
                                                    </div>
                                                </div>
                                                @error('is_paid')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4" id="price_field"
                                            style="{{ old('is_paid', $event->is_paid) == '1' ? '' : 'display: none;' }}">
                                            <!-- Price -->
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Ticket Price ($)</label>
                                                <input type="number"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    id="price" name="price"
                                                    value="{{ old('price', $event->price) }}" min="0"
                                                    step="0.01">
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <!-- Status -->
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control @error('status') is-invalid @enderror"
                                                    id="status" name="status" required>
                                                    <option value="1"
                                                        {{ old('status', $event->status) == '1' ? 'selected' : '' }}>Active
                                                    </option>
                                                    <option value="2"
                                                        {{ old('status', $event->status) == '2' ? 'selected' : '' }}>
                                                        Upcoming</option>
                                                    <option value="3"
                                                        {{ old('status', $event->status) == '3' ? 'selected' : '' }}>
                                                        Cancelled</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="mb-4">
                                        <label class="form-label">Event Image</label>
                                        <div class="border p-3 rounded">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="{{ $event->image ? asset($event->image) : asset('dist/assets/images/events/default-event.jpg') }}"
                                                        alt="Preview" class="avatar-lg rounded" id="image-preview"
                                                        style="width: 120px; height: 120px; object-fit: cover;"
                                                        onerror="this.onerror=null;this.src='{{ asset('dist/assets/images/events/default-event.jpg') }}';">
                                                </div>
                                                <div class="col">
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="form-control @error('image') is-invalid @enderror"
                                                            id="image" name="image" accept="image/*">
                                                        <small class="text-muted">Upload new event image (JPEG, PNG, JPG,
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
                                            <i class="mdi mdi-content-save me-2"></i> Update Event
                                        </button>
                                        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left me-2"></i> Back to Events
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
    <!-- Include necessary JS libraries -->
    <script src="{{ url('') }}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // ---- Select2 Initialization ----
            if (typeof $ !== "undefined" && $.fn.select2) {
                $('#venue_id, #category_id').select2({
                    placeholder: "Select an option",
                    allowClear: true
                });
            }

            // ---- Datepicker Initialization ----
            if (typeof $ !== "undefined" && $.fn.datepicker) {
                const datepickers = document.querySelectorAll('.datepicker');
                datepickers.forEach(function(dp) {
                    $(dp).datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true,
                        todayHighlight: true,
                        startDate: 'today'
                    });
                });
            }

            // ---- Timepicker Initialization ----
            if (typeof $ !== "undefined" && $.fn.timepicker) {
                const startTimeVal = document.getElementById('start_time').value;
                const endTimeVal = document.getElementById('end_time').value;

                $('#start_time').timepicker({
                    showInputs: false,
                    showMeridian: false,
                    defaultTime: startTimeVal || '09:00'
                });

                $('#end_time').timepicker({
                    showInputs: false,
                    showMeridian: false,
                    defaultTime: endTimeVal || '17:00'
                });
            } else {
                const timepickers = document.querySelectorAll('.timepicker');
                timepickers.forEach(function(tp) {
                    tp.type = 'time';
                    tp.step = 60; // 1 minute steps
                });
            }

            // ---- Paid/Free Toggle ----
            const paidYes = document.getElementById('paid_yes');
            const paidNo = document.getElementById('paid_no');
            const priceField = document.getElementById('price_field');
            const priceInput = document.getElementById('price');

            function togglePriceField() {
                if (!paidYes || !priceField || !priceInput) return;

                if (paidYes.checked) {
                    priceField.style.display = 'block';
                    priceInput.required = true;
                } else {
                    priceField.style.display = 'none';
                    priceInput.required = false;
                    priceInput.value = '';
                }
            }

            togglePriceField();

            if (paidYes) paidYes.addEventListener('change', togglePriceField);
            if (paidNo) paidNo.addEventListener('change', togglePriceField);

            // ---- Image Preview ----
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');

            if (imageInput && imagePreview) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            imagePreview.src = evt.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // ---- Validate End Time ----
            const startTime = document.getElementById('start_time');
            const endTime = document.getElementById('end_time');

            function validateTime() {
                if (startTime.value && endTime.value && startTime.value >= endTime.value) {
                    alert('End time must be after start time');
                    endTime.value = '';
                }
            }

            if (startTime && endTime) {
                startTime.addEventListener('change', validateTime);
                endTime.addEventListener('change', validateTime);
            }
        });
    </script>
@endsection
