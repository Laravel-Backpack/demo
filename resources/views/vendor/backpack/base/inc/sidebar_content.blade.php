<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="nav-icon la la-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

<li class="nav-title">First-Party Addons</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-newspaper-o"></i> News</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('article') }}"><i class="nav-icon la la-newspaper-o"></i> <span>Articles</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i class="nav-icon la la-list"></i> <span>Categories</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('tag') }}"><i class="nav-icon la la-tag"></i> <span>Tags</span></a></li>
    </ul>
</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('page') }}"><i class="nav-icon la la-file-o"></i> <span>Pages</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item') }}"><i class="nav-icon la la-list"></i> <span>Menu</span></a></li>

<!-- Users, Roles Permissions -->
<li class="nav-item nav-dropdown">
  <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-group"></i> Authentication</a>
  <ul class="nav-dropdown-items">
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-group"></i> <span>Roles</span></a></li>
    <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
  </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-cogs"></i> Advanced</a>
    <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>File manager</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('backup') }}"><i class="nav-icon la la-hdd-o"></i> <span>Backups</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('log') }}"><i class="nav-icon la la-terminal"></i> <span>Logs</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('setting') }}"><i class="nav-icon la la-cog"></i> <span>Settings</span></a></li>
    </ul>
</li>

<li class="nav-title">Example CRUDs</li>


<li class="nav-item nav-dropdown">
  <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-optin-monster"></i> Monsters & Stuff</a>
  <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('monster') }}"><i class="nav-icon la la-optin-monster"></i> <span>Monsters</span></a></li>
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('cave') }}'><i class='nav-icon la la-dungeon'></i> Caves <span class="badge badge-pill badge-warning">New</span></a></li>
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('story') }}'><i class='nav-icon la la-book'></i> Stories <span class="badge badge-pill badge-warning">New</span></a></li>
      {{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('hero') }}'><i class='nav-icon la la-mask'></i> Heroes <span class="badge badge-pill badge-warning">New</span></a></li> --}}
  </ul>
</li>

<li class="nav-item nav-dropdown">
  <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-question"></i> Other entities</a>
  <ul class="nav-dropdown-items">
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('icon') }}"><i class="nav-icon la la-info-circle"></i> <span>Icons</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('product') }}"><i class="nav-icon la la-shopping-cart"></i> <span>Products</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('fluent-monster') }}"><i class="nav-icon la la-pastafarianism"></i> <span>Fluent Monsters</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dummy') }}"><i class="nav-icon la la-poo"></i> <span>Dummies</span></a></li>
  </ul>
</li>


<li class="nav-item nav-dropdown">
  <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-dog"></i> Pet Shop <span class="badge badge-pill badge-warning mr-4">New</span></a>
  <ul class="nav-dropdown-items">
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pet-shop/about') }}'><i class='nav-icon la la-question'></i> About</a></li>
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pet-shop/invoice') }}'><i class='nav-icon la la-file-text'></i> Invoices</a></li>
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pet-shop/owner') }}'><i class='nav-icon la la-user'></i> Owners</a></li>
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pet-shop/pet') }}'><i class='nav-icon la la-dog'></i> Pets</a></li>
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pet-shop/badge') }}'><i class='nav-icon la la-certificate'></i> Badges</a></li>
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pet-shop/skill') }}'><i class='nav-icon la la-ribbon'></i> Skills</a></li>
      <li class='nav-item'><a class='nav-link' href='{{ backpack_url('pet-shop/comment') }}'><i class='nav-icon la la-comment'></i> Comments</a></li>
  </ul>
</li>
