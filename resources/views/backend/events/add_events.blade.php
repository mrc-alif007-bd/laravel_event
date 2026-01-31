@extends("backend.layouts.master")

@section("head")

<head>
    <meta charset="utf-8">
    <title>Add Event | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.ico') }}">

    <!-- Bootstrap & Icons -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet">
</head>
@endsection

@section("content")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6 class="page-title">Add Event</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Veltrix</a></li>
                            <li class="breadcrumb-item"><a href="#">Forms</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Event</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Event Form</h4>

                            <form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <!-- Category -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-select">
                                            <option disabled selected>Select Category</option>
                                            <option value="1">Paid</option>
                                            <option value="0">Not Paid</option>
                                        </select>
                                        @error('category') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Event Name -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Event Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="Enter event name">
                                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Venue -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Venue</label>
                                    <div class="col-sm-10">
                                        <select name="venue_id" class="form-select">
                                            <option disabled selected>Select Venue</option>
                                            @foreach($venues as $venue)
                                            <option value="{{ $venue->id }}">
                                                {{ $venue->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('venue') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="price" value="{{ old('price') }}" placeholder="Enter price">
                                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description" placeholder="Enter description">{{ old('description') }}</textarea>
                                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-select">
                                            <option disabled selected>Select Status</option>
                                            <option value="1">Up Coming</option>
                                            <option value="2">Completed</option>
                                            <option value="3">Canceled</option>
                                        </select>
                                        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="image">
                                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success w-100">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- page-content -->
</div> <!-- main-content -->
@endsection

@section("scripts")
<script src="{{ url('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>

<script src="{{ url('assets/js/app.js') }}"></script>
@endsection