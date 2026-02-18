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
                    <a href="{{ route('profile.edit') }}" class="waves-effect">
                        <i class="ti-user"></i>
                        <span>My Profile</span>
                    </a>
                </li>

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
