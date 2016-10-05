<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{URL::to('css/admin/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{URL::to('css/admin/style.css')}}"/>

        @yield('individual-styles')
    </head>

    <body>
        <div id="master-container" class="master-container">
            <nav id="nav">
                <div class="logo-alas">
                    <span style="color: #fff;">Alas</span><span style="color: #abcff8;">Academy</span>
                </div>
                <div class="nav-section">
                    <div class="title">Academy</div>
                    <div class="option{{ (Request::is('aspirants') ? ' selected' : '') }}" onclick="window.location='{{route('aspirants')}}'">
                        <div class="icon"><img src="{{URL::to('svg/admin/ic_people_outline_black_24px.svg')}}"/></div>
                        <div class="name">Aspirants</div>
                    </div>
                    <div class="option{{ (Request::is('students') ? ' selected' : '') }}" onclick="window.location='{{route('students')}}'">
                        <div class="icon"><img src="{{URL::to('svg/admin/ic_people_black_24px.svg')}}"/></div>
                        <div class="name">Students</div>
                    </div>
                    <div class="option{{ (Request::is('calendar') ? ' selected' : '') }}" onclick="window.location='{{route('calendar')}}'">
                        <div class="icon"><img src="{{URL::to('svg/admin/ic_today_black_24px.svg')}}"/></div>
                        <div class="name">Calendar</div>
                    </div>
                    <div class="option{{ (Request::is('contacts') ? ' selected' : '') }}" onclick="window.location='{{route('contacts')}}'">
                        <div class="icon"><img src="{{URL::to('svg/admin/ic_notifications_black_24px.svg')}}"/></div>
                        <div class="name">Contact</div>
                    </div>
                    <div class="option{{ (Request::is('airplanes') ? ' selected' : '') }}" onclick="window.location='{{route('airplanes')}}'">
                        <div class="icon"><img src="{{URL::to('svg/admin/ic_airplanemode_active_black_24px.svg')}}"/></div>
                        <div class="name">Airplanes </div>
                    </div>
                    <div class="option{{ (Request::is('instructors') ? ' selected' : '') }}" onclick="window.location='{{route('instructors')}}'">
                        <div class="icon"><img src="{{URL::to('svg/admin/ic_record_voice_over_black_24px.svg')}}"/></div>
                        <div class="name">Instructors</div>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="title">System</div>
                    <div class="option" onclick="window.location='{{route('userCrud')}}'">
                        <div class="icon"><img src="{{URL::to('svg/admin/ic_perm_identity_black_24px.svg')}}"/></div>
                        <div class="name">Users</div>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="title">Action</div>
                    <div class="option">
                        <div onclick="window.location='{{route('logout')}}'" class="action-button">Logout</div>
                    </div>
                </div>

            </nav>
            <header id="header">
                <div class="option">
                    <div id="user-account-name" class="name">Frank requena</div>
                    <div class="icon"><img src="{{URL::to('svg/admin/ic_account_circle_black_24px.svg')}}"></div>
                </div>
            </header>
            <div id="content-container" class="content-container">
                <div class="title-view">@yield('title-view')</div>
                @yield('content')
            </div>
        </div>
        <script src="{{URL::to('js/jquery-3.1.1.min.js')}}"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
        <script src="{{URL::to('js/TweenMax.min.js')}}"></script>
        <script src="{{URL::to('js/admin/animations.js')}}"></script>
        <script type="text/javascript">
            $(window).on('load', function () {
               animationForContentConteiner();
            });
        </script>
        @yield('javascript')
    </body>
</html>

