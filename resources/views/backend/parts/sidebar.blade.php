<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('admin.dashboard.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Tổng quan
                </a>
                @can('categories')
                    @include('backend.parts.sidebar_item', [
                        'name' => 'categories',
                        'title' => 'Chuyên mục'
                    ])
                @endcan
                @can('teachers')
                @include('backend.parts.sidebar_item', [
                        'name' => 'teachers',
                        'title' => 'Giảng viên'
                    ])
                @endcan
                @can('courses')
                    @include('backend.parts.sidebar_item', [
                        'name' => 'courses',
                        'title' => 'Khóa học'
                    ])
                @endcan
                @can('users')
                    @include('backend.parts.sidebar_item', [
                        'name' => 'users',
                        'title' => 'Người dùng'
                    ])
                @endcan
                @can('groups')
                    @include('backend.parts.sidebar_item', [
                        'name' => 'groups',
                        'title' => 'Nhóm người dùng'
                    ])
                @endcan
                @can('groups')
                    @include('backend.parts.sidebar_item', [
                        'name' => 'students',
                        'title' => 'Học viên'
                    ])
                @endcan
                @can('groups')
                    @include('backend.parts.sidebar_item', [
                        'name' => 'orders',
                        'title' => 'Đơn hàng'
                    ])
                @endcan
            </div>
        </div>
    </nav>
</div>