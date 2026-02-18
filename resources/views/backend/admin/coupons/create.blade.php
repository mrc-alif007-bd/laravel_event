@extends('backend.layouts.master')

@section('head')
    <head>
        <meta charset="utf-8">
        <title>Create Coupon | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('') }}/dist/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{ url('') }}/dist/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ url('') }}/dist/assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ url('') }}/dist/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">

        <!-- Date Picker -->
        <link href="{{ url('') }}/dist/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
                            <h6 class="page-title">Create Coupon</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Coupons</a></li>
                                <li class="breadcrumb-item active">Create Coupon</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Create New Coupon</h4>

                                <form action="{{ route('admin.coupons.store') }}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Coupon Code -->
                                            <div class="mb-3">
                                                <label for="code" class="form-label">Coupon Code <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-tag"></i></span>
                                                    <input type="text"
                                                           class="form-control @error('code') is-invalid @enderror"
                                                           id="code"
                                                           name="code"
                                                           value="{{ old('code') }}"
                                                           placeholder="e.g., SUMMER2024"
                                                           maxlength="20"
                                                           required>
                                                </div>
                                                <small class="text-muted">Maximum 20 characters. Use uppercase letters for consistency.</small>
                                                @error('code')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Discount Type -->
                                            <div class="mb-3">
                                                <label for="discount_type" class="form-label">Discount Type <span class="text-danger">*</span></label>
                                                <select class="form-control @error('discount_type') is-invalid @enderror"
                                                        id="discount_type"
                                                        name="discount_type"
                                                        required>
                                                    <option value="">Select Type</option>
                                                    <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                                                    <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                                </select>
                                                @error('discount_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Value -->
                                            <div class="mb-3">
                                                <label for="value" class="form-label">Discount Value <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="value-symbol">$</span>
                                                    <input type="number"
                                                           class="form-control @error('value') is-invalid @enderror"
                                                           id="value"
                                                           name="value"
                                                           value="{{ old('value') }}"
                                                           placeholder="Enter discount value"
                                                           min="1"
                                                           step="0.01"
                                                           required>
                                                </div>
                                                @error('value')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Usage Limit -->
                                            <div class="mb-3">
                                                <label for="usage_limit" class="form-label">Usage Limit</label>
                                                <input type="number"
                                                       class="form-control @error('usage_limit') is-invalid @enderror"
                                                       id="usage_limit"
                                                       name="usage_limit"
                                                       value="{{ old('usage_limit') }}"
                                                       placeholder="Leave empty for unlimited"
                                                       min="1">
                                                <small class="text-muted">Maximum number of times this coupon can be used</small>
                                                @error('usage_limit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Expiration Date -->
                                            <div class="mb-3">
                                                <label for="expires_at" class="form-label">Expiration Date</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                    <input type="text"
                                                           class="form-control datepicker @error('expires_at') is-invalid @enderror"
                                                           id="expires_at"
                                                           name="expires_at"
                                                           value="{{ old('expires_at') }}"
                                                           placeholder="YYYY-MM-DD"
                                                           autocomplete="off">
                                                </div>
                                                <small class="text-muted">Leave empty for no expiration</small>
                                                @error('expires_at')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Preview -->
                                            <div class="mb-3">
                                                <label class="form-label">Preview</label>
                                                <div class="border p-3 rounded bg-light" id="preview-area">
                                                    <div class="text-center">
                                                        <span class="badge bg-dark" id="preview-code" style="font-size: 16px;">COUPON</span>
                                                        <div class="mt-2" id="preview-value"></div>
                                                        <small class="text-muted" id="preview-expiry"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-tag-plus me-2"></i> Create Coupon
                                        </button>
                                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">
                                            <i class="mdi mdi-arrow-left me-2"></i> Back to Coupons
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

    <!-- Date Picker -->
    <script src="{{ url('') }}/dist/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script src="{{ url('') }}/dist/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Datepicker
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                startDate: 'today'
            });

            // Update symbol based on discount type
            $('#discount_type').on('change', function() {
                const type = $(this).val();
                if (type === 'percentage') {
                    $('#value-symbol').text('%');
                    $('#value').attr('step', '1');
                } else {
                    $('#value-symbol').text('$');
                    $('#value').attr('step', '0.01');
                }
                updatePreview();
            });

            // Update preview on input changes
            $('#code, #discount_type, #value, #expires_at').on('keyup change', function() {
                updatePreview();
            });

            function updatePreview() {
                const code = $('#code').val() || 'COUPON';
                const type = $('#discount_type').val();
                const value = $('#value').val();
                const expiresAt = $('#expires_at').val();

                $('#preview-code').text(code.toUpperCase());

                if (type && value) {
                    if (type === 'percentage') {
                        $('#preview-value').html(`<strong>${value}% OFF</strong>`);
                    } else {
                        $('#preview-value').html(`<strong>$${parseFloat(value).toFixed(2)} OFF</strong>`);
                    }
                } else {
                    $('#preview-value').html('<span class="text-muted">Enter discount value</span>');
                }

                if (expiresAt) {
                    $('#preview-expiry').text(`Expires: ${expiresAt}`);
                } else {
                    $('#preview-expiry').text('No expiration');
                }
            }

            // Auto-uppercase coupon code
            $('#code').on('input', function() {
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
@endsection