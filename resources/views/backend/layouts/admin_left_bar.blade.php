<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidebar menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ti-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Profile -->
                <li>
                    <a href="{{ route('admin.profile.edit', Auth::guard('admin')->id()) }}" class="waves-effect">
                        <i class="ti-user"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <!-- Events Menu -->
                <li class="menu-title">Event Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-calendar"></i>
                        <span>Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.events.index') }}"><i class="ti-list"></i> All Events</a></li>
                        <li><a href="{{ route('admin.events.create') }}"><i class="ti-plus"></i> Create Event</a></li>
                    </ul>
                </li>

                <!-- Venues Menu -->
                <li class="menu-title">Venue Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-location-pin"></i>
                        <span>Venues</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.venues.index') }}"><i class="ti-list"></i> All Venues</a></li>
                        <li><a href="{{ route('admin.venues.create') }}"><i class="ti-plus"></i> Create Venue</a></li>
                    </ul>
                </li>

                <!-- Bookings Menu -->
                <li class="menu-title">Booking Management</li>
                <li>
                    <a href="{{ route('admin.bookings.index') }}" class="waves-effect">
                        <i class="ti-ticket"></i>
                        <span>Bookings</span>
                    </a>
                </li>

                <!-- Payments Menu -->
                <li class="menu-title">Payment Management</li>
                <li>
                    <a href="{{ route('admin.payments.index') }}" class="waves-effect">
                        <i class="ti-credit-card"></i>
                        <span>Payments</span>
                    </a>
                </li>

                <!-- Reviews Menu -->
                <li class="menu-title">Review Management</li>
                <li>
                    <a href="{{ route('admin.reviews.index') }}" class="waves-effect">
                        <i class="ti-star"></i>
                        <span>Reviews</span>
                    </a>
                </li>

                <!-- User Management -->
                <li class="menu-title">User Management</li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="waves-effect">
                        <i class="ti-user"></i>
                        <span>Users</span>
                    </a>
                </li>

                <!-- Coupons Menu -->
                <li class="menu-title">Discount Management</li>
                <li>
                    <a href="{{ route('admin.coupons.index') }}" class="waves-effect">
                        <i class="ti-tag"></i>
                        <span>Coupons</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
