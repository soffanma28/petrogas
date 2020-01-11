<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class=nav-item><a class=nav-link href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('item_category') }}'><i class='nav-icon fa fa-question'></i> Item Category</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('item') }}'><i class='nav-icon fa fa-clipboard'></i> Items</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('department') }}'><i class='nav-icon fa fa-building'></i> Departments</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon fa fa-user'></i> Users</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('item_request') }}'><i class='nav-icon fa fa-question'></i> Item_requests</a></li>