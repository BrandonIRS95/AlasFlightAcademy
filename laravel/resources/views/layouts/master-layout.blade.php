<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alas Academy</title>
    @include('includes.styles-shared')
    @yield('individual-styles')
</head>
<body>
<div class="Application_container">
    <nav class="Navbar{{ (Request::is('/') ? '--transparent' : '') }}">
        <div class="Navbar__wrapper nav-wrapper"><a href="{{route('index')}}" class="Navbar__logo brand-logo"><span class="Navbar__logo--alas">Alas</span><span class="Navbar__logo--academy">Academy</span></a><a id="menu-button" href="#" data-activates="side-nav" class="Navbar__menu_button button-collapse"><i class="material-icons">menu</i></a>
            <ul class="Navbar__link_list right hide-on-med-and-down">
                <li class="Navbar__item{{ (Request::is('about') ? '--active' : '') }}"><a href="{{route('about')}}" class="Navbar__item_link"><span class="Navbar__item_text">{{ trans('messages.about') }}</span></a></li>
                <li class="Navbar__item{{ (Request::is('pilot-programs') ? '--active' : '') }}"><a href="{{route('pilot-programs')}}" class="Navbar__item_link"><span class="Navbar__item_text">{{ trans('messages.pilot_programs') }}</span></a></li>
                <li class="Navbar__item{{ (Request::is('contact') ? '--active' : '') }}"><a href="{{route('contact')}}" class="Navbar__item_link"><span class="Navbar__item_text">{{ trans('messages.contact') }}</span></a></li>
                <li class="Navbar__item"><a href="#become-pilot" class="Navbar__item_link"><span class="Navbar__item_text">{{ trans('messages.become_a_pilot') }}</span></a></li>
                <li class="Navbar__item{{ (Request::is('enroll') ? '--active' : '') }}"><a href="{{route('enroll')}}" class="Navbar__item_link"><span class="Navbar__item_text">{{ trans('messages.enroll_now') }}</span></a></li>
                <li class="Navbar__item{{ (Request::is('signin') ? '--active' : '') }}"><a href="{{route('signin')}}" class="Navbar__item_link"><span class="Navbar__item_text">{{ trans('messages.signin') }}</span></a></li>
            </ul>
        </div>
    </nav>
    <ul id="side-nav" class="Sidenav__list side-nav">
        <li class="Sidenav__item"><a href="{{route('index')}}" class="Sidenav__item_link"><span class="Sidenav__item_title"> <span class="Sidenav__item_title--alas">Alas</span><span class="Sidenav__item_title--academy">Academy</span></span></a></li>
        <li class="Sidenav__item"><a href="{{route('about')}}" class="Sidenav__item_link"><span class="Sidenav__item_text">About us</span></a></li>
        <li class="Sidenav__item"><a href="{{route('pilot-programs')}}" class="Sidenav__item_link"><span class="Sidenav__item_text">Pilot programs</span></a></li>
        <li class="Sidenav__item"><a href="{{route('contact')}}" class="Sidenav__item_link"><span class="Sidenav__item_text">Contact</span></a></li>
        <li class="Sidenav__item"><a href="#become-pilot" class="Sidenav__item_link"><span class="Sidenav__item_text">Become a pilot</span></a></li>
        <li class="Sidenav__item"><a href="{{route('enroll')}}" class="Sidenav__item_link"><span class="Sidenav__item_text">Enroll Now</span></a></li>
        <li class="Sidenav__item"><a href="{{route('signin')}}" class="Sidenav__item_link"><span class="Sidenav__item_text">Sign in</span></a></li>
    </ul>

    @yield('content')

    <footer class="Footer">
        <ul class="Footer__list">
            <li class="Footer__list_item"><a href="{{route('about')}}" class="Footer__link">About us</a></li>
            <li class="Footer__list_item"><a href="{{route('pilot-programs')}}" class="Footer__link">Pilot programs</a></li>
            <li class="Footer__list_item"><a href="{{route('contact')}}" class="Footer__link">Contact</a></li>
            <li class="Footer__list_item"><a class="Footer__link">Become a pilot</a></li>
            <li class="Footer__list_item"><a href="{{route('signin')}}" class="Footer__link">Sign in</a></li>
            <li class="Footer__list_item"><a href="{{route('enroll')}}" class="Footer__link">Enroll now</a></li>
        </ul>
        <p class="Footer__text"><a href="{{route('index')}}" class="Footer__link">© 2016 Alas Academy</a></p>
    </footer>
</div>
<script src="{{ URL::to('js/vendor.js')}}"></script>
@yield('javascript-functions')
</body>
</html>
