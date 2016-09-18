@extends('layouts.master-admin')

@section('individual-styles')
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/calendar.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/custom_1.css')}}" />
        <script src="{{URL::to('js/calendar/modernizr.custom.63321.js')}}"></script>
        <style>
            body {

            }

            .cd-main-content, .content-wrapper{
                height: 100vh;
            }

            .container{
                height: calc(100% - 23px);
            }

            .custom-calendar-full{
                top: 0px;
            }

            .custom-header h3{
                text-align: left;
                color: gray;
            }

            .title-view{
                display: none;
            }

            .fc-calendar-container{
                top: 60px;
            }

            .fc-calendar{
                left: 0px;
                right: 0px;
            }

            .fc-calendar .fc-head, .fc-calendar
            {
                border-radius: 0px;
            }

            .fc-calendar .fc-head{
                color: #b1b1b1;
                box-shadow: 0;
                border-top: 1px solid lightgray;
                border-bottom: 1px solid lightgray;
                background: none;
                padding: 0px;
            }

            .fc-calendar .fc-head div {
                box-shadow: -1px 0 0 #dadada;
            }

            .fc-calendar .fc-row {
                box-shadow: inset 0 -1px 0 0 #dadada;
            }

            .fc-calendar .fc-head div:nth-child(1){
                box-shadow: none;
            }

            .custom-header h2, .custom-header h3{
                text-transform: none;
                letter-spacing: 0;
            }

            .fc-calendar .fc-head > div {
                text-transform: none;
                letter-spacing: 0;
                text-shadow: none;
                font-weight: bold;
            }

            .fc-calendar .fc-row > div {
                box-shadow: -1px 0 0 #dadada;
            }

            .fc-calendar .fc-row > div > span.fc-date {
                color: #011a35;
            }

            .fc-calendar .fc-row > div.fc-today{
                box-shadow: none;
            }

            .fc-calendar .fc-body{
                padding: 0px;
            }

            #custom-month{
                font-size: 30px;
                color: #011a35;
            }

            #custom-year{
                font-size: 25px;

            }

            .conteiner-cal-nav{
                position: relative;
                float: right;
                font-size: 30px;
                cursor: pointer;
            }

            .custom-header nav span{
                background: #1784c7;
            }

            .custom-header nav span:hover{
                background: #1784c7;
            }

            .container{
                height: calc(100vh - 60px);
            }

            @media only screen and (min-width: 768px){
                .cd-side-nav {
                    position: fixed;
                }
            }

            @media only screen and (max-width: 880px){
                .fc-calendar-container{
                    top: 0px;
                }
            }

            @media screen and (max-width: 880px), screen and (max-height: 450px) {
                .custom-header{

                }
            }
        </style>
    @endsection

@section('title-view')
        <div style="position: relative; float: left;">Calendar</div>
        <!--<div class="conteiner-cal-nav">
            <span id="custom-prev" class="">&#8678;</span>
            <span id="custom-next" class="">&#8680;</span>
            <span id="custom-current" class="" title="Got to current date">&#8682;</span>
        </div>-->
        <div style="clear: both;"></div>
    @endsection


@section('content')
    <div class="container">
    <div class="custom-calendar-wrap custom-calendar-full">
            <div class="custom-header clearfix">
                <h3 class="custom-month-year">
                    <span id="custom-month" class="custom-month"></span>
                    <span id="custom-year" class="custom-year"></span>
                    <nav>
                        <span id="custom-prev" class="custom-prev"></span>
                        <span id="custom-next" class="custom-next"></span>
                        <span id="custom-current" class="custom-current" title="Got to current date"></span>
                    </nav>
                </h3>
            </div>
            <div id="calendar" class="fc-calendar-container"></div>
        </div>
        </div>
    @endsection

@section('javascript')
        <script type="text/javascript" src="{{URL::to('js/calendar/jquery.calendario.js')}}"></script>
        <script type="text/javascript" src="{{URL::to('js/calendar/data.js')}}"></script>
        <script type="text/javascript">
            $(function() {

                var cal = $( '#calendar' ).calendario( {
                            onDayClick : function( $el, $contentEl, dateProperties ) {

                                for( var key in dateProperties ) {
                                    console.log( key + ' = ' + dateProperties[ key ] );
                                }

                            },
                            caldata : codropsEvents
                        } ),
                        $month = $( '#custom-month' ).html( cal.getMonthName() ),
                        $year = $( '#custom-year' ).html( cal.getYear() );

                $( '#custom-next' ).on( 'click', function() {
                    cal.gotoNextMonth( updateMonthYear );
                } );
                $( '#custom-prev' ).on( 'click', function() {
                    cal.gotoPreviousMonth( updateMonthYear );
                } );
                $( '#custom-current' ).on( 'click', function() {
                    cal.gotoNow( updateMonthYear );
                } );

                function updateMonthYear() {
                    $month.html( cal.getMonthName() );
                    $year.html( cal.getYear() );
                }

                // you can also add more data later on. As an example:
                /*
                 someElement.on( 'click', function() {

                 cal.setData( {
                 '03-01-2013' : '<a href="#">testing</a>',
                 '03-10-2013' : '<a href="#">testing</a>',
                 '03-12-2013' : '<a href="#">testing</a>'
                 } );
                 // goes to a specific month/year
                 cal.goto( 3, 2013, updateMonthYear );

                 } );
                 */

            });
        </script>
    @endsection