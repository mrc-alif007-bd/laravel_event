@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Venues Management | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Venues Management</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Venues</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <a href="{{ route('admin.venues.create') }}" class="btn btn-primary">
                                    <i class="mdi mdi-plus me-2"></i> Add New Venue
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h4 class="card-title">All Venues</h4>
                                        <p class="card-title-desc">Manage all your event venues from this panel.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button class="btn btn-secondary" onclick="exportTable()">
                                                <i class="mdi mdi-download me-2"></i>Export
                                            </button>
                                            <button class="btn btn-info" onclick="refreshTable()">
                                                <i class="mdi mdi-refresh me-2"></i>Refresh
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <table id="venues-table" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>City</th>
                                            <th>Address</th>
                                            <th>Capacity</th>
                                            <th>Events</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($venues as $venue)
                                            <tr>
                                                <td>{{ $venue->id }}</td>
                                                <td>
                                                    <img src="{{ $venue->image ? asset($venue->image) : url('') }}/dist/assets/images/venues/default-venue.jpg"
                                                        alt="{{ $venue->name }}" class="rounded"
                                                        style="width: 50px; height: 50px; object-fit: cover;"
                                                        onerror="this.onerror=null;this.src='{{ asset('dist/assets/images/events/default-event.jpg') }}';">
                                                </td>
                                                <td>{{ $venue->name }}</td>
                                                <td>{{ $venue->city }}</td>
                                                <td>{{ Str::limit($venue->address, 30) }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-info">{{ number_format($venue->capacity) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $venue->events->count() }}</span>
                                                </td>
                                                <td>
                                                    @if ($venue->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($venue->status == 'inactive')
                                                        <span class="badge bg-warning">Inactive</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $venue->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('admin.venues.show', $venue->id) }}"
                                                            class="btn btn-sm btn-info" title="View Venue">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.venues.edit', $venue->id) }}"
                                                            class="btn btn-sm btn-warning" title="Edit Venue">
                                                            <i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            title="Delete Venue"
                                                            onclick="deleteVenue({{ $venue->id }})">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                    <form id="delete-form-{{ $venue->id }}"
                                                        action="{{ route('admin.venues.destroy', $venue->id) }}"
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
                    Are you sure you want to delete this venue? This action cannot be undone.
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
            $('#venues-table').DataTable({
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
                    searchPlaceholder: "Search venues..."
                }
            });
        });

        let deleteId = null;

        function deleteVenue(id) {
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

        function exportTable() {
            window.location.href = "{{ route('admin.venues.index') }}?export=true";
        }
    </script>
@endsection
