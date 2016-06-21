@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="http://placehold.it/160x160/00a65a/ffffff/&text={{ Auth::user()->name[0] }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

          <li class="treeview">
              <a href="#"><i class="fa fa-newspaper-o"></i> <span>News</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/article') }}"><i class="fa fa-newspaper-o"></i> <span>Articles</span></a></li>
                <li><a href="{{ url('admin/category') }}"><i class="fa fa-list"></i> <span>Categories</span></a></li>
                <li><a href="{{ url('admin/tag') }}"><i class="fa fa-tag"></i> <span>Tags</span></a></li>
              </ul>
          </li>

          <li><a href="{{ url('admin/page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>
          <li><a href="{{ url('admin/menu-item') }}"><i class="fa fa-list"></i> <span>Menu</span></a></li>

          <li class="treeview">
              <a href="#"><i class="fa fa-cogs"></i> <span>Advanced</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ url('admin/elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a></li>
                <li><a href="{{ url('admin/backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>
                <li><a href="{{ url('admin/log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>
                <li><a href="{{ url('admin/setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
              </ul>
          </li>



          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url('admin/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
