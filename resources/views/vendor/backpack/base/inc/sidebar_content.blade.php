<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}'><i class='fa fa-terminal'></i> <span>System Logs</span></a></li>
<li><a href='{{ backpack_url('corporation') }}'><i class='fa fa-users'></i> <span>Corporations</span></a></li>
<li><a href='{{ backpack_url('bug') }}'><i class='fa fa-bug'></i> <span>Bugs</span></a></li>
<li><a href='{{ backpack_url('invite') }}'><i class='fa fa-group'></i> <span>Invites</span></a></li>