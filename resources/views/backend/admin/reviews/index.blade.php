@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Reviews Management | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Reviews Management</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Reviews</li>
                            </ol>
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
                                        <p class="text-muted fw-medium mb-2">Total Reviews</p>
                                        <h4 class="mb-0">{{ $reviews->count() }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-star font-size-24"></i>
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
                                        <p class="text-muted fw-medium mb-2">Average Rating</p>
                                        <h4 class="mb-0">{{ number_format($reviews->avg('rating'), 1) }} / 5</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-star-half font-size-24"></i>
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
                                        <p class="text-muted fw-medium mb-2">5 Star Reviews</p>
                                        <h4 class="mb-0">{{ $reviews->where('rating', 5)->count() }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-star-circle font-size-24"></i>
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
                                        <p class="text-muted fw-medium mb-2">Low Rating (1-2)</p>
                                        <h4 class="mb-0">{{ $reviews->whereIn('rating', [1, 2])->count() }}</h4>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-danger">
                                            <span class="avatar-title">
                                                <i class="mdi mdi-star-off font-size-24"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rating Distribution -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Rating Distribution</h4>
                                @for ($i = 5; $i >= 1; $i--)
                                    @php
                                        $count = $reviews->where('rating', $i)->count();
                                        $percentage = $reviews->count() > 0 ? ($count / $reviews->count()) * 100 : 0;
                                    @endphp
                                    <div class="row align-items-center mb-2">
                                        <div class="col-sm-1">
                                            <span>{{ $i }} <i class="mdi mdi-star text-warning"></i></span>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-{{ $i >= 4 ? 'success' : ($i >= 3 ? 'info' : ($i >= 2 ? 'warning' : 'danger')) }}"
                                                    role="progressbar" style="width: {{ $percentage }}%;"
                                                    aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <span class="text-muted">{{ $count }} reviews</span>
                                        </div>
                                    </div>
                                @endfor
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
                                        <h4 class="card-title">All Reviews</h4>
                                        <p class="card-title-desc">Manage all event reviews from this panel.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- Filter Dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-filter me-2"></i>Filter by Rating
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByRating('all')">All Reviews</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByRating('5')">5 Star</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByRating('4')">4 Star</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByRating('3')">3 Star</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByRating('2')">2 Star</a></li>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="filterByRating('1')">1 Star</a></li>
                                                </ul>
                                            </div>
                                            <button class="btn btn-info" onclick="refreshTable()">
                                                <i class="mdi mdi-refresh me-2"></i>Refresh
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <table id="reviews-table" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>Event</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td>{{ $review->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-xs me-2">
                                                            <span
                                                                class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                {{ substr($review->user->name ?? 'U', 0, 1) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            {{ $review->user->name ?? 'Deleted User' }}<br>
                                                            <small
                                                                class="text-muted">{{ $review->user->email ?? '' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.events.show', $review->event_id) }}"
                                                        class="text-primary">
                                                        {{ Str::limit($review->event->title ?? 'Deleted Event', 30) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="text-warning">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $review->rating)
                                                                <i class="mdi mdi-star"></i>
                                                            @else
                                                                <i class="mdi mdi-star-outline"></i>
                                                            @endif
                                                        @endfor
                                                        <span
                                                            class="ms-1 badge bg-{{ $review->rating >= 4 ? 'success' : ($review->rating >= 3 ? 'info' : ($review->rating >= 2 ? 'warning' : 'danger')) }}">
                                                            {{ $review->rating }}.0
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="d-inline-block text-truncate" style="max-width: 200px;"
                                                        title="{{ $review->comment }}">
                                                        {{ Str::limit($review->comment, 50) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $review->created_at->format('d M Y') }}<br>
                                                    <small
                                                        class="text-muted">{{ $review->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.reviews.show', $review->id) }}"
                                                            class="btn btn-sm btn-info" title="View Review">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            title="Delete Review"
                                                            onclick="deleteReview({{ $review->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <form id="delete-form-{{ $review->id }}"
                                                        action="{{ route('admin.reviews.destroy', $review->id) }}"
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
                    Are you sure you want to delete this review? This action cannot be undone.
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
            window.dataTable = $('#reviews-table').DataTable({
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
                    searchPlaceholder: "Search reviews..."
                }
            });
        });

        let deleteId = null;

        function deleteReview(id) {
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

        function filterByRating(rating) {
            if (rating === 'all') {
                window.dataTable.column(3).search('').draw();
            } else {
                // Clear previous search and search for exact rating
                window.dataTable.column(3).search(rating + '.0', true, false).draw();
            }
        }

        // Add tooltips
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
