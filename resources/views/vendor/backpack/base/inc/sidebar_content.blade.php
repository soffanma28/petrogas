<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fas fa-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<!-- <li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon fas fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li> -->
<li class="nav-title">Office Support</li>
<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="#"><i class="la la-lg la-bank"></i> Master</a>
	<ul class="nav-dropdown-items">
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('item_category') }}'><i class='nav-icon fas fa-clipboard'></i> Item Category</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('item') }}'><i class='nav-icon fas fa-clipboard'></i> Items</a></li>
	</ul>
</li>
@if(backpack_user()->can('Request Supply') || backpack_user()->can('Approve Supply'))
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('item_request') }}'><i class='nav-icon fas fa-clipboard-list'></i> Office Supply Requests</a></li>
@endif
@if(backpack_user()->can('Request Admin') || backpack_user()->can('Approve Admin') || backpack_user()->can('Complete Admin'))
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('adminrequest') }}'><i class='nav-icon fas fa-circle-notch'></i> Admin Requests</a></li>
@endif
@role('Super Admin')
<li class="nav-title">Office Management</li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-user-cog"></i> Authentication</a>
	<ul class="nav-dropdown-items">
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon far fa-user"></i> <span>Users</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon fas fa-user-tie"></i> <span>Roles</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon fas fa-key"></i> <span>Permissions</span></a></li>
	</ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('department') }}'><i class='nav-icon far fa-building'></i> Departments</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('employee') }}'><i class='nav-icon fas fa-users'></i> Employees</a></li>
@endrole
