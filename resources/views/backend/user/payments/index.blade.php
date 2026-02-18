@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>My Payments | Veltrix - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

        <!-- DataTables -->
        <link href="{{ asset('dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
            type="text/css">
        <link href="{{ asset('dist/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
            rel="stylesheet" type="text/css">
    </head>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">My Payments</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Payments</li>
                            </ol>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Payment History</h4>

                                <div class="table-responsive">
                                    <table id="payments-table"
                                        class="table table-centered table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Booking ID</th>
                                                <th>Event</th>
                                                <th>Amount</th>
                                                <th>Method</th>
                                                <th>Transaction ID</th>
                                                <th>Status</th>
                                                <th>Paid At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($payments as $index => $payment)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>#{{ $payment->booking_id }}</td>
                                                    <td>
                                                        {{ $payment->booking->event->title ?? 'N/A' }}
                                                        <br>
                                                        <small
                                                            class="text-muted">{{ $payment->booking->event->date ?? '' }}</small>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="fw-bold">${{ number_format($payment->amount, 2) }}</span>
                                                    </td>
                                                    <td>
                                                        @switch($payment->method)
                                                            @case('cash')
                                                                <span class="badge bg-info">Cash</span>
                                                            @break

                                                            @case('card')
                                                                <span class="badge bg-primary">Card</span>
                                                            @break

                                                            @case('bank_transfer')
                                                                <span class="badge bg-secondary">Bank Transfer</span>
                                                            @break

                                                            @default
                                                                <span class="badge bg-secondary">{{ $payment->method }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @if ($payment->transaction_id)
                                                            <span class="text-truncate"
                                                                style="max-width: 100px;">{{ $payment->transaction_id }}</span>
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @switch($payment->status)
                                                            @case('paid')
                                                            @case('completed')
                                                                <span class="badge bg-success">Paid</span>
                                                            @break

                                                            @case('pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                            @break

                                                            @case('failed')
                                                                <span class="badge bg-danger">Failed</span>
                                                            @break

                                                            @case('refunded')
                                                                <span class="badge bg-dark">Refunded</span>
                                                            @break

                                                            @default
                                                                <span class="badge bg-secondary">{{ $payment->status }}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @if ($payment->paid_at)
                                                            {{ $payment->paid_at->format('M d, Y H:i') }}
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('user.payments.show', $payment) }}"
                                                            class="btn btn-sm btn-outline-primary waves-effect"
                                                            data-bs-toggle="tooltip" title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center py-4">
                                                            <div class="empty-state">
                                                                <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                                                                <h5>No Payments Found</h5>
                                                                <p class="text-muted">You haven't made any payments yet.</p>
                                                                <a href="{{ route('user.bookings.index') }}"
                                                                    class="btn btn-primary mt-2">
                                                                    View Bookings
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary Cards -->
                    <div class="row mt-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Total Paid</p>
                                            <h4 class="mb-0">
                                                ${{ number_format($payments->whereIn('status', ['paid', 'completed'])->sum('amount'), 2) }}
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="fas fa-check-circle font-size-24 text-white"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Pending Payments</p>
                                            <h4 class="mb-0">
                                                ${{ number_format($payments->where('status', 'pending')->sum('amount'), 2) }}
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                                <span class="avatar-title">
                                                    <i class="fas fa-clock font-size-24 text-white"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Total Transactions</p>
                                            <h4 class="mb-0">{{ $payments->count() }}</h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-info">
                                                <span class="avatar-title">
                                                    <i class="fas fa-credit-card font-size-24 text-white"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium mb-2">Last Payment</p>
                                            <h4 class="mb-0">
                                                @if ($lastPayment = $payments->sortByDesc('paid_at')->first())
                                                    ${{ number_format($lastPayment->amount, 2) }}
                                                @else
                                                    $0.00
                                                @endif
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                                <span class="avatar-title">
                                                    <i class="fas fa-calendar-check font-size-24 text-white"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('dist/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dist/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('dist/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('dist/assets/libs/node-waves/waves.min.js') }}"></script>

        <!-- DataTables -->
        <script src="{{ asset('dist/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('dist/assets/js/app.js') }}"></script>

        <script>
            $(document).ready(function() {
                // Initialize DataTable if there are records
                if ($('#payments-table tbody tr').length > 1 || $('#payments-table tbody td.empty-state').length ===
                    0) {
                    $('#payments-table').DataTable({
                        order: [
                            [7, 'desc']
                        ], // Sort by paid_at column descending
                        pageLength: 10,
                        language: {
                            emptyTable: "No payment records found",
                            info: "Showing _START_ to _END_ of _TOTAL_ payments",
                            infoEmpty: "Showing 0 to 0 of 0 payments",
                            infoFiltered: "(filtered from _MAX_ total payments)",
                            lengthMenu: "Show _MENU_ payments",
                            search: "Search:",
                            paginate: {
                                first: "First",
                                last: "Last",
                                next: "Next",
                                previous: "Previous"
                            }
                        }
                    });
                }

                // Initialize tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            });
        </script>
    @endsection
