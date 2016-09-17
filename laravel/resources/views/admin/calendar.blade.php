@extends('layouts.master-admin')

@section('individual-styles')
    <!--<link rel="shortcut icon" href="../favicon.ico">-->
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/style.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/calendar.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/custom_2.css')}}" />
        <link type="text/css" href="{{URL::to('css/calendar/jquery.jscrollpane.css')}}" rel="stylesheet" media="all" />
    @endsection

@section('title-view')
        Calendar
    @endsection


@section('content')
        <div class="content-calendar">
            <div class="custom-calendar-wrap">
                <div id="custom-inner" class="custom-inner">
                    <div class="custom-header clearfix">
                        <nav>
                            <span id="custom-prev" class="custom-prev"></span>
                            <span id="custom-next" class="custom-next"></span>
                        </nav>
                        <h2 id="custom-month" class="custom-month"></h2>
                        <h3 id="custom-year" class="custom-year"></h3>
                    </div>
                    <div id="calendar" class="fc-calendar-container"></div>
                </div>
            </div>
        </div>

        <div class="content-events">

            <div class="custom-content-reveal" style="top: 0%">
                <h4 id="content-date-selected">EVENTS FOR MAY 01, 2016</h4>
            </div>

            <div id="main-events" class="scroll-pane">
                <div class="events">
                    <div class="event-time">05:30 - 06:00</div>
                    <img src="{{URL::to('images/calendar/plane-icon.png')}}"/>
                    <div class="circle-event-status" style="background: #5fcc88;"></div>
                </div>
                <div class="events">
                    <div class="event-time">07:30 - 08:30</div>
                    <img src="{{URL::to('images/calendar/test-icon.png')}}"/>
                    <div class="circle-event-status"></div>
                </div>
                <div class="events">
                    <div class="event-time">10:30 - 11:00</div>
                    <img src="{{URL::to('images/calendar/test-icon.png')}}"/>
                    <div class="circle-event-status"></div>
                </div>
                <div class="events">
                    <div class="event-time">12:30 - 13:30</div>
                    <img src="{{URL::to('images/calendar/plane-icon.png')}}"/>
                    <div class="circle-event-status" style="background: #5fcc88;"></div>
                </div>
                <div class="events">
                    <div class="event-time">15:30 - 16:00</div>
                    <img src="{{URL::to('images/calendar/plane-icon.png')}}"/>
                    <div class="circle-event-status"></div>
                </div>
                <div class="events">
                    <div class="event-time">17:30 - 18:00</div>
                    <img src="{{URL::to('images/calendar/test-icon.png')}}"/>
                    <div class="circle-event-status" style="background: #5fcc88;"></div>
                </div>
                <div class="events">
                    <div class="event-time">15:30 - 16:00</div>
                    <img src="{{URL::to('images/calendar/plane-icon.png')}}"/>
                    <div class="circle-event-status" style="background: #5fcc88;"></div>
                </div>
                <div class="events">
                    <div class="event-time">17:30 - 18:00</div>
                    <img src="{{URL::to('images/calendar/plane-icon.png')}}"/>
                    <div class="circle-event-status"></div>
                </div>
            </div>

            <div id="content-event-options">
                <div class="content-checkboxs-events">
                    <div class="checkboxs-events"></div>
                    <div class="checkboxs-events-title">Available</div>
                </div>
                <div class="content-checkboxs-events">
                    <div class="checkboxs-events"></div>
                    <div class="checkboxs-events-title">Booked</div>
                </div>
                <div class="content-buttons-event-options">
                    <img src="{{URL::to('images/calendar/test-icon.png')}}"/>
                    <div class="title">Tests</div>
                </div>
                <div class="content-buttons-event-options">
                    <img src="{{URL::to('images/calendar/plane-icon.png')}}"/>
                    <div class="title">Flights</div>
                </div>
            </div>


            <button id="addEventBtn" class="add-button">+</button>

            <div id="content-add-options">
                <div id="content-popup-options">
                    <img id="triangle-box-front" class="triangle-box-front" src="{{URL::to('images/calendar/triangle.png')}}"/>
                    <button id="add-test-btn" class="buttons-options-popup">
                        <img src="{{URL::to('images/calendar/white-test-icon.png')}}"/>
                    </button>
                    <button id="add-flight-btn" class="buttons-options-popup">
                        <img src="{{URL::to('images/calendar/white-plane-icon.png')}}"/>
                    </button>
                </div>
                <img id="triangle-box" class="triangle-box" src="{{URL::to('images/calendar/triangle.png')}}"/>
                <button id="close-add-options" class="add-button">+</button>
            </div>


        </div>
    @endsection

@section('javascript')
        <script type="text/javascript" src="{{URL::to('js/jquery-migrate-1.4.1.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/modernizr.custom.63321.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/TweenMax.min.js')}}"></script>
        <script>
            var routeSvg = '{{URL::to('svg/calendar')}}';
            var routeImages = '{{URL::to('images/calendar')}}';
        </script>
        <script type="text/javascript" src="{{URL::to('js/calendar/resources.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/general-functions.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/jquery.mousewheel.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/jquery.jscrollpane.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/functions-calendario.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/jquery.calendario.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/data.js')}}"></script>
    @endsection