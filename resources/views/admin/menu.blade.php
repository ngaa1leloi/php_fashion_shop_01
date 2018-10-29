<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> {{ __('text.dashboard') }}</a>
            </li>
            <li>
                <a href="admin/category/list"><i class="fa fa-bar-chart-o fa-fw"></i>{{ __('text.category') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/category/list">{{ __('text.list') }}</a>
                    </li>
                    <li>
                        <a href="admin/category/add">{{ __('text.add') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{ route('list_manufacturer') }}"><i class="fa fa-bar-chart-o fa-fw"></i>{{ __('text.manufacturer') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('list_manufacturer') }}">{{ __('text.list') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('add_manufacturer') }}">{{ __('text.add') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-cube fa-fw"></i> {{ __('text.product') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/product/list">{{ __('text.list') }}</a>
                    </li>
                    <li>
                        <a href="admin/product/add">{{ __('text.add') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{ route('list_promotion') }}"><i class="fa fa-cube fa-fw"></i> {{ __('text.promotion') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('list_promotion') }}">{{ __('text.list') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('add_promotion') }}">{{ __('text.add') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{ route('list_slide') }}"><i class="fa fa-bar-chart-o fa-fw"></i>{{ __('text.slide') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('list_slide') }}">{{ __('text.list') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('add_slide') }}">{{ __('text.add') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="{{ route('list_shop') }}"><i class="fa fa-bar-chart-o fa-fw"></i>{{ __('text.shop') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('list_shop') }}">{{ __('text.list') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('add_shop') }}">{{ __('text.add') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-users fa-fw"></i> {{ __('text.user') }}<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/user/list">{{ __('text.list') }}</a>
                    </li>
                    <li>
                        <a href="admin/user/add">{{ __('text.add') }}</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
