@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>My Reviews | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/assets/css/app.min.css') }}" rel="stylesheet">

        <!-- DataTables -->
        <link href="{{ asset('dist/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    </head>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">My Reviews</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Reviews</li>
                            </ol>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('user.reviews.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Review
                            </a>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Review History</h4>

                        <div class="table-responsive">
                            <table id="reviews-table" class="table table-bordered table-striped dt-responsive nowrap"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Event</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reviews as $index => $review)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $review->event->title ?? 'N/A' }}
                                                <br>
                                                <small class="text-muted">
                                                    {{ $review->event->date ?? '' }}
                                                </small>
                                            </td>
                                            <td>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-muted"></i>
                                                    @endif
                                                @endfor
                                            </td>
                                            <td>{{ $review->comment ?? '—' }}</td>
                                            <td>{{ $review->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <form action="{{ route('user.reviews.destroy', $review) }}" method="POST"
                                                    onsubmit="return confirm('Delete this review?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <h5>No Reviews Found</h5>
                                                <p class="text-muted">You haven't submitted any reviews yet.</p>
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('dist/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#reviews-table').DataTable({
                order: [
                    [4, 'desc']
                ],
                pageLength: 10
            });
        });
    </script>
@endsection
