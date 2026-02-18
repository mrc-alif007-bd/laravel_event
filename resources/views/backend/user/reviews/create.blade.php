@extends('backend.layouts.master')

@section('head')

    <head>
        <meta charset="utf-8">
        <title>Add Review | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('dist/assets/css/app.min.css') }}" rel="stylesheet">
    </head>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <div class="page-title-box">
                    <h6 class="page-title">Add Review</h6>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.reviews.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Event ID</label>
                                <input type="number" name="event_id" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <select name="rating" class="form-control" required>
                                    <option value="">Select Rating</option>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} Star</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Comment</label>
                                <textarea name="comment" class="form-control" rows="4" maxlength="500"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Submit Review
                            </button>
                            <a href="{{ route('user.reviews.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
