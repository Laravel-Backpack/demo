<!-- This file is used to store topbar (left) items -->

{{--<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-cogs"></i> Dropdown<span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li class="">
            <a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">
                <i class="fa fa-list"></i> Dropdown Item
            </a>
        </li>
        <li class="">
            <a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">
                <i class="fa fa-list"></i> Dropdown Item
            </a>
        </li>
    </ul>
</li>

<li class="">
    <a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">
        <i class="fa fa-cog"></i> Direct Link
    </a>
</li>--}}

<ul class="nav navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> 
            4.1 
            <span class="badge badge-pill badge-warning ml-2">New</span>
        </a>
        <div class="dropdown-menu">
            <div class="dropdown-header"><strong>Documentation</strong></div>
            <a class="dropdown-item" href="https://backpackforlaravel.com/docs/4.1/release-notes">Release Notes</a>
            <a class="dropdown-item" href="https://backpackforlaravel.com/docs/4.1/upgrade-guide">Upgrade Guide</a>
            <a class="dropdown-item" href="https://backpackforlaravel.com/docs/4.1/installation">Installation</a>

            <div class="dropdown-header"><strong>PRs</strong></div>
            <a class="dropdown-item" href="https://github.com/Laravel-Backpack/CRUD/pull/2508">Backpack\CRUD</a>
            <a class="dropdown-item mb-2" href="https://github.com/Laravel-Backpack/demo/pull/134">Backpack\Demo</a>
        </div>
    </li>
</ul>
