@extends("backend.layouts.master")

@section("head")
<head>
    <meta charset="utf-8">
    <title>Add Venue | Veltrix - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                <h6 class="page-title">Add Venue</h6>
            </div>

            <!-- Form Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Venue</h4>

                            <form action="{{ route('venue.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Venue Name -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Venue Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="address">{{ old('address') }}</textarea>
                                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- City -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <select name="city" class="form-select">
                                            <option disabled selected>Select city</option>
                                            <option value="dhaka" >Dhaka</option>
                                            <option value="rajshahi" >Rajshahi</option>
                                            <option value="khulna" >Khulna</option>
                                        </select>
                                        @error('city') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Capacity -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Capacity</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="capacity" value="{{ old('capacity') }}">
                                        @error('capacity') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-select">
                                            <option disabled selected>Select status</option>
                                            <option value="active" >Active</option>
                                            <option value="inactive" >Inactive</option>
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
