/**
 * Created by brandonirs on 28/09/2016.
 */

// TODO Cuando falten menos de 5 minutos para la siguiente hora arreglar bug, igual con los minutos
// TODO Si no es la hora actual no esconder los minutos

$(function() {

    var SELECTED_DATE = new Date();
    var RANGE_OF_MINUTES = 5;

    $('document').ready(function(){
        $('#lastDaySelected').trigger('click');
    });

    /** <!-- FLIGHT TEST ...*/

    $('#flight_start_hour').change(function () {
        var $select = $('#flight_end_hour');
        var $minutes = $('#flight_start_minute');
        var $minutesEnd = $('#flight_end_minute');

        $minutes.find('option').css('display','inline');
        $minutesEnd.find('option').css('display','inline');
        $select.find('option').css('display','inline');

        if(Date.compare(SELECTED_DATE, Date.today()) === 0) {
            if(parseInt($(this).val()) === new Date().getHours()){
                disableOverdueMinutes(new Date().getMinutes(), $minutes);
                disableOverdueMinutes(new Date().getMinutes() + RANGE_OF_MINUTES, $minutesEnd);
            }
        }


        disableOverdueHours(parseInt($(this).val()), $select);
    });

    $('#flight_start_minute').change(function(){
        var $select = $('#flight_end_minute');
        $select.find('option').css('display','inline');
        disableOverdueMinutes(parseInt($(this).val()), $select);
    });

    /*
    * var $selectHour = $('#flight_start_hour');
     var $selectMinutes = $('#flight_start_minute');
     disableOverdueHours(SELECTED_DATE.getHours(), $selectHour);
     disableOverdueMinutes(SELECTED_DATE.getMinutes(), $selectMinutes);
     disableOverdueHours(parseInt($selectHour.val()), $('#flight_end_hour'));
     disableOverdueMinutes(parseInt($selectMinutes.val()), $('#flight_end_minute'));
    *
    * */

    $( "#flight_instructor" ).autocomplete({
        minLength: 0,
        source: function( request, response ) {
            if(request.term !== '') $.ajax( {
                url: urlGetInstructors + '/' + request.term,
                method: "GET",
                success: function( data ) {
                    console.log(data);
                    response(data.instructors);
                }
            } );
        },
        focus: function( event, ui ) {
            return false;
        },
        select: function( event, ui ) {
            var $input = $( "#flight_instructor" );
            $input.val( ui.item.person.first_name + ' ' + ui.item.person.last_name);
            $input.attr('data-id',ui.item.id);
            return false;
        }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<div>" + item.person.first_name + ' ' + item.person.last_name + "</div>" )
            .appendTo( ul );
    };

    $( "#flight_airplane" ).autocomplete({
        minLength: 0,
        source: function( request, response ) {
            if(request.term !== '') $.ajax( {
                url: urlGetAirplanes + '/' + request.term,
                method: "GET",
                success: function( data ) {
                    console.log(data);
                    response(data.airplanes);
                }
            } );
        },
        focus: function( event, ui ) {
            /*$( "#project" ).val( ui.item.label );*/
            return false;
        },
        select: function( event, ui ) {
            var $input = $( "#flight_airplane" );
            $input.val( ui.item.plate);
            $input.attr('data-id',ui.item.id);
            return false;
        }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<div>" + item.plate + "</div>" )
            .appendTo( ul );
    };

    /*-->*/

    var $addBtn = $('#add-btn');

    function disableOverdueHours(hour, $hourSelect){
        var $arrayOptions = $hourSelect.find('option');
        var index = hour - 1;

        for(var x = index; x >= 0 ; x--){
            $($arrayOptions[x]).css('display','none');
        }

        $($arrayOptions[hour]).prop('selected', true);
    }

    function disableOverdueMinutes(minute, $minuteSelect) {
        var $arrayOptions = $minuteSelect.find('option');
        var startIndex = Math.floor(minute / RANGE_OF_MINUTES);

        for (var x = startIndex; x >= 0; x--) {
            $($arrayOptions[x]).css("display", "none");
        }

        $($arrayOptions[startIndex + 1]).prop('selected', true);
    }

    $('#add-marker-btn').click(function(){
        addMarkerLastCoordinates();
    });

    $('#btn-add-flight').click(function () {
        var $modalAddEvent = $('#modalAddEvent');
        $modalAddEvent.find('h2').remove();
        $modalAddEvent.find('div').remove();
    });

    $addBtn.click(function () {

        settingsFlightModal();

        showModalAnimation($('#modalAddEvent'), function(){

            google.maps.event.trigger(map, 'resize');
            map.setCenter({lat: -34.397, lng: 150.644});

        }, function(){
            $('#modalAddEvent').find('input, textarea').val('');
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            //poly.setMap(null);
            poly.getPath().clear();
            markers = [];
            addMarker = true;
        });
    });

    function settingsFlightModal(){
        var $selectHour = $('#flight_start_hour');
        var $selectMinutes = $('#flight_start_minute');
        var $selectHourEnd = $('#flight_end_hour');
        var $selectMinutesEnd = $('#flight_end_minute');

        $([$selectHour, $selectMinutes, $selectHourEnd, $selectMinutesEnd]).each(function () {
            $(this).find('option').css('display','inline');
        });

        if(Date.compare(SELECTED_DATE, Date.today()) === 0) {
            var current = new Date();
            var hours = current.getHours();
            var minutes = current.getMinutes();



            disableOverdueHours(9, $selectHour);
            disableOverdueMinutes(50, $selectMinutes);
            disableOverdueHours(9, $selectHourEnd);
            disableOverdueMinutes(50 + RANGE_OF_MINUTES, $selectMinutesEnd);
        }
        else {
            $([$selectHour, $selectMinutes, $selectHourEnd, $selectMinutesEnd]).each(function () {
                $(this).find('option:first').prop('selected',true);
            });
        }

    }

    $('.filtering-status > div').click(function (e) {
        var $elementClicked = $(e.currentTarget);
        var $selectedStatus = $('#selectedStatus');
        $selectedStatus.removeAttr('id');
        $selectedStatus.attr('class','');
        $elementClicked.addClass('selected');
        $elementClicked.attr('id','selectedStatus');
    });

    $('.conteiner-events').jScrollPane();

    $(window).resize(function () {
        $('.conteiner-events').jScrollPane();
    });

    function updateMonthYear() {
        $( '#custom-month' ).html( $( '#calendar' ).calendario('getMonthName') );
        $( '#custom-year' ).html( $( '#calendar' ).calendario('getYear'));
    }

    $(document).on('finish.calendar.calendario', function(e){
        $( '#custom-month' ).html( $( '#calendar' ).calendario('getMonthName') );
        $( '#custom-year' ).html( $( '#calendar' ).calendario('getYear'));
        $( '#custom-next' ).on( 'click', function() {
            slideAndReturnAnimation($('#month-year-calendar'), function () {
                $( '#calendar' ).calendario('gotoNextMonth', updateMonthYear);
            });

        } );
        $( '#custom-prev' ).on( 'click', function() {
            slideAndReturnAnimation($('#month-year-calendar'), function () {
                $( '#calendar' ).calendario('gotoPreviousMonth', updateMonthYear);
            });

        } );
        $( '#custom-current' ).on( 'click', function() {

            SELECTED_DATE = Date.today();

            slideAndReturnAnimation($('#month-year-calendar'), function () {
                $( '#calendar' ).calendario('gotoNow', updateMonthYear);
            });

        } );
    });

    $('#calendar').on('shown.calendar.calendario', function(){
        $('div.fc-row > div').on('onDayClick.calendario', function(e, dateprop) {

            var $element = $(e.target);

            if($element.find('.fc-emptydate').length === 0) {

                SELECTED_DATE = parseDateCalendarToJsDate(dateprop.year, dateprop.month, dateprop.day);

                highlightDaySelected($element);

                slideAndReturnAnimation($('#date-selected'), function () {
                    updateDateInfo(dateprop);
                });
            }

        });
    });

    var $calendar = $( '#calendar' ).calendario({
        checkUpdate : false,
        caldata : events,
        fillEmpty : true,
        displayWeekAbbr : true,
        events: ['click', 'focus']
    });

    function parseDateCalendarToJsDate(year, month, day){
        return new Date(year, (month - 1), parseInt(day));
    }

    function highlightDaySelected($element)
    {
        var $lastDaySelected = $('#lastDaySelected');
        $lastDaySelected.css('background', 'transparent');
        $lastDaySelected.find('span').css('color', '#a4afb9');
        $lastDaySelected.removeAttr('id');
        $element.css('background', '#1784c7');
        $element.find('span').css('color', '#fff');
        $element.attr('id', 'lastDaySelected');

    }

    function updateDateInfo(dateprop) /** Update date of all views **/
    {
        $('.span-selected-date-day-name').html(dateprop.weekdayname + ', ');
        $('.span-selected-date-day-number').html(numberAbbs(dateprop.day));
        $('.span-selected-date-month-name').html(dateprop.monthname);
        $('.span-selected-date-year').html(dateprop.year);
    }

    function numberAbbs(number){
        var firstDigit = parseInt(number.charAt(number.length - 1));
        var specialArray = ['st', 'nd', 'rd'];
        var normalArray = [4,5,6,7,8,9,0];
        var excArray = [11,12,13];

        if(normalArray.includes(firstDigit) || excArray.includes(parseInt(number)))
            return number + 'th';

        return number + specialArray[firstDigit - 1];

    }
});
