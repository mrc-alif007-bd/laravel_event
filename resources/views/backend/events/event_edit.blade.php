@extends("backend.layouts.master")

@section("head")
<head>
    <meta charset="utf-8">
    <title>Edit Event | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('') }}/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ url('') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ url('') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ url('') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css">
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
                        <h6 class="page-title">Edit Event</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('') }}/#">Veltrix</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('') }}/#">Forms</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Event Edit</li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Event Edit Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Event</h4>

                            <form action="{{ route('event.update', $event->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                <!-- Category -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="category" class="form-select">
                                            <option disabled>Select Category</option>
                                            <option value="1" {{ $event->category_id == 1 ? 'selected' : '' }}>Paid</option>
                                            <option value="0" {{ $event->category_id == 0 ? 'selected' : '' }}>Not Paid</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Event Name -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Event Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" value="{{ old('title', $event->title) }}">
                                    </div>
                                </div>

                                <!-- Venue -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Venue</label>
                                    <div class="col-sm-10">
                                        <select name="venue" class="form-select">
                                            <option disabled>Select Venue</option>
                                            @foreach($venues as $venue)
                                                <option value="{{ $venue->id }}" {{ $event->venue_id == $venue->id ? 'selected' : '' }}>
                                                    {{ $venue->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="price" value="{{ old('price', $event->price) }}">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description">{{ old('description', $event->description) }}</textarea>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-select">
                                            <option disabled>Select Status</option>
                                            <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>Up Coming</option>
                                            <option value="2" {{ $event->status == 2 ? 'selected' : '' }}>Completed</option>
                                            <option value="3" {{ $event->status == 3 ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="image">
                                        @if($event->image)
                                            <img src="{{ asset($event->image) }}" alt="Event Image" class="mt-2" width="150">
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="form-control btn btn-success">Update Event</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section("scripts")
<script src="{{ url('') }}/assets/libs/jquery/jquery.min.js"></script>
<script src="{{ url('') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('') }}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{ url('') }}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{ url('') }}/assets/libs/node-waves/waves.min.js"></script>
<script src="{{ url('') }}/assets/js/app.js"></script>
@endsection
