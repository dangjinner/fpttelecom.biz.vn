<header id="header" class="header">
    {{--    <div class="header-top">--}}
    {{--        <div class="row row_header-top">--}}
    {{--            <div class="col-lg-8 col-md-8 col-8 no-pad-l">--}}
    {{--                <a href="#" title="Khách hàng cá nhân" class="active">--}}
    {{--                    Khách hàng cá nhân--}}
    {{--                </a>--}}
    {{--                <a href="#" title="Khách hàng doanh nghiệp">--}}
    {{--                    Khách hàng doanh nghiệp--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--            <div class="col-lg-4 col-md-4 col-4 no-pad-r">--}}
    {{--                <a href="#" class="login">--}}
    {{--                    <img src="{{ v(Theme::url('assets/img/icon/user.svg')) }}" alt="Đăng nhập">--}}
    {{--                    Đăng nhập--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- menu desktop -->
    <div class="main_header">
        <div class="box_headmenu">
            <div class="box_logo">
                <a href="/"><img src="{{ $headerLogo->path }}" alt="logo"></a>
            </div>
            <div class="box_menu">
                <ul class="list_menu">
                    @foreach($primaryMenu->menus() as $menuItem)
                        @php
                            $hasSubMenuItem = false;

                            foreach ($menuItem->subMenus() as $subMenu) {
                                if (count($subMenu->items()) > 0) {
                                    $hasSubMenuItem = true;
                                    break;
                                }
                            }
                        @endphp
                        <li class="menu_item @if(!$hasSubMenuItem) other @endif">
                            <a class="item" href="{{ $menuItem->url() }}">{{ $menuItem->name() }}
                                @if(count($menuItem->subMenus()) > 0)
                                    <div class="arrow"></div>
                                @endif
                            </a>
                            @if(count($menuItem->subMenus()) > 0)
                                <div class="sub_menu">
                                    <div class="megamenu_lists ">
                                        @foreach($menuItem->subMenus() as $subMenu)
                                            <ul class="megamenu_list">
                                                @if($hasSubMenuItem)
                                                    <li class="megamenu_title">
                                                        <a href="{{ $subMenu->url() }}"> <span class="icon-sub"><img
                                                                        src="{{ $subMenu->backgroundImage()->path }}"
                                                                        alt="{{ $subMenu->name() }}"></span> <span
                                                                    class="title_sub">{{ $subMenu->name() }}</span></a></li>
                                                @else
                                                    <li><a class="sub-item" href="{{ $subMenu->url() }}">{{ $subMenu->name() }}</a></li>
                                                @endif

                                                @foreach($subMenu->items() as $subMenuItem)
                                                    <li><a class="sub-item" href="{{ $subMenuItem->url() }}">{{ $subMenuItem->name() }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach

                </ul>
            </div>
            <div class="box_shearch">
                <button>
                    <img src="{{ v(Theme::url('assets/img/search-icon.svg')) }}" alt="Tìm kiếm">
                </button>
            </div>
            <form method="GET" action="" accept-charset="UTF-8">
                <span class="nav-search-close-button" tabindex="0">✕</span>
                <div class="nav-search-inner">
                    <input type="text" name="q" maxlength="100" placeholder="Tìm kiếm..." autocomplete="off">
                </div>
            </form>
        </div>
    </div>
    <!-- end menu desktop -->
    <!-- menu mobile -->
    <div class="menu_mb">
        <nav class="navbar box_menu-mb fixed-top">
            <div class="container-fluid">
                <div class="box_shearch">
                    <button>
                        <img src="{{ v(Theme::url('assets/img/search-icon.svg')) }}" alt="Tìm kiếm">
                    </button>
                </div>
                <a class="img-logo" href="#"><img src="{{ v(Theme::url('assets/img/fpt-logo.svg')) }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <form method="GET" action="" accept-charset="UTF-8">
                    <span class="nav-search-close-button" tabindex="0">✕</span>
                    <div class="nav-search-inner">
                        <input type="text" name="q" maxlength="100" placeholder="Tìm kiếm..." autocomplete="off">
                    </div>
                </form>
                <div class="offcanvas offcanvas-start menu_mb-content" tabindex="-1" id="offcanvasNavbar"
                     aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <div class="img-logo">
                            <img src="{{ v(Theme::url('assets/img/fpt-logo.svg')) }} " alt="">
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
{{--                        <div class="box_login">--}}
{{--                            <a href="#" class="login">--}}
{{--                                <img src="{{ v(Theme::url('assets/img/icon/mb_user.svg')) }}" alt="Đăng nhập">--}}
{{--                                Đăng nhập--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <ul class="list_menu-mb">
                            @foreach($primaryMenu->menus() as $index => $menuItem)
                                @php
                                    $hasSubMenuItem = false;

                                    foreach ($menuItem->subMenus() as $subMenu) {
                                        if (count($subMenu->items()) > 0) {
                                            $hasSubMenuItem = true;
                                            break;
                                        }
                                    }
                                @endphp
                                <li class="menu_mb-item @if(!$hasSubMenuItem && count($menuItem->subMenus()) > 0) other @elseif(count($menuItem->subMenus()) == 0) secondary @endif">
                                    @if(count($menuItem->subMenus()) > 0)
                                        <input type="checkbox" name="accordion-1" id="mb{{ $menuItem->id() }}">
                                        <label for="mb{{ $menuItem->id() }}" class="tab__label">{{ $menuItem->name() }}</label>
                                        <div class="tab__content">
                                            <ul class="tab_content-item">
                                                @foreach($menuItem->subMenus() as $subMenu)
                                                    @if(count($subMenu->items()) > 0)
                                                        <li class="tab_title"><a href="{{ $subMenu->url() }}"> <span class="icon-sub"><img
                                                                            src="{{ $subMenu->backgroundImage()->path }}"
                                                                            alt="{{ $subMenu->name() }}"></span> <span
                                                                        class="title_sub">{{ $subMenu->name() }}</span></a></li>
                                                    @else
                                                        <li><a class="sub-item" href="{{ $subMenu->url() }}">{{ $subMenu->name() }}</a></li>
                                                    @endif

                                                    @foreach($subMenu->items() as $subMenuItem)
                                                            <li><a class="sub-item" href="{{ $subMenuItem->url() }}">{{ $subMenuItem->name() }}</a></li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <a href="{{ $menuItem->url() }}">{{ $menuItem->name() }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- end menu mobile -->
</header>