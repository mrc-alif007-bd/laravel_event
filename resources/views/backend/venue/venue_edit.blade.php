@extends('backend.layouts.master')

@section('head')
    <head>
        <meta charset="utf-8">
        <title>Edit Venue | Veltrix - Admin & Dashboard Template</title>
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
                            <h6 class="page-title">Edit Venue</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.venue.index') }}">Venues</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Venue</li>
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

                                <h4 class="card-title mb-4">Update Venue</h4>

                                <form action="{{ route('admin.venue.update', $venue->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Venue Name <span class="text-danger">*</span></label>
                                        <input type="text" id="name" name="name" value="{{ old('name', $venue->name) }}"
                                            class="form-control @error('name') is-invalid @enderror" maxlength="50" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                        <input type="text" id="address" name="address" value="{{ old('address', $venue->address) }}"
                                            class="form-control @error('address') is-invalid @enderror" maxlength="50" required>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" id="city" name="city" value="{{ old('city', $venue->city) }}"
                                            class="form-control @error('city') is-invalid @enderror" maxlength="50" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="capacity" class="form-label">Capacity <span class="text-danger">*</span></label>
                                        <input type="number" min="1" id="capacity" name="capacity" value="{{ old('capacity', $venue->capacity) }}"
                                            class="form-control @error('capacity') is-invalid @enderror" required>
                                        @error('capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="">Select Status</option>
                                            <option value="active" {{ old('status', $venue->status) === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status', $venue->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea id="description" name="description" rows="4" maxlength="200"
                                            class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $venue->description) }}</textarea>
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
                                        @if ($venue->image)
                                            <div class="mt-2">
                                                <img src="{{ asset($venue->image) }}" alt="Venue Image" width="120" class="img-thumbnail">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('admin.venue.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-primary">Update Venue</button>
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
