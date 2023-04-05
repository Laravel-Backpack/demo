<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="nav-icon la la-dashboard d-block d-lg-none d-xl-block"></i> <span>{{ trans('backpack::base.dashboard') }}</span>
    </a>
</li>

@includeWhen(class_exists(\Backpack\DevTools\DevToolsServiceProvider::class), 'backpack.devtools::buttons.sidebar_item')

@if(backpack_theme_config('layout') === 'vertical')
    <li class="nav-separator">First-Party Addons</li>
@endif

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="{{ backpack_theme_config('layout') === 'vertical' ? 'false' : 'true' }}" data-bs-toggle="dropdown" role="button" aria-expanded="true">
        <i class="nav-icon la la-newspaper-o d-block d-lg-none d-xl-block"></i>News
    </a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('article') }}">
            <i class="nav-icon la la-newspaper-o"></i>Articles
        </a>
        <a class="dropdown-item" href="{{ backpack_url('category') }}">
            <i class="nav-icon la la-list"></i>Categories
        </a>
        <a class="dropdown-item" href="{{ backpack_url('tag') }}">
            <i class="nav-icon la la-tag"></i>Tags
        </a>
    </div>
</li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('page') }}">
        <i class="nav-icon la la-file-o d-block d-lg-none d-xl-block"></i> Pages
    </a>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('menu-item') }}">
        <i class="nav-icon la la-list d-block d-lg-none d-xl-block"></i>Menu
    </a>
</li>

<!-- Users, Roles Permissions -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="{{ backpack_theme_config('layout') === 'vertical' ? 'false' : 'true' }}" data-bs-toggle="dropdown" role="button" aria-expanded="true">
        <i class="nav-icon la la-group d-block d-lg-none d-xl-block"></i> Authentication
    </a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('user') }}">
            <i class="nav-icon la la-user"></i>Users
        </a>
        <a class="dropdown-item" href="{{ backpack_url('role') }}">
            <i class="nav-icon la la-group"></i>Roles
        </a>
        <a class="dropdown-item" href="{{ backpack_url('permission') }}">
            <i class="nav-icon la la-key"></i>Permissions
        </a>
    </div>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="{{ backpack_theme_config('layout') === 'vertical' ? 'false' : 'true' }}" data-bs-toggle="dropdown" role="button" aria-expanded="true">
        <i class="nav-icon la la-cogs d-block d-lg-none d-xl-block"></i> Advanced
    </a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('elfinder') }}">
            <i class="nav-icon la la-files-o"></i>File
        </a>
        <a class="dropdown-item" href="{{ backpack_url('backup') }}">
            <i class="nav-icon la la-hdd-o"></i>Backups
        </a>
        <a class="dropdown-item" href="{{ backpack_url('log') }}">
            <i class="nav-icon la la-terminal"></i>Logs
        </a>
        <a class="dropdown-item" href="{{ backpack_url('layout') }}">
            <i class="nav-icon la la-icons"></i>Layouts
        </a>
        <a class="dropdown-item" href="{{ backpack_url('setting') }}">
            <i class="nav-icon la la-cog"></i>Settings
        </a>
    </div>
</li>

@if(backpack_theme_config('layout') === 'vertical')
<li class="nav-separator">Example CRUDs</li>
@endif

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="{{ backpack_theme_config('layout') === 'vertical' ? 'false' : 'true' }}" data-bs-toggle="dropdown" role="button" aria-expanded="true">
        <i class="nav-icon la la-optin-monster d-block d-lg-none d-xl-block"></i> Monsters & Stuff
    </a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('monster') }}">
            <i class="nav-icon la la-optin-monster"></i>Monsters
        </a>
        <a class='dropdown-item' href='{{ backpack_url('cave') }}'>
            <i class='nav-icon la la-dungeon'></i>Caves <span class="badge badge-pill bg-warning">New</span>
        </a>
        <a class='dropdown-item' href='{{ backpack_url('story') }}'>
            <i class='nav-icon la la-book'></i>Stories <span class="badge badge-pill bg-warning">New</span>
        </a>
    </div>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="{{ backpack_theme_config('layout') === 'vertical' ? 'false' : 'true' }}" data-bs-toggle="dropdown" role="button" aria-expanded="true">
        <i class="nav-icon la la-question d-block d-lg-none d-xl-block"></i> Other entities
    </a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href="{{ backpack_url('icon') }}">
            <i class="nav-icon la la-info-circle"></i>Icons
        </a>
        <a class="dropdown-item" href="{{ backpack_url('product') }}">
            <i class="nav-icon la la-shopping-cart"></i> Products
        </a>
        <a class="dropdown-item" href="{{ backpack_url('fluent-monster') }}">
            <i class="nav-icon la la-pastafarianism"></i> Fluent Monsters
        </a>
        <a class="dropdown-item" href="{{ backpack_url('field-monster') }}">
            <i class="nav-icon la la-list-alt"></i> Field Monsters
        </a>
        <a class="dropdown-item" href="{{ backpack_url('editable-monster') }}">
            <i class="nav-icon la la-spell-check"></i> Editable Monsters
        </a>
        <a class="dropdown-item" href="{{ backpack_url('dummy') }}">
            <i class="nav-icon la la-poo"></i>
            Dummies
        </a>
    </div>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-auto-close="{{ backpack_theme_config('layout') === 'vertical' ? 'false' : 'true' }}" data-bs-toggle="dropdown" role="button" aria-expanded="true">
        <i class="nav-icon la la-dog d-block d-lg-none d-xl-block"></i> Pet Shop <span class="badge text-light badge-pill bg-warning">New</span>
    </a>
    <div class="dropdown-menu" data-bs-popper="static">
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/about') }}'>
            <i class='nav-icon la la-question'></i>About
        </a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/invoice') }}'>
            <i class='nav-icon la la-file-text'></i>Invoices
        </a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/owner') }}'>
            <i class='nav-icon la la-user'></i>Owners
        </a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/pet') }}'>
            <i class='nav-icon la la-dog'></i> Pets</a><a class="dropdown-item" href='{{ backpack_url('pet-shop/badge') }}'>
            <i class='nav-icon la la-certificate'></i>Badges
        </a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/skill') }}'>
            <i class='nav-icon la la-ribbon'></i>Skills
        </a>
        <a class="dropdown-item" href='{{ backpack_url('pet-shop/comment') }}'>
            <i class='nav-icon la la-comment'></i>Comments
        </a>
    </div>
</li>
