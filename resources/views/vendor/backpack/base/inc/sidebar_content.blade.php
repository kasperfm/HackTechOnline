<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('dashboard') }}"><i class="nav-icon la la-dashboard"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@can('isAdmin')
<li class='nav-item'><a class='nav-link' href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}"><i class="nav-icon la la-terminal"></i> System Logs</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('corporation') }}"><i class="nav-icon la la-users"></i> Corporations</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('bugs') }}"><i class="nav-icon la la-bug"></i> Bugs</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('invite') }}"><i class="nav-icon la la-group"></i> Invites</a></li>
@endcan

@can('isCreator')
    <!-- New content -->
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-gamepad"></i> Game content</a>
        <ul class="nav-dropdown-items">
            <li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-database"></i> <span>Create new server</span></a></li>
        </ul>
    </li>
@endcan

@can('isAdmin')
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
@endcan

