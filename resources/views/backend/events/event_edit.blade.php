@extends('backend.layouts.master')

@section('head')
    <head>
        <meta charset="utf-8">
        <title>Edit Event | Veltrix - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">
        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('dist/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
    </head>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">Edit Event</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}">Events</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <h4 class="card-title mb-4">Update Event</h4>

                                <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Event Name <span class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}"
                                            class="form-control @error('title') is-invalid @enderror" maxlength="50" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="venue_id" class="form-label">Venue <span class="text-danger">*</span></label>
                                        <select id="venue_id" name="venue_id" class="form-select @error('venue_id') is-invalid @enderror" required>
                                            <option value="">Select Venue</option>
                                            @foreach ($venues as $venue)
                                                <option value="{{ $venue->id }}"
                                                    {{ (string) old('venue_id', $event->venue_id) === (string) $venue->id ? 'selected' : '' }}>
                                                    {{ $venue->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('venue_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Event Type <span class="text-danger">*</span></label>
                                        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                            <option value="">Select Type</option>
                                            <option value="1" {{ (string) old('category_id', $event->category_id) === '1' ? 'selected' : '' }}>Paid</option>
                                            <option value="0" {{ (string) old('category_id', $event->category_id) === '0' ? 'selected' : '' }}>Not Paid</option>
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price', $event->price) }}"
                                            class="form-control @error('price') is-invalid @enderror" required>
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="">Select Status</option>
                                            <option value="1" {{ (string) old('status', $event->status) === '1' ? 'selected' : '' }}>Upcoming</option>
                                            <option value="2" {{ (string) old('status', $event->status) === '2' ? 'selected' : '' }}>Completed</option>
                                            <option value="3" {{ (string) old('status', $event->status) === '3' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="description" name="description" rows="4" maxlength="200"
                                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $event->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($event->image)
                                            <div class="mt-2">
                                                <img src="{{ asset($event->image) }}" alt="Event Image" width="120" class="img-thumbnail">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('admin.event.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Update Event</button>
                                    </div>
                                </form>
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
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>
@endsection
