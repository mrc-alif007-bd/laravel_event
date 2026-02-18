@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Review Details | {{ config('app.name') }}</title>
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
                            <h6 class="page-title">Review Details</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                                <li class="breadcrumb-item active">Review Details</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <button type="button" class="btn btn-danger" onclick="deleteReview({{ $review->id }})">
                                    <i class="mdi mdi-delete me-2"></i> Delete Review
                                </button>
                                <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-8">
                        <!-- Review Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-md">
                                            <span class="avatar-title bg-soft-primary text-primary rounded-circle"
                                                style="font-size: 1.5rem;">
                                                {{ substr($review->user->name ?? 'U', 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h4 class="mb-1">{{ $review->user->name ?? 'Deleted User' }}</h4>
                                        <p class="text-muted mb-0">{{ $review->user->email ?? '' }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="mdi mdi-star font-size-18"></i>
                                                @else
                                                    <i class="mdi mdi-star-outline font-size-18"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span
                                            class="badge bg-{{ $review->rating >= 4 ? 'success' : ($review->rating >= 3 ? 'info' : ($review->rating >= 2 ? 'warning' : 'danger')) }} font-size-14">
                                            {{ $review->rating }}.0 out of 5
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-3">Review Comment</h5>
                                    <div class="p-3 bg-light rounded">
                                        <p class="mb-0">{{ $review->comment }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><i class="mdi mdi-calendar text-primary me-2"></i>
                                            <strong>Reviewed On:</strong></p>
                                        <p>{{ $review->created_at->format('d M Y, h:i A') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><i class="mdi mdi-update text-primary me-2"></i> <strong>Last
                                                Updated:</strong></p>
                                        <p>{{ $review->updated_at->format('d M Y, h:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Information -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Event Information</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ $review->event->image ? asset($review->event->image) : url('') }}/dist/assets/images/events/default-event.jpg"
                                            alt="{{ $review->event->title }}" class="img-fluid rounded"
                                            style="width: 100%; height: 150px; object-fit: cover;">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>
                                            <a href="{{ route('admin.events.show', $review->event_id) }}"
                                                class="text-primary">
                                                {{ $review->event->title }}
                                            </a>
                                        </h5>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td style="width: 35%;"><i class="mdi mdi-map-marker text-primary me-2"></i>
                                                    Venue:</td>
                                                <td>{{ $review->event->venue->name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-calendar text-primary me-2"></i> Event Date:</td>
                                                <td>{{ date('d M Y', strtotime($review->event->event_date)) }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-clock text-primary me-2"></i> Event Time:</td>
                                                <td>{{ $review->event->start_time }} - {{ $review->event->end_time }}</td>
                                            </tr>
                                            <tr>
                                                <td><i class="mdi mdi-tag text-primary me-2"></i> Category:</td>
                                                <td>
                                                    <span
                                                        class="badge bg-info">{{ $review->event->category->name ?? 'N/A' }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Customer Information -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Customer Information</h5>
                                <div class="text-center mb-3">
                                    <div class="avatar-lg mx-auto mb-3">
                                        <div class="avatar-title bg-soft-primary text-primary rounded-circle"
                                            style="font-size: 2rem;">
                                            {{ substr($review->user->name ?? 'U', 0, 1) }}
                                        </div>
                                    </div>
                                    <h5>{{ $review->user->name ?? 'Deleted User' }}</h5>
                                    <p class="text-muted">Customer ID: #{{ $review->user->id ?? 'N/A' }}</p>
                                </div>
                                <hr>
                                <table class="table table-borderless">
                                    <tr>
                                        <td><i class="mdi mdi-email text-primary me-2"></i> Email:</td>
                                        <td>{{ $review->user->email ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="mdi mdi-phone text-primary me-2"></i> Phone:</td>
                                        <td>{{ $review->user->phone ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="mdi mdi-calendar text-primary me-2"></i> Member Since:</td>
                                        <td>{{ isset($review->user) ? $review->user->created_at->format('d M Y') : 'N/A' }}
                                        </td>
                                    </tr>
                                </table>
                                @if ($review->user)
                                    <div class="mt-3">
                                        <a href="#" class="btn btn-primary btn-sm w-100">
                                            <i class="mdi mdi-account me-2"></i> View Customer Profile
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Review Statistics -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Review Statistics</h5>
                                <div class="mb-4">
                                    <p class="mb-2">Customer's Total Reviews <span
                                            class="float-end">{{ $review->user ? $review->user->reviews->count() : 0 }}</span>
                                    </p>
                                    @if ($review->user && $review->user->reviews->count() > 0)
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <p class="mb-2">Event's Average Rating <span
                                            class="float-end">{{ number_format($review->event->reviews->avg('rating') ?? 0, 1) }}
                                            / 5</span></p>
                                    <div class="progress" style="height: 5px;">
                                        @php
                                            $eventAvg = $review->event->reviews->avg('rating') ?? 0;
                                            $eventPercentage = ($eventAvg / 5) * 100;
                                        @endphp
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $eventPercentage }}%;"></div>
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <p class="mb-2">Event's Total Reviews <span
                                            class="float-end">{{ $review->event->reviews->count() }}</span></p>
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Quick Actions</h5>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-outline-success" onclick="respondToReview()">
                                        <i class="mdi mdi-reply me-2"></i> Respond to Review
                                    </button>
                                    <button class="btn btn-outline-primary" onclick="reportReview()">
                                        <i class="mdi mdi-flag me-2"></i> Report Review
                                    </button>
                                    <button class="btn btn-outline-danger" onclick="deleteReview({{ $review->id }})">
                                        <i class="mdi mdi-delete me-2"></i> Delete Review
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Review Meta Information -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Additional Information</h5>
                                <dl class="row mb-0">
                                    <dt class="col-sm-5">Review ID:</dt>
                                    <dd class="col-sm-7">#{{ $review->id }}</dd>

                                    <dt class="col-sm-5">Created:</dt>
                                    <dd class="col-sm-7">{{ $review->created_at->format('d M Y, h:i A') }}</dd>

                                    <dt class="col-sm-5">Last Updated:</dt>
                                    <dd class="col-sm-7">{{ $review->updated_at->format('d M Y, h:i A') }}</dd>

                                    @if ($review->deleted_at)
                                        <dt class="col-sm-5">Deleted:</dt>
                                        <dd class="col-sm-7">{{ $review->deleted_at->format('d M Y, h:i A') }}</dd>
                                    @endif
                                </dl>
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
    <script src="{{ url('') }}/dist/assets/js/app.js"></script>

    <script>
        let deleteId = {{ $review->id }};

        function deleteReview(id) {
            deleteId = id;
            $('#deleteModal').modal('show');
        }

        $('#confirmDelete').on('click', function() {
            if (deleteId) {
                document.getElementById('delete-form-' + deleteId).submit();
            }
        });

        function respondToReview() {
            // Implement respond to review functionality
            alert('Response functionality will be implemented here');
        }

        function reportReview() {
            // Implement report review functionality
            alert('Review has been reported');
        }

        // Create delete form dynamically if it doesn't exist
        $(document).ready(function() {
            if (!$('#delete-form-{{ $review->id }}').length) {
                $('body').append(`
                    <form id="delete-form-{{ $review->id }}"
                          action="{{ route('admin.reviews.destroy', $review->id) }}"
                          method="POST"
                          style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                `);
            }
        });
    </script>
@endsection
