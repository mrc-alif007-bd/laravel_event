@extends('backend.layouts.master')

@section('head')
    <head>
        <meta charset="utf-8">
        <title>Edit Event | Veltrix - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
        <meta content="Themesbrand" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset('dist/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

        <!-- SweetAlert CSS -->
        <link href="{{ asset('dist/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
        
        <style>
            /* Force all select elements to be visible */
            select, 
            select.form-select, 
            select.form-control,
            #status,
            select[name="status"] {
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                pointer-events: auto !important;
            }
        </style>
    </head>
@endsection


@section('content')
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Main</li>

                    <li>
                        <a href="{{ route('user.dashboard') }}" class="waves-effect">
                            <i class="ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-title">My Account</li>

                    <li>
                        <a href="{{ route('user.bookings') }}" class="waves-effect">
                            <i class="ti-ticket"></i>
                            <span>My Bookings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection