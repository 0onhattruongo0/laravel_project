<style>
    @media  all and (max-width: 767px) {
        .navigation-portrait .nav-menu.nav-menu-social>li {
            float: none;
            display: block;
        }
    }

    .top-bar {
        background: #333;
        color: #fff;
        text-align: center;
        padding: 7px 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .top-bar a {
        color: #fff;
        border: 1px dotted #fff;
        padding: 0 5px;
    }
</style>
<div class="top-bar">
    <span>Đang có khuyến mãi lên tới 30%. <a href="https://zalo.me/0367650725" target="_blank">Liên hệ nhận ưu
            đãi</a></span>
</div>
<div class="header header-light">

    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="/">
                    TCNT
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                @if(!empty(Auth::guard('student')->user()->name))
                <ul class="nav-menu nav-menu-social align-to-right">
                    <li class="education_block_author"><span>Xin chào,
                            {{Auth::guard('student')->user()->name}}</span>

                        <ul class="nav-dropdown nav-submenu">

                            <li><a href="/hoc-vien">Thông tin cá nhân</a></li>
                            <li><a href="{{route('students.logout')}}" onclick="return confirm('Bạn chắc chắn muốn đăng xuất?');">Đăng xuất</a></li>

                        </ul>
                    </li>
                </ul>
                @else
                <ul class="nav-menu nav-menu-social align-to-right">
                    <li class="education_block_author"><span>Tài khoản</span>
                        <ul class="nav-dropdown nav-submenu">
                            <li><a href="{{route('students.viewLogin')}}">Đăng nhập</a></li>
                            <li><a href="{{route('students.viewRegister')}}">Đăng ký</a></li>
                        </ul>
                    </li>
                </ul>
                @endif
            </div>
        </nav>
    </div>
</div>