<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">

            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" style="width: 50px;" src="{{ asset('admin_assets/img/profile_small.jpg') }}">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">Welcome {{ ucwords(Auth::guard('admin')->user()->username) }}</span>
                        <span class="text-muted text-xs block">
                            {{ get_section_content('project', 'site_title') }}
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    {{ ucwords(Auth::guard('admin')->user()->username) }}
                    <span class="text-muted text-xs block">
                        {{ get_section_content('project', 'short_site_title') }}
                    </span>
                </div>
            </li>

            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="{{ Request::is('admin/users') ? 'active' : '' }} {{ Request::is('admin/users/profile*') ? 'active' : '' }}">
                <a href="{{ url('admin/users') }}"><i class="fa-solid fa-users"></i><span class="nav-label">Users</span></a>
            </li>
            <li class="{{ Request::is('admin/users/reported_users') ? 'active' : '' }} {{ Request::is('admin/users/view_report*') ? 'active' : '' }}">
                <a href="{{ url('admin/users/reported_users') }}"><i class="fa-solid fa-user-slash"></i><span class="nav-label">Reported Users</span></a>
            </li>

            <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
                <a href="{{ url('admin/posts') }}"><i class="fa-sharp fa-solid fa-blog"></i><span class="nav-label">Posts</span></a>
            </li>
            <li class="{{ Request::is('admin/memberships*') ? 'active' : '' }}">
                <a href="{{ url('admin/memberships') }}"><i class="fa-sharp fa-solid fa-address-card"></i><span class="nav-label">Membership List</span></a>
            </li>
            <li class="{{ Request::is('admin/contacts_us*') ? 'active' : '' }}">
                <a href="{{ url('admin/contacts_us') }}"><i class="fa-sharp fa-solid fa-message"></i><span class="nav-label">Contact us</span></a>
            </li>
        </ul>
    </div>
</nav>