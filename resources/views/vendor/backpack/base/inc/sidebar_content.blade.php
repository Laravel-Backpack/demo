<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="nav-icon fs-2 me-2 la la-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span>
    </a>
</li>

@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

<li class="nav-separator">First-Party Addons</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="true"><i class="nav-icon fs-2 me-2 la la-newspaper-o"></i> News</a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('article') }}"><i class="nav-icon fs-2 me-2 la la-newspaper-o"></i> <span>Articles</span></a>
        <a class="dropdown-item" href="{{ backpack_url('category') }}"><i class="nav-icon fs-2 me-2 la la-list"></i> <span>Categories</span></a>
        <a class="dropdown-item" href="{{ backpack_url('tag') }}"><i class="nav-icon fs-2 me-2 la la-tag"></i> <span>Tags</span></a>
    </div>
</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('page') }}"><i class="nav-icon fs-2 me-2 la la-file-o"></i> <span>Pages</span></a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item') }}"><i class="nav-icon fs-2 me-2 la la-list"></i> <span>Menu</span></a></li>

<!-- Users, Roles Permissions -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="true"><i class="nav-icon fs-2 me-2 la la-group"></i> Authentication</a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('user') }}"><i class="nav-icon fs-2 me-2 la la-user"></i> <span>Users</span></a>
        <a class="dropdown-item" href="{{ backpack_url('role') }}"><i class="nav-icon fs-2 me-2 la la-group"></i> <span>Roles</span></a>
        <a class="dropdown-item" href="{{ backpack_url('permission') }}"><i class="nav-icon fs-2 me-2 la la-key"></i> <span>Permissions</span></a>
    </div>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="true"><i class="nav-icon fs-2 me-2 la la-cogs"></i> Advanced</a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('elfinder') }}"><i class="nav-icon fs-2 me-2 la la-files-o"></i> <span>File manager</span></a>
        <a class="dropdown-item" href="{{ backpack_url('backup') }}"><i class="nav-icon fs-2 me-2 la la-hdd-o"></i> <span>Backups</span></a>
        <a class="dropdown-item" href="{{ backpack_url('log') }}"><i class="nav-icon fs-2 me-2 la la-terminal"></i> <span>Logs</span></a>
        <a class="dropdown-item" href="{{ backpack_url('setting') }}"><i class="nav-icon fs-2 me-2 la la-cog"></i> <span>Settings</span></a>
    </div>
</li>

<li class="nav-separator">Example CRUDs</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="true"><i class="nav-icon fs-2 me-2 la la-optin-monster"></i> Monsters & Stuff</a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('monster') }}"><i class="nav-icon fs-2 me-2 la la-optin-monster"></i> <span>Monsters</span></a>
        <a class='dropdown-item' href='{{ backpack_url('cave') }}'><i class='nav-icon la la-dungeon'></i> Caves <span class="badge badge-pill bg-warning">New</span></a>
        <a class='dropdown-item' href='{{ backpack_url('story') }}'><i class='nav-icon la la-book'></i> Stories <span class="badge badge-pill bg-warning">New</span></a>
    </div>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="true"><i class="nav-icon fs-2 me-2 la la-question"></i> Other entities</a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('icon') }}"><i class="nav-icon fs-2 me-2 la la-info-circle"></i> <span>Icons</span></a>
        <a class="dropdown-item" href="{{ backpack_url('product') }}"><i class="nav-icon fs-2 me-2 la la-shopping-cart"></i> <span>Products</span></a>
        <a class="dropdown-item" href="{{ backpack_url('fluent-monster') }}"><i class="nav-icon fs-2 me-2 la la-pastafarianism"></i> <span>Fluent Monsters</span></a>
        <a class="dropdown-item" href="{{ backpack_url('field-monster') }}"><i class="nav-icon fs-2 me-2 la la-list-alt"></i> <span>Field Monsters</span></a>
        <a class="dropdown-item" href="{{ backpack_url('editable-monster') }}"><i class="nav-icon fs-2 me-2 la la-spell-check"></i> <span>Editable Monsters</span></a>
        <a class="dropdown-item" href="{{ backpack_url('dummy') }}"><i class="nav-icon fs-2 me-2 la la-poo"></i> <span>Dummies</span></a>
    </div>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="true">
        <i class="nav-icon fs-2 me-2 la la-dog"></i> Pet Shop <span class="badge text-light badge-pill bg-warning">New</span>
    </a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/about') }}'><i class='nav-icon la la-question'></i> About</a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/invoice') }}'><i class='nav-icon la la-file-text'></i> Invoices</a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/owner') }}'><i class='nav-icon la la-user'></i> Owners</a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/pet') }}'><i class='nav-icon la la-dog'></i> Pets</a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/badge') }}'><i class='nav-icon la la-certificate'></i> Badges</a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/skill') }}'><i class='nav-icon la la-ribbon'></i> Skills</a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/comment') }}'><i class='nav-icon la la-comment'></i> Comments</a>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('elfinder') }}">
        <i class="nav-icon fs-2 me-2 la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span>
    </a>
</li>