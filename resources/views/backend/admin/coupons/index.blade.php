@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Coupons Management | {{ config('app.name') }}</title>
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

        <!-- DataTables -->
        <link href="{{ url('') }}/dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css"
            rel="stylesheet" type="text/css">
        <link href="{{ url('') }}/dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
            rel="stylesheet" type="text/css">
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
                            <h6 class="page-title">Coupons Management</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Coupons</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                                    <i class="mdi mdi-tag-plus me-2"></i> Add New Coupon
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Total Coupons</p>
                                        <h4 class="mb-0">{{ $coupons->count() }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-tag-multiple font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Active Coupons</p>
                                        <h4 class="mb-0">
                                            {{ $coupons->filter(function ($coupon) {
                                                    return !$coupon->expires_at || $coupon->expires_at->isFuture();
                                                })->count() }}
                                        </h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-check-circle font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">Expired</p>
                                        <h4 class="mb-0">
                                            {{ $coupons->filter(function ($coupon) {
                                                    return $coupon->expires_at && $coupon->expires_at->isPast();
                                                })->count() }}
                                        </h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-clock-outline font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium mb-2">No Expiry</p>
                                        <h4 class="mb-0">
                                            {{ $coupons->filter(function ($coupon) {
                                                    return !$coupon->expires_at;
                                                })->count() }}
                                        </h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-info">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-infinity font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h4 class="card-title">All Coupons</h4>
                                        <p class="card-title-desc">Manage all discount coupons from this panel.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- Filter Dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-filter me-2"></i>Filter
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByType('all')">All Coupons</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByType('active')">Active</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByType('expired')">Expired</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByType('fixed')">Fixed Amount</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByType('percentage')">Percentage</a></li>
                                                </ul>
                                            </div>
                                            <button class="btn btn-info" onclick="refreshTable()">
                                                <i class="mdi mdi-refresh me-2"></i>Refresh
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <table id="coupons-table" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Code</th>
                                            <th>Discount Type</th>
                                            <th>Value</th>
                                            <th>Expires At</th>
                                            <th>Usage Limit</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                            @php
                                                $isExpired = $coupon->expires_at && $coupon->expires_at->isPast();
                                            @endphp
                                            <tr>
                                                <td>{{ $coupon->id }}</td>
                                                <td>
                                                    <span class="badge bg-dark"
                                                        style="font-size: 13px;">{{ $coupon->code }}</span>
                                                </td>
                                                <td>
                                                    @if ($coupon->discount_type == 'percentage')
                                                        <span class="badge bg-info">Percentage</span>
                                                    @else
                                                        <span class="badge bg-primary">Fixed Amount</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($coupon->discount_type == 'percentage')
                                                        <strong>{{ $coupon->value }}%</strong>
                                                    @else
                                                        <strong>${{ number_format($coupon->value, 2) }}</strong>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($coupon->expires_at)
                                                        {{ $coupon->expires_at->format('d M Y') }}<br>
                                                        <small
                                                            class="text-muted">{{ $coupon->expires_at->format('h:i A') }}</small>
                                                    @else
                                                        <span class="badge bg-secondary">No Expiry</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($coupon->usage_limit)
                                                        <span class="badge bg-info">{{ $coupon->usage_limit }}</span>
                                                    @else
                                                        <span class="badge bg-secondary">Unlimited</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($isExpired)
                                                        <span class="badge bg-warning">Expired</span>
                                                    @else
                                                        <span class="badge bg-success">Active</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $coupon->created_at->format('d M Y') }}<br>
                                                    <small
                                                        class="text-muted">{{ $coupon->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit Coupon">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            title="Delete Coupon"
                                                            onclick="deleteCoupon({{ $coupon->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <form id="delete-form-{{ $coupon->id }}"
                                                        action="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this coupon? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('') }}/dist/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/node-waves/waves.min.js"></script>

    <!-- DataTables -->
    <script src="{{ url('') }}/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/jszip/jszip.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('') }}/dist/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

    <script src="{{ url('') }}/dist/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            window.dataTable = $('#coupons-table').DataTable({
                order: [
                    [0, 'desc']
                ],
                pageLength: 25,
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ],
                dom: '<"row"<"col-md-6"B><"col-md-6"f>>rtip',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search coupons..."
                }
            });
        });

        let deleteId = null;

        function deleteCoupon(id) {
            deleteId = id;
            $('#deleteModal').modal('show');
        }

        $('#confirmDelete').on('click', function() {
            if (deleteId) {
                document.getElementById('delete-form-' + deleteId).submit();
            }
        });

        function refreshTable() {
            window.location.reload();
        }

        function filterByType(type) {
            if (type === 'all') {
                window.dataTable.column(2).search('').draw();
            } else if (type === 'active') {
                // Filter active coupons (not expired)
                // This is a simplified approach - you might want to implement custom filtering
                window.dataTable.column(6).search('Active').draw();
            } else if (type === 'expired') {
                window.dataTable.column(6).search('Expired').draw();
            } else if (type === 'fixed') {
                window.dataTable.column(2).search('Fixed').draw();
            } else if (type === 'percentage') {
                window.dataTable.column(2).search('Percentage').draw();
            }
        }
    </script>
@endsection
