<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('admin.dashboard.index')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Tổng quan
                </a>
                @include('backend.parts.sidebar_item', [
                    'name' => 'categories',
                    'title' => 'Chuyên mục'
                ])
                @include('backend.parts.sidebar_item', [
                    'name' => 'courses',
                    'title' => 'Khóa học'
                ])
                @include('backend.parts.sidebar_item', [
                    'name' => 'teachers',
                    'title' => 'Giảng viên'
                ])
                @include('backend.parts.sidebar_item', [
                    'name' => 'users',
                    'title' => 'Người dùng'
                ])
            </div>
        </div>
    </nav>
</div>