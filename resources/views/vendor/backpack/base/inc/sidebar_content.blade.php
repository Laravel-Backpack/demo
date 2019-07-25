{{-- LINE AWESOME / FONT AWESOME --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="nav-icon fa fa-dashboard"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="divider"></li>
<li class="nav-title">Entries</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-question"></i> Demo Entities</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('monster') }}"><i class="nav-icon fa fa-optin-monster"></i> Monsters</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('icon') }}"><i class="nav-icon fa fa-photo"></i> Icons</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('product') }}"><i class="nav-icon fa fa-shopping-cart"></i> Products</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-newspaper-o"></i> News</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon fa fa-newspaper-o"></i> Articles</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i class="nav-icon fa fa-list"></i> Categories</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon fa fa-tag"></i> Tags</a></li>
    </ul>
</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('page') }}"><i class="nav-icon fa fa-file-o"></i> Pages</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item') }}"><i class="nav-icon fa fa-list"></i> Menu</a></li>

<li class="nav-item nav-dropdown">
  <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-group"></i> Users, Roles, Permissions</a>
  <ul class="nav-dropdown-items">
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon fa fa-user"></i> Users</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon fa fa-group"></i> Roles</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon fa fa-key"></i> Permissions</a></li>
  </ul>
</li>

<li class="divider"></li>
<li class="nav-title">Extras</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-cogs"></i> Advanced</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i> File manager</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('backup') }}"><i class="nav-icon fa fa-hdd-o"></i> Backups</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('log') }}"><i class="nav-icon fa fa-terminal"></i> Logs</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('setting') }}"><i class="nav-icon fa fa-cog"></i> Settings</a></li>
    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i> {{ trans('backpack::crud.file_manager') }}</a></li>