@extends('layouts.master-admin')

@section('individual-styles')
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/calendar.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/custom_1.css')}}" />
        {{--<link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/jquery.jscrollpane.css')}}" />--}}
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/jquery-ui.min.css')}}" />
        <script src="{{URL::to('js/calendar/modernizr.custom.63321.js')}}"></script>
        <!-- Calendar -->
        <style>
            body {
                background: #cdd8e2;
            }

            .title-view{
                display: none;
            }

            .cd-main-content .content-wrapper{
                padding: 0;
                padding-top: 55px;
                height: 100vh;
                position: relative;
            }

            .container{
                position: relative;
                float: left;
                width: 63%;
                height: 100%;
                background: #fff;
            }

            .custom-calendar-full{
                top:0px;
            }

            .custom-header h3{
                padding-right: 0px;
                text-align: left;
            }

            .fc-calendar-container{
                top:130px;
            }

            .fc-calendar .fc-head{
                background: none;
                box-shadow: none;
                color: #c2cdd7;
            }

            .fc-calendar .fc-head > div{
                text-shadow: none;
                font-size: 30px;
                font-weight: 400;
                letter-spacing: 0;
            }

            .fc-calendar .fc-row > div > span.fc-date{
                text-shadow: none;
                text-align: center;
                position: absolute;
                top:50%;
                left:50%;
                transform: translate(-50%,-50%);
                color: #a4afb9;

                font-weight: 400;

            }

            .fc-calendar .fc-row > div{
                box-shadow: none;
            }

            .fc-calendar .fc-row{
                box-shadow: none;
            }

            .custom-header h2, .custom-header h3{
                text-shadow: none;
            }

            .fc-calendar{
                background: none;
            }

            .custom-month{
                color: #87939e;
                font-size: 45px;
                letter-spacing: 0;
                text-transform: none;
                font-weight: 400;
            }

            .custom-year{
                font-size: 35px;
                color: #b8c3cd;
                font-weight: 400;
                letter-spacing: 0;
            }

            .fc-calendar .fc-row > div > span.fc-emptydate{
                opacity: 0.5;
            }

            .custom-header {
                height: 100px;
                padding:0 40px;

            }

            .vertical-center{
                position: absolute;
                top:50%;
                transform: translateY(-50%);
            }

            #conteiner-nav-calendar{
                right: 55px;
            }

            #conteiner-nav-calendar div {
                position: relative;
                float: left;
                font-size: 50px;
            }


            #content-events{
                position: relative;
                float: left;
                width: 37%;
                height: 100%;
                background: #011a35;
            }

            #custom-next, #custom-prev{
                margin-right: 10px;
                margin-top: 8px;
                color: #cdd8e2;
                -webkit-user-select: none;  /* Chrome all / Safari all */
                -moz-user-select: none;     /* Firefox all */
                -ms-user-select: none;      /* IE 10+ */
                user-select: none;
            }

            #custom-next, #custom-prev, #custom-current{
                cursor: pointer;
            }

            #custom-next{
                margin-right: 25px;
            }

            .fc-calendar .fc-row > div.fc-today{
                background: #1784c7;
                border-radius: 5px;
                color: #fff;
            }

            .fc-calendar .fc-row > div.fc-today:after{
                background: none;
                opacity: 1;
            }

            .fc-calendar .fc-row > div.fc-today > span.fc-date{
                color: #fff;
            }

            /*.fc-calendar .fc-row > div.fc-content:after {
                content: '\00B7';
                text-align: center;
                width: 20px;
                margin-left: -10px;
                position: absolute;
                color: #DDD;
                font-size: 70px;
                line-height: 20px;
                left: 50%;
                bottom: 3px;
            }*/

            .fc-calendar .fc-row > div > div a, .fc-calendar .fc-row > div > div span{
                color: rgba(255,255,255,0.7);
                font-size: 12px;
                text-transform: uppercase;
                display: inline-block;
                padding: 3px 5px;
                border-radius: 3px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 100%;
                margin-bottom: 1px;
                background: transparent;
            }

            .fc-calendar .fc-row > div.fc-today.fc-content:after {
                color: #fff;
            }

            div .fc-past, div .fc-future{
                border-radius: 5px;
            }

            .fc-calendar .fc-row:first-child > div:last-child{
                border-radius: 5px;
            }

            .fc-calendar .fc-row:last-child > div:first-child{
                border-radius: 5px;
            }

            .fc-calendar .fc-row:first-child > div:first-child{
                border-radius: 5px;
            }

            .fc-calendar .fc-row:last-child > div:last-child{
                border-radius: 5px;
            }

            .sdfsdf{
                color: #d6e1eb;
            }


        </style>
        <!-- Events -->
        <style>
            .date-selected, .filtering-status, .conteiner-events{
                position: relative;
                float: left;
            }

            .date-selected{
                width: 100%;
                height: 130px;
            }

            .filtering-status, .date-selected{
                padding: 0 30px;
            }

            .date-selected .custom-month{
                color: white;
            }

            .date-selected .custom-year{
                color: #cdd8e2;
            }

            .date-selected .custom-month, .date-selected .custom-year{
                font-size: 40px;
            }

            .filtering-status{
                width: 100%;
                justify-content: space-between;
                display: flex;
                height: 40px;
                align-items: center;
                font-size: 16px;
                color: #cdd8e2;
            }

            .filtering-status span{
                font-size: 20px;
                padding-left: 5px;
                padding-bottom: 0px;
                box-shadow: 0 5px 0px 0px #011a35;
            }

            .filtering-status div{
                padding-bottom: 3px;
                cursor: pointer;
            }

            .filtering-status .selected{
                box-shadow: 0 2px 0px 0px rgba(205, 216, 226, 0.46);
            }

            .conteiner-events{
                position: absolute;
                left: 0;
                right: 0;
                top: 190px;
                bottom: 90px;
                overflow-x: hidden;
                overflow-y: auto;
            }

            .conteiner-events .event {
                position: relative;
                width: 100%;
                height: 80px;
                background: rgba(255, 255, 255, 0.1);
                cursor: pointer;
            }

            .conteiner-events .event .info-event{
                position: absolute;
                top: 50%;
                left: 30px;
                transform: translateY(-50%);
                margin-top: -10px;
            }

            .conteiner-events .event .info-event .event-time{
                color: #cdd8e2;
                margin-left: 35px;
                font-size:16px;
            }

            .conteiner-events .event .info-event .status{
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                margin-top: -2px;
                font-size: 30px;
            }

            .conteiner-events .event img{
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 30px;
                width: 35px;
                opacity: 0.8;
            }

            .conteiner-events .event:nth-child(2n+0)
            {
                background: transparent;
            }

            .booked{
                color: #FFBF10;
            }

            .available{
                color: #0DD16D;
            }

            .canceled {
                color: #FF3739;
            }

            .jspVerticalBar{
                background: transparent;
            }


            .jspDrag{
                background: #1784c7;
            }

            .jspTrack{
                background: rgba(255, 255, 255, 0.1);
            }

            #add-btn{
                position: absolute;
                width: 60px;
                right: 20px;
                bottom: 15px;
                cursor: pointer;
            }

            .conteiner-event-filters{
                position: absolute;
                bottom:0;
                left:30px;
                height: 90px;
                right: 80px;
            }

            .event-filter{
                position: relative;
                float: right;
                margin-top: 18px;
                opacity: 0.5;
                margin-right: 20px;
            }

            .event-filter img{
                width: 40px;
            }

            .event-filter div{
                text-align: center;
                color: #cdd8e2;
                font-size: 14px;
            }

            .event-filter{
                cursor: pointer;
            }

            #modalAddFlight .event-filter{
                float: left;
                margin: 0 20px;
                margin-top: 20px;
                opacity: 0.6;
            }

            #modalAddFlight .event-filter div{
                color: black;
            }

            #modalAddFlight .event-filter img{
                width: 60px;
            }

            .conteiner-modal-add-event{
                width: 700px;
                color: #FFF;
            }
            .conteiner-modal-add-event .row{
                margin-top: 16px;
            }

            .conteiner-modal-add-event h1{
                margin-top: 5px;
                margin-bottom: 5px;
            }

            .conteiner-modal-add-event h2{
                font-size: 20px;
            }

            .modal-principal-icon{
                position: absolute;
                right: 30px;
                top: 30px;
            }

            .modal {
                border-radius: 0px;
                box-shadow: none;
                -webkit-box-shadow: none;
            }

            #map12{
                width: 100%;
                height: 300px;
            }

            .instructor-event{
                position: absolute;
                bottom: 18px;
                left: 65px;
                color: #b7c2cc;
                font-size: 14px;
            }

            .detail {
                display: none;
            }

            .event-filter.selected:before{
                content: "";
                position: absolute;
                height: 100%;
                width: 20px;
                top: 0px;
                background-image: radial-gradient(circle at center, #cdd8e2 3px, transparent 3px);
                background-size: 20px 20px;
                background-position: top center, bottom center;
                background-repeat: no-repeat;
            }
            .event-filter.selected:before{
                margin-left: -10px;
                margin-top: -10px;
            }
        </style>
        <!--Modal add flight test-->
        <style>
            .custom-modal-content{
                border-radius: 0;
                background: #1784c7;
                color: #FFFFFF;
            }

            .custom-modal-content .modal-header{
                border-bottom: none;
            }

            .custom-modal-content .modal-footer{
                border-top: none;
            }

            .custom-modal-content .custom-btn-primary{
                background: #FF9410;
                border-color: transparent;
                border-radius: 3px;
            }

            .custom-modal-content .custom-btn-default, #cancel-new-route{
                background: transparent;
                border-radius: 0px;
                border: 1px solid #ffffff;
                -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
                -moz-box-sizing: border-box;    /* Firefox, other Gecko */
                box-sizing: border-box;
                color: #fff;
            }

            .custom-modal-content .custom-btn-primary, .custom-modal-content .custom-btn-default{
                width: 100px;
            }

            .custom-modal-content .close span{
                color: #FFF;
            }

            #map, #conteiner-weather{
                width: 100%;
                height: 270px;
            }

            .modal-backdrop{
            }

            #content-modal-add-event{

            }

            #ta-route-description, #flight_description, #test_description, #flight_cancellation, #test_cancellation{
                resize: vertical;
            }

            #add-marker-btn, #show-weather-btn, #close-btn{
                position: absolute;
                top: 10px;
                left: 140px;
                background: #FFF;
                padding: 3px;
                border-radius: 3px;
                box-shadow: 0px 2px 2px rgba(0,0,0,0.2);
                cursor: pointer;
            }

            #show-weather-btn{
              left: 190px;
            }

            #show-weather-btn img{
              width: 24px;
            }

            #close-btn {
              right: 10px;
              top: 10px;
              left: auto;
            }

            #modalAddFlight fieldset legend, #modalAddTest fieldset legend{
                color: white;
            }

            .nopadding-left{
                padding-left: 0px;
            }

            .nopadding-right{
                padding-right: 0px;
            }

            .nopadding{
                padding: 0px;
            }

            /*#ui-id-1, #ui-id-2{
                z-index: 1100;
            }*/

            .ui-menu{
                z-index: 1100;
            }

            #flight_cost{
                text-align: right;
            }

            label.error {
                color: yellow;
                margin-top: 5px;
                font-size: 12px;
            }

            #add-new-route, #cancel-new-route{
                width: auto;
                position: absolute;
                top: 25px;
                left: 0px;
                right: 15px;
            }

            .newRoute {
                display: none;
            }

            .noNewRoute{
                display: block;
            }

            legend{
                border-bottom: 1px dotted #e5e5e5;
            }

            @media (max-width: 360px) {
                #add-new-route{
                    font-size: 10px;
                    height: 34px;
                    line-height: 22px;
                }
            }

            #flight_cost-error{
                position: absolute;
                left: 0px;
                top: 33px;
            }

            .contentModalOptions{
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                width: 300px;
                height: 200px;
                background: #1784c7;
                padding: 10px 20px;
                color: white;
                box-shadow: 0 5px 15px rgba(0,0,0,.3);
            }

            .optionConteiner{
                width: 70px;
                position: relative;
                float: left;
                margin-top: 25px;
                margin-left: 40px;
                cursor: pointer;
            }

            .iconOptions{
                width: 100%;
            }

            .calendar-points{
                position: relative;
                float: left;
                font-size: 30px;
            }

            .optionTitle{
                text-align: center;
            }
            .fc-calendar .fc-row > div > div{
                text-align: center;
            }

            .fc-calendar .fc-row > div > div {
                text-align: center;
                MARGIN-TOP: 0px;
                LEFT: 50%;
                bottom: 0px;
                transform: translateX(-50%);
                position: absolute;
                line-height: 15px;
                top: 0px;
                width: 100%;
            }

            .calendarIcons{
                position: absolute;
                bottom: 5px;
                width: 20px;
                opacity: 0.4;
                right: 5px;
            }
            .calendarIcons.airplane{
                display: none;
            }

            .calendarIcons.test{
                display: none;
            }

            .calendar-default{
                height: 100%;
            }

            #conteiner-calendar-options{
                position: absolute;
                bottom: -20px;
                left: 50px;
            }

            #conteiner-calendar-options img{
                width: 30px;
                cursor: pointer;
                margin-left: 20px;
            }
            #conteiner-calendar-options img:nth-child(1)
            {
                margin-left: 0;
            }

            /*ANIMATION WEATHER*/

            #conteiner-weather{
              background: linear-gradient(#01A9DB, #81DAF5);
              position: absolute;
              bottom: -100%;
              z-index: 1;
              overflow: hidden;
            }

            #plane-svg, #cloud1, #cloud2, #cloud3, #cloud4, #cloud5, #cloud6 {
            	position: absolute;
            }

            #plane-svg {
            	width: 60%;
              left: 50%;
              bottom: 40px;
              transform: translateX(-50%);
            }

            #cloud1 {
              width: 300px;
              bottom: -5px;
              left: 200px;
            }

            #cloud2 {
              width: 200px;
              bottom: -4px;
              right: -10px;
            }

            #cloud3 {
              width: 250px;
              bottom: 0px;
              left: 50px;
            }

            #cloud4 {
              width: 180px;
              bottom: -5px;
              left: -5px;
            }

            #cloud5 {
              width: 180px;
              bottom: 0px;
              right: -5px;
            }

            #cloud6 {
              width: 250px;
              bottom: -50px;
              right: 190px;
            }


            @media (max-width: 412px) {
                #cancel-new-route {
                    font-size: 10px;
                    line-height: 20px;
                }
            }
        </style>
    @endsection

@section('content')
        <div id="conteiner-calendar-events">
            <div class="container">
                <div class="custom-calendar-wrap custom-calendar-full">
                    <div class="custom-header clearfix">
                        <h3 class="custom-month-year">
                            <div id="month-year-calendar" class="vertical-center">
                                <span id="custom-month" class="custom-month"></span>
                                <span class="custom-month">, </span>
                                <span id="custom-year" class="custom-year"></span>
                            </div>
                            <div id="conteiner-nav-calendar" class="vertical-center">
                                <div id="custom-prev">&#9664</div>
                                <div id="custom-next">&#9654</div>
                                <div id="custom-current" title="Go to current date">
                                    <img src="{{URL::to('svg/calendar/ic_today_black_48px.svg')}}">
                                </div>
                            </div>
                        </h3>
                        <div id="conteiner-calendar-options">
                            <img id="showFlights" src="{{URL::to('svg/calendar/ic_airplanemode_active_light_48px.svg')}}">
                            <img id="showTests" src="{{URL::to('svg/calendar/ic_content_paste_light_48px.svg')}}">
                        </div>
                    </div>
                    <div id="calendar" class="fc-calendar-container"></div>
                </div>
            </div>
            <div id="content-events">
                <div class="date-selected" id="date-selected">
                    <div class="vertical-center">
                        <span class="custom-month span-selected-date-day-name"></span>
                        <span class="custom-year span-selected-date-day-number"></span>
                    </div>
                </div>
                <div id="filtering-status" class="filtering-status">
                    <div id="selectedStatus" class="selected" data-status="null">All</div>
                    <div data-status="available">Available<span class="available">&#9679</span></div>
                    <div data-status="booked">Booked<span class="booked">&#9679</span></div>
                    <div data-status="canceled">Canceled<span class="canceled">&#9679</span></div>
                </div>
                <div id="conteiner-events" class="conteiner-events" data-bind="foreach: currentEvents">
                    <div class="event" data-bind="click: $parent.showEvent">
                        <div class="info-event">
                            <span data-bind="attr: { 'class': $parent.getClass($data) }">&#9679</span>
                            <span class="event-time" data-bind="text: timeFormat()"></span>
                        </div>
                        <div class="instructor-event">
                            Instructor: <span data-bind="text: instructorFullName()"></span>
                        </div>
                        <img data-bind="attr: { 'src': $parent.getIcon($data) }">
                    </div>
                </div>
                <div class="conteiner-event-filters">
                    <div class="event-filter" data-event="Test">
                        <img src="{{URL::to('svg/calendar/ic_content_paste_light_48px.svg')}}">
                        <div>Tests</div>
                    </div>
                    <div class="event-filter" data-event="FlightTest">
                        <img src="{{URL::to('svg/calendar/ic_airplanemode_active_light_48px.svg')}}">
                        <div>Flights</div>
                    </div>
                    <div id="allEvents" class="event-filter selected" data-event="null" style="display: none;">
                    </div>
                </div>
                <img id="add-btn" src="{{URL::to('svg/ic_add_circle_white_48px.svg')}}">
            </div>
        </div>

        <div id="modalAddFlight" class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div id="modalWrapper" class="modal-dialog" role="document">
                <div id="content-modal-add-event" class="modal-content custom-modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title add">ADD FLIGHT TEST</h2>
                        <h2 class="modal-title detail">FLIGHT TEST DETAIL</h2>
                        <h4><span class="span-selected-date-day-name"></span><span class="span-selected-date-month-name"></span> <span class="span-selected-date-day-number"></span>, <span class="span-selected-date-year"></span></h4>
                        <img class="modal-principal-icon" src="{{URL::to('svg/calendar/ic_airplanemode_active_white_48px.svg')}}">
                    </div>
                    <form  id="form-add-flight-test" autocomplete="off">
                    <div class="modal-body">
                            <div class="row">
                                <div class='col-sm-12'>
                                    <fieldset class="form-group">
                                        <legend>Route</legend>
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <div class="form-group">
                                                    <label for="search-route" class="noNewRoute">Search route *</label>
                                                    <input id="search-route" name="search_route" class="form-control noNewRoute" type="text">
                                                    <label for="route-name" class="newRoute">Name for the new route</label>
                                                    <input id="route-name" name="route_name" class="form-control newRoute" type="text">
                                                </div>
                                            </div>
                                            <div class="col-xs-4" style="height: 74px;">
                                                <div class="form-group">
                                                    <div id="add-new-route" class="btn btn-primary custom-btn-primary noNewRoute">New route</div>
                                                    <div id="cancel-new-route" class="btn btn-primary custom-btn-primary newRoute">Cancel route</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <label class="newRoute">Draw the route</label>
                                                <div class='form-group' style="position:relative; overflow-y: hidden;">
                                                    <div id="map"></div>
                                                    <div id="conteiner-weather">
                                                      <div id="close-btn">
                                                          <img src="{{URL::to('svg/ic_close_black_24px.svg')}}">

                                                      </div>
                                                    </div>
                                                    <div id="add-marker-btn">
                                                        <img src="{{URL::to('svg/calendar/ic_add_location_black_24px.svg')}}">
                                                    </div>
                                                    <div id="show-weather-btn">
                                                        <img src="{{URL::to('svg/calendar/2.svg')}}">
                                                    </div>
                                                    <input type="hidden" name="coordinates" id="coordinates">
                                                </div>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12 newRoute'>
                                                <div class='form-group'>
                                                    <label for="route_description">Route description</label>
                                                    <textarea id="ta-route-description" name="route_description" type="text" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        <fieldset class="form-group">
                            <legend>Flight information</legend>
                            <div class="row">
                                <div class="col-sm-12">
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <div class='form-group'>
                                                    <label for="instructor">Instructor *</label>
                                                    <input class="form-control" id="flight_instructor" name="instructor" type="text" data-id="0"/>
                                                </div>
                                            </div>
                                            <div class='col-sm-6'>
                                                <div class='form-group'>
                                                    <label for="airplane">Airplane *</label>
                                                    <input class="form-control" id="flight_airplane" name="airplane" type="text" data-id="0"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="flight_description">Description</label>
                                                    <textarea id="flight_description" name="flight_description" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <fieldset class="form-group">
                                                    <legend>Start</legend>
                                                    <div class="col-xs-6 nopadding-left">
                                                        <div class='form-group'>
                                                            <label for="flight_start_hour">Hour</label>
                                                            <select class="form-control" id="flight_start_hour" name="flight_start_hour">
                                                                @for($x =0; $x < 24; $x++)
                                                                    <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 nopadding-right">
                                                        <div class='form-group'>
                                                            <label for="start">Minute</label>
                                                            <select class="form-control" id="flight_start_minute" name="start">
                                                                @for($x =0; $x < 60; $x+=5)
                                                                    <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class='col-sm-6'>
                                                <fieldset class="form-group">
                                                    <legend>Finish</legend>
                                                    <div class="col-xs-6 nopadding-left">
                                                        <div class='form-group'>
                                                            <label for="start">Hour</label>
                                                            <select class="form-control" id="flight_end_hour" name="start">
                                                                @for($x =0; $x < 24; $x++)
                                                                    <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 nopadding-right">
                                                        <div class='form-group'>
                                                            <label for="start">Minute</label>
                                                            <select class="form-control" id="flight_end_minute" name="start">
                                                                @for($x =0; $x < 60; $x+=5)
                                                                    <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="cost">Cost (USD) *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span>
                                                        <input id="flight_cost" type="text" name="cost" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 detail">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select id="flight_status" name="status" class="form-control">
                                                        <option id="available-option" value="available">Available</option>
                                                        <option id="booked-option" value="booked">Booked</option>
                                                        <option value="canceled">Canceled</option>
                                                    </select>
                                                </div>
                                                <div id="conteiner-cancellation-flight" class="form-group" style="display: none;">
                                                    <label for="cancellation">Reason for cancellation *</label>
                                                    <textarea id="flight_cancellation" name="cancellation" class="form-control"></textarea>
                                                </div>
                                                <div class="form-group" id="conteiner-booked" style="display: none;">
                                                    <label for="student">Booked by</label>
                                                    <input id="student" name="student" class="form-control" readonly="true" />
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <input type="hidden" id="id-flight">
                    <input type="hidden" id="flight-option">
                    <div class="modal-footer add">
                        <button id="close-modal" type="button" class="btn btn-default custom-btn-default" data-dismiss="modal">Cancel</button>
                        <button id="addflightsubmit" type="submit" class="btn btn-primary custom-btn-primary">Save</button>
                    </div>
                    <div class="modal-footer detail">
                        <button id="close-modal" type="button" class="btn btn-default custom-btn-default" data-dismiss="modal">Cancel</button>
                        <button id="editFlight" class="btn btn-primary custom-btn-primary">Edit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="modalAddTest" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content custom-modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h2 class="modal-title add">ADD TEST</h2>
                        <h2 class="modal-title detail">TEST DETAIL</h2>
                        <h4><span class="span-selected-date-day-name"></span><span class="span-selected-date-month-name"></span> <span class="span-selected-date-day-number"></span>, <span class="span-selected-date-year"></span></h4>
                        <img class="modal-principal-icon" src="{{URL::to('svg/calendar/ic_content_paste_white_48px.svg')}}">
                    </div>
                    <form id="form-add-test">
                        <div class="modal-body">
                            <fieldset class="form-group">
                                <legend>Information</legend>
                            <div class="row">
                                <div class='col-sm-6'>
                                    <div class="form-group">
                                        <label for="subject">Subject *</label>
                                        <input type="text" class="form-control" id="subject" name="subject">
                                    </div>
                                </div>
                                <div class='col-sm-6'>
                                    <div class="form-group">
                                        <label for="test_instructor">Instructor *</label>
                                        <input type="text" class="form-control" id="test_instructor" name="test_instructor">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-sm-12'>
                                    <div class="form-group">
                                        <label for="test_description">Description</label>
                                        <textarea class="form-control" id="test_description" name="test_description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <fieldset class="form-group">
                                        <legend>Start</legend>
                                        <div class="col-xs-6 nopadding-left">
                                            <div class="form-group">
                                                <label for="test_start_hour">Hour</label>
                                                <select name="test_start_hour" id="test_start_hour" class="form-control">
                                                    @for($x =0; $x < 24; $x++)
                                                        <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 nopadding-right">
                                            <div class="form-group">
                                                <label for="test_start_minute">Minute</label>
                                                <select name="test_start_minute" id="test_start_minute" class="form-control">
                                                    @for($x =0; $x < 60; $x+=5)
                                                        <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-sm-6">
                                    <fieldset class="form-group">
                                        <legend>End</legend>
                                        <div class="col-xs-6 nopadding-left">
                                            <div class="form-group">
                                                <label for="test_end_hour">Hour</label>
                                                <select name="test_end_hour" id="test_end_hour" class="form-control">
                                                    @for($x =0; $x < 24; $x++)
                                                        <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 nopadding-right">
                                            <div class="form-group">
                                                <label for="test_end_minute">Minute</label>
                                                <select name="test_end_minute" id="test_end_minute" class="form-control">
                                                    @for($x =0; $x < 60; $x+=5)
                                                        <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row detail">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="test_status">Status</label>
                                        <select id="test_status" name="test_status" class="form-control">
                                            <option value="available">Available</option>
                                            <option value="canceled">Canceled</option>
                                        </select>
                                    </div>
                                    <div id="conteiner-cancellation-test" class="form-group" style="display: none;">
                                        <label for="cancellation">Reason for cancellation *</label>
                                        <textarea id="test_cancellation" name="cancellation" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            </fieldset>
                        </div>
                        <input type="hidden" id="id-test">
                        <input type="hidden" id="test-option">
                        <div class="modal-footer add">
                            <button id="close-modal" type="button" class="btn btn-default custom-btn-default" data-dismiss="modal">Cancel</button>
                            <button id="addTestSubmit" type="submit" class="btn btn-primary custom-btn-primary">Save</button>
                        </div>
                        <div class="modal-footer detail">
                            <button id="close-modal" type="button" class="btn btn-default custom-btn-default" data-dismiss="modal">Cancel</button>
                            <button id="editTest" class="btn btn-primary custom-btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

@section('javascript')
        <script>
            var urlGetInstructors = '{{route('getInstructorsByName')}}';
            var urlSvgCalendar = urlSvgImages + '/calendar/';
            var urlGetAirplanes = '{{route('getAirplanesByPlateAndName')}}';
            var urlAddFlightTest = '{{route('addFlightTest')}}';
            var urlGetRoutes = '{{route('getRoutesByName')}}';
            var urlAddTest = '{{route('addTest')}}';
            var urlGetEventsByMonth = '{{URL::to('/')}}' + '/getEventsByMonth/';
            var urlGetEventsByDate = '{{URL::to('/')}}' + '/getEventsByDate/';
            var TOKEN = '{{ Session::token() }}';
        </script>
        <script type="text/javascript" src="{{URL::to('js/calendar/calendario.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/data.js')}}"></script>
        {{--<script type="text/javascript" src="{{URL::to('js/calendar/jquery.jscrollpane.min.js')}}"></script>--}}
        {{--<script src="http://jscrollpane.kelvinluck.com/script/jquery.mousewheel.js"></script>--}}
        <script type="text/javascript" src="{{URL::to('js/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/jquery.validate.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/additional-methods.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/knockout-3.4.0.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/date.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/map.functions.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/calendar.functions.js')}}"> </script>
        <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6KW7B-xPGNZIpgADTsdMfmhv0Yap_BeM&signed_in=true&libraries=drawing&callback=initMap">
        </script>


    @endsection
