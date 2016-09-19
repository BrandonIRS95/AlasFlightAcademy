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
                font-size: 40px;
                letter-spacing: 0;
                text-transform: none;
                font-weight: 400;
            }
            
            .custom-year{
                font-size: 30px;
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


            #conteiner-events{
                position: relative;
                float: left;
                width: 37%;
                height: 100%;
                background: #011a35;
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

                $( '#calendar' ).calendario({
                    checkUpdate : false,
                    caldata : events,
                    fillEmpty : true,
                    displayWeekAbbr : true,
                });
            });
        </script>
    @endsection