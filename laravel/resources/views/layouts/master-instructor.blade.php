<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{URL::to('css/admin/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{URL::to('css/admin/style.css')}}"/>

        <style>

            #conteiner-calendar-events{
                position: absolute;
                left: 220px;
                top: 75px;
                bottom: 20px;
                right: 20px;
                box-shadow: 0px 5px 5px rgba(0,0,0,0.1);
            }
            
            .backgroundModalProcess {
                z-index: 4000;
                background: rgba(0, 0, 0, 0.62);
                position: fixed;
                left: 0;
                right: 0;
                bottom: 0;
                top: 0;
            }
            
            .airplaneLoadingProcess {
                position: absolute;
                left: -50%;
                top: -50%;
                width: 60px;
                transform: rotate(45deg);
            }
            
            .conteinerAirplaneLoadingProcess, .doneAirplaneLoadingProcess{
                position: absolute;
                width: 60px;
                height: 60px;
                left: 50%;
                transform: translateX(-50%);
            }
            
            .doneAirplaneLoadingProcess{
                width: 150px;
                height: auto;
                top: 20px;
            }

            .conteinerAirplaneLoadingProcess{
                top: 70px;
            }
            
            .textAirplaneLoadingProcess{
                position: absolute;
                color: white;
                font-size: 20px;
                left: 50%;
                text-align: center;
                width: 90%;
                top: 190px;
                transform: translateX(-50%);
            }
            .doneProcessButton{
                background: transparent;
                border: transparent;
                transform: translateX(-50%);
                font-size: 20px;
            }

            .modalAirplaneLoadingProcess{
                position: absolute;
                background: #1784c7;
                height: 240px;
                width: 400px;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                box-shadow: 0 5px 15px rgba(0,0,0,.3);
            }
        </style>
        <link rel="stylesheet" href="{{URL::to('css/sidebar.css')}}"/>
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
                    <div class="option{{ (Request::is('calendar') ? ' selected' : '') }}" onclick="window.location='{{route('calendar')}}'">
                        <div class="icon"><img src="{{URL::to('svg/admin/ic_today_black_24px.svg')}}"/></div>
                        <div class="name">Calendar</div>
                    </div>
                    <div class="option{{ (Request::is('airplanes') ? ' selected' : '') }}" onclick="window.location='{{route('airplanes')}}'">
                        <div class="icon"><img src="{{URL::to('svg/admin/ic_airplanemode_active_black_24px.svg')}}"/></div>
                        <div class="name">Airplanes </div>
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
                <img id="menu-icon" src="{{URL::to('svg/admin/ic_menu_white_48px.svg')}}" alt="">
                <div class="option">
                    <div id="user-account-name" class="name">{{ Auth::user()->person->first_name }} {{ Auth::user()->person->last_name }}</div>
                    <div class="icon"><img src="{{URL::to('svg/admin/ic_account_circle_black_24px.svg')}}"></div>
                </div>
            </header>
            <div id="content-container" class="content-container">
                <div class="title-view">@yield('title-view')</div>
                @yield('content')
            </div>
        </div>
        <script>
            var urlSvgImages = '{{URL::to('svg/')}}';
        </script>
        <script src="{{URL::to('js/jquery-3.1.1.min.js')}}"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="{{URL::to('js/bootstrap.min.js')}}"></script>
        <script src="{{URL::to('js/TweenMax.min.js')}}"></script>
        <script src="{{URL::to('js/sidebar.js')}}"></script>
        <script src="{{URL::to('js/admin/animations.js')}}"></script>
        <script type="text/javascript">
            $(window).on('load', function () {
               animationForContentConteiner();
            });
        </script>
        @yield('javascript')
    </body>
</html>

