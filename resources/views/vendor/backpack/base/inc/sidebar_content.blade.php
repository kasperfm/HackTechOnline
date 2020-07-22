<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('dashboard') }}"><i class="nav-icon fa fa-dashboard"></i> {{ trans('backpack::base.dashboard') }}</a></li>


<li class='nav-item'><a class='nav-link' href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}"><i class="nav-icon fa fa-terminal"></i> System Logs</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('corporation') }}"><i class="nav-icon fa fa-users"></i> Corporations</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('bugs') }}"><i class="nav-icon fa fa-bug"></i> Bugs</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('invite') }}"><i class="nav-icon fa fa-group"></i> Invites</a></li>


@role('admin')
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
@endrole