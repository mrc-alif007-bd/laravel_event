@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Payments Management | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Payments Management</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Payments</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <button class="btn btn-success" onclick="exportPayments()">
                                    <i class="mdi mdi-download me-2"></i> Export
                                </button>
                                <button class="btn btn-info" onclick="refreshTable()">
                                    <i class="mdi mdi-refresh me-2"></i> Refresh
                                </button>
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
                                        <p class="text-muted fw-medium mb-2">Total Payments</p>
                                        <h4 class="mb-0">{{ $payments->count() }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-cash-multiple font-size-24"></i>
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
                                        <p class="text-muted fw-medium mb-2">Total Revenue</p>
                                        <h4 class="mb-0">
                                            ${{ number_format($payments->where('status', 'completed')->sum('amount'), 2) }}
                                        </h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-currency-usd font-size-24"></i>
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
                                        <p class="text-muted fw-medium mb-2">Completed</p>
                                        <h4 class="mb-0">{{ $payments->where('status', 'completed')->count() }}</h4>
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
                                        <p class="text-muted fw-medium mb-2">Pending</p>
                                        <h4 class="mb-0">{{ $payments->where('status', 'pending')->count() }}</h4>
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
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h4 class="card-title">All Payments</h4>
                                        <p class="card-title-desc">Manage all payment transactions from this panel.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- Filter Dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-filter me-2"></i>Filter by Status
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByStatus('all')">All Payments</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByStatus('completed')">Completed</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByStatus('pending')">Pending</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByStatus('failed')">Failed</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByStatus('refunded')">Refunded</a></li>
                                                </ul>
                                            </div>
                                            <!-- Payment Method Filter -->
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="methodFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-credit-card me-2"></i>Payment Method
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="methodFilter">
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByMethod('all')">All Methods</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByMethod('cash')">Cash</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByMethod('card')">Card</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByMethod('bank_transfer')">Bank Transfer</a>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByMethod('online')">Online Payment</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table id="payments-table" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Transaction ID</th>
                                            <th>Customer</th>
                                            <th>Event</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                            <th>Paid At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-dark">{{ $payment->transaction_id ?? 'N/A' }}</span>
                                                </td>
                                                <td>
                                                    {{ $payment->booking->user->name ?? 'N/A' }}<br>
                                                    <small
                                                        class="text-muted">{{ $payment->booking->user->email ?? '' }}</small>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.events.show', $payment->booking->event_id) }}"
                                                        class="text-primary">
                                                        {{ Str::limit($payment->booking->event->title ?? 'N/A', 30) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <strong>${{ number_format($payment->amount, 2) }}</strong>
                                                </td>
                                                <td>
                                                    @switch($payment->method)
                                                        @case('cash')
                                                            <span class="badge bg-primary">Cash</span>
                                                        @break

                                                        @case('card')
                                                            <span class="badge bg-info">Card</span>
                                                        @break

                                                        @case('bank_transfer')
                                                            <span class="badge bg-secondary">Bank Transfer</span>
                                                        @break

                                                        @case('online')
                                                            <span class="badge bg-success">Online</span>
                                                        @break

                                                        @default
                                                            <span class="badge bg-dark">{{ $payment->method }}</span>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    @switch($payment->status)
                                                        @case('completed')
                                                            <span class="badge bg-success">Completed</span>
                                                        @break

                                                        @case('pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @break

                                                        @case('failed')
                                                            <span class="badge bg-danger">Failed</span>
                                                        @break

                                                        @case('refunded')
                                                            <span class="badge bg-info">Refunded</span>
                                                        @break

                                                        @default
                                                            <span class="badge bg-secondary">{{ $payment->status }}</span>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    @if ($payment->paid_at)
                                                        {{ $payment->paid_at->format('d M Y') }}<br>
                                                        <small
                                                            class="text-muted">{{ $payment->paid_at->format('h:i A') }}</small>
                                                    @else
                                                        <span class="badge bg-warning">Not Paid</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.payments.show', $payment->id) }}"
                                                            class="btn btn-sm btn-info" title="View Payment">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            title="Delete Payment"
                                                            onclick="deletePayment({{ $payment->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <form id="delete-form-{{ $payment->id }}"
                                                        action="{{ route('admin.payments.destroy', $payment->id) }}"
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
                    Are you sure you want to delete this payment record? This action cannot be undone.
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
            window.dataTable = $('#payments-table').DataTable({
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
                    searchPlaceholder: "Search payments..."
                }
            });
        });

        let deleteId = null;

        function deletePayment(id) {
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

        function exportPayments() {
            window.location.href = "{{ route('admin.payments.index') }}?export=true";
        }

        function filterByStatus(status) {
            if (status === 'all') {
                window.dataTable.column(6).search('').draw();
            } else {
                window.dataTable.column(6).search(status).draw();
            }
        }

        function filterByMethod(method) {
            if (method === 'all') {
                window.dataTable.column(5).search('').draw();
            } else {
                window.dataTable.column(5).search(method).draw();
            }
        }
    </script>
@endsection
