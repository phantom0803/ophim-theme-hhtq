@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

<header>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <a class="logo" href="/" title="{{ $title }}">
                        @if ($logo)
                            {!! $logo !!}
                        @else
                            {!! $brand !!}
                        @endif
                    </a>
                </div>
                <div class="navbar-menu-toggle" id="navbar-toggle">
                    <i class="icon-menu"></i>
                </div>
            </div>
            <div class="navbar-left" id="navbar-left">
                <div class="navbar-search">
                    <form method="GET" action="/" id="form-search">
                        <div class="search-box">
                            <input type="text" name="search" placeholder="Tìm kiếm tên phim..." autocomplete="off">
                            <i class="icon icon-search"></i>
                        </div>
                    </form>
                </div>
                <div class="navbar-menu" style="">
                    @foreach ($menu as $item)
                        @if(count($item['children']))
                            <li class="navbar-menu-item navbar-menu-has-sub">
                                <a href="javascript:void(0);">
                                    <i class="icon icon-book"></i> {{$item['name']}} </a>
                                <ul class="navbar-submenu">
                                    @foreach ($item['children'] as $children)
                                        <li class="navbar-submenu-item">
                                            <a class="navbar-menu-ditem" href="{{$children['link']}}">{{$children['name']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="navbar-menu-item">
                                <a href="{{$item['link']}}">
                                    <i class="icon icon-chart"></i> {{$item['name']}} </a>
                            </li>
                        @endif
                    @endforeach
                    <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                        <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps-scrollbar-y-rail" style="top: 0px; right: 0px;">
                        <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                    </div>
                </div>
                <div class="navbar-close">
                    <i class="icon-close"></i>
                </div>
                <div class="navbar-brand">
                    <a class="logo" href="/" title="{{ $title }}">
                        @if ($logo)
                            {!! $logo !!}
                        @else
                            {!! $brand !!}
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
