@extends('layouts.master-admin')

@section('individual-styles')
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/calendar.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/custom_1.css')}}" />
        <script src="{{URL::to('js/calendar/modernizr.custom.63321.js')}}"></script>
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

            #conteiner-calendar-events{
                position: absolute;
                left: 20px;
                top: 75px;
                bottom: 20px;
                right: 20px;
                box-shadow: 0px 5px 5px rgba(0,0,0,0.1);
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
                top:120px;
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
                color: #aeb9c3;
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
                height: 130px;
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


            #conteiner-events{
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

            .fc-calendar .fc-row > div.fc-content:after {
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
            }

            .fc-calendar .fc-row > div.fc-today.fc-content:after {
                color: #fff;
            }

            .fc-calendar .fc-row > div > div a, .fc-calendar .fc-row > div > div span {
                display: none;
                font-size: 22px;
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
    @endsection


@section('content')
        <div id="conteiner-calendar-events">
            <div class="container">
                <div class="custom-calendar-wrap custom-calendar-full">
                    <div class="custom-header clearfix">
                        <h3 class="custom-month-year">
                            <div class="vertical-center">
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
                            <!--<nav class="vertical-center">
                                <span id="custom-prev">&25C0</span>
                                <span id="custom-next"></span>
                                <span id="custom-current" title="Got to current date">
                                    <img src="{{URL::to('svg/calendar/ic_today_black_48px.svg')}}">
                                </span>
                            </nav>-->
                        </h3>
                    </div>
                    <div id="calendar" class="fc-calendar-container"></div>
                </div>
            </div>
            <div id="conteiner-events">

            </div>
        </div>
    @endsection

@section('javascript')
        <script type="text/javascript" src="{{URL::to('js/calendar/calendario.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/data.js')}}"></script>
        <script type="text/javascript">
            $(function() {

                function updateMonthYear() {
                    $( '#custom-month' ).html( $( '#calendar' ).calendario('getMonthName') );
                    $( '#custom-year' ).html( $( '#calendar' ).calendario('getYear'));
                }

                $(document).on('finish.calendar.calendario', function(e){
                    $( '#custom-month' ).html( $( '#calendar' ).calendario('getMonthName') );
                    $( '#custom-year' ).html( $( '#calendar' ).calendario('getYear'));
                    $( '#custom-next' ).on( 'click', function() {
                        $( '#calendar' ).calendario('gotoNextMonth', updateMonthYear);
                    } );
                    $( '#custom-prev' ).on( 'click', function() {
                        $( '#calendar' ).calendario('gotoPreviousMonth', updateMonthYear);
                    } );
                    $( '#custom-current' ).on( 'click', function() {
                        $( '#calendar' ).calendario('gotoNow', updateMonthYear);
                    } );
                });

                $('#calendar').on('shown.calendar.calendario', function(){
                    $('div.fc-row > div').on('onDayClick.calendario', function(e, dateprop) {

                        var $element = $(e.target);

                        if($element.find('.fc-emptydate').length === 0) {
                            var $lastDaySelected = $('#lastDaySelected');
                            $lastDaySelected.css('background', 'transparent');
                            $lastDaySelected.find('span').css('color', '#a4afb9');
                            $lastDaySelected.removeAttr('id');

                            $element.css('background', '#1784c7');
                            $element.find('span').css('color', '#fff');
                            $element.attr('id', 'lastDaySelected');
                        }

                    });
                });

                $( '#calendar' ).calendario({
                    checkUpdate : false,
                    caldata : events,
                    fillEmpty : true,
                    displayWeekAbbr : true,
                    events: ['click', 'focus']
                });
            });
        </script>
    @endsection