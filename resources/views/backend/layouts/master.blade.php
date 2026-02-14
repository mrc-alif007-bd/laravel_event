<!DOCTYPE html>
<html lang="en">

@yield("head")

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        @if(Auth::guard('web')->check())
        @include ("backend.layouts.header")
        @elseif(Auth::guard('admin')->check())
        @include ("backend.layouts.admin_header")

        @endif

        <!-- ========== Topbar End ========== -->


        <!-- ========== Left Sidebar Start ========== -->
        @if(Auth::guard('web')->check())
        @include ("backend.layouts.left_bar")
        @elseif(Auth::guard('admin')->check())
        @include ("backend.layouts.admin_left_bar")

        @endif


        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        @yield("content")

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->


    {{-- @include ("backend.layouts.footer") --}}

    @yield("scripts")

</body>

</html>