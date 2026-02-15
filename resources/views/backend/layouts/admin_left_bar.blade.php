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

                <!-- Category Menu with Create Link -->
                <li class="menu-title">Category Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-folder"></i>
                        <span>Categories</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.category.index') }}"><i class="ti-list"></i> All Event Types</a>
                        </li>
                        <li><a href="{{ route('admin.category.create') }}"><i class="ti-plus"></i> Create Event Type</a>
                        </li>
                    </ul>
                </li>

                <!-- Events Menu with Create Link -->
                <li class="menu-title">Event Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-calendar"></i>
                        <span>Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.event.index') }}"><i class="ti-list"></i> All Events</a></li>
                        <li><a href="{{ route('admin.event.create') }}"><i class="ti-plus"></i> Create Event</a></li>
                    </ul>
                </li>

                <!-- Venues Menu with Create Link -->
                <li class="menu-title">Venue Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-location-pin"></i>
                        <span>Venues</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.venue.index') }}"><i class="ti-list"></i> All Venues</a></li>
                        <li><a href="{{ route('admin.venue.create') }}"><i class="ti-plus"></i> Create Venue</a></li>
                    </ul>
                </li>

                <!-- Bookings Menu -->
                <li class="menu-title">Booking Management</li>
                <li>
                    <a href="{{ route('admin.booking.index') }}" class="waves-effect">
                        <i class="ti-ticket"></i>
                        <span>Bookings</span>
                    </a>
                </li>

                <li class="menu-title">User Management</li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="waves-effect">
                        <i class="ti-user"></i>
                        <span>Users</span>
                    </a>
                </li>

                <!-- Reports Section (Optional) -->
                <li class="menu-title">Reports</li>
                {{-- <li>
                    <a href="{{ route('admin.reports') }}" class="waves-effect">
                        <i class="ti-bar-chart"></i>
                        <span>Reports</span>
                    </a>
                </li> --}}

                <!-- Settings (Optional) -->
                <li class="menu-title">Settings</li>
                {{-- <li>
                    <a href="{{ route('admin.settings') }}" class="waves-effect">
                        <i class="ti-settings"></i>
                        <span>Settings</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
