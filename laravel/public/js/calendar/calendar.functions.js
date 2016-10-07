/**
 * Created by brandonirs on 28/09/2016.
 */

// TODO Cuando falten menos de 5 minutos para la siguiente hora arreglar bug, igual con los minutos

$(function() {

    window.SELECTED_DATE = new Date();
    var RANGE_OF_MINUTES = 5;

    $('#form-add-flight-test').validate({
        submitHandler: function (form) {
            var arrayPoints = poly.getPath().getArray();
            var stringMarkers = '[';
            var stringPoints = '[';
            var first = true;

            for(var x = 0; x< arrayPoints.length; x++)
            {
                if(first) first = false; else stringPoints += ',';
                stringPoints += '{ "lat": "' + arrayPoints[x].lat() + '", "lng": "' + arrayPoints[x].lng() + '" }';
            }

            stringPoints += ']';

            first = true;

            for(var x = 0; x < markers.length; x++)
            {
                if(first) first = false; else stringMarkers += ',';
                var marker = markers[x];
                var position = marker.getPosition();
                stringMarkers += '{ "label": "' + marker.getLabel() + '", "lat": "' + position.lat() + '", "lng": "' + position.lng() + '" }';
            }

            stringMarkers += ']';

            console.log(stringMarkers);

            var jsonPoints =  JSON.parse(stringPoints);
            var jsonMarkers = JSON.parse(stringMarkers);

            vm().addFlight(jsonPoints, jsonMarkers).done(function (response) {
                console.log(response);
            });
        }
    });

    /** <!-- FLIGHT TEST ...*/

    $('#flight_start_hour, #flight_start_minute').change(function () {
        updateEndTime($('#flight_start_hour'), $('#flight_start_minute'), $('#flight_end_hour'), $('#flight_end_minute'));
    });

    $('#flight_end_hour').change(function () {
        var $selectEndHour = $(this);
        var $selectEndMinute = $('#flight_end_minute');

        switch (isSelectedNow($selectEndHour, $selectEndMinute)){
            case 'now':
                disableOverdueMinutes(parseInt($('#flight_start_minute').val()), $selectEndMinute);
                $selectEndMinute.attr('data-status', 'currentHour');
                break;
            case 'today':
                $selectEndMinute.attr('data-status', 'noCurrentHour');
                $selectEndMinute.find('option').css('display', 'inline');
                break;
        }
        if($selectEndHour.val() >  $('#flight_start_hour').val()){
            $selectEndMinute.find('option').css('display', 'inline');
        }
    });

    $( "#flight_instructor" ).autocomplete({
        minLength: 0,
        source: function( request, response ) {
            if(request.term !== '') $.ajax( {
                url: urlGetInstructors + '/' + request.term,
                method: "GET",
                success: function( data ) {

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
            .append( "<div><h5>" + item.name + "</h5><h6>" + item.plate + "</h6>" + "</div>" )
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

    function isSelectedNow($selectStartHour, $selectStartMinute){
        if(Date.compare(SELECTED_DATE, Date.today()) === 0) {

            if(parseInt($selectStartHour.val()) === new Date().getHours()) {
                if ($selectStartMinute.attr('data-status') !== 'currentHour') {
                    return 'now';
                }
            }else {
                return 'today'
            }
        }

        return 'notToday';
    }

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

            disableOverdueHours(hours, $selectHour);
            disableOverdueMinutes(minutes, $selectMinutes);
            $selectMinutes.attr('data-status', 'currentHour');
            $('#flight_start_hour').trigger('change');
        }
        else {
            $([$selectHour, $selectMinutes, $selectHourEnd, $selectMinutesEnd]).each(function () {
                $(this).find('option:first').prop('selected',true);
            });
        }

    }

    function updateEndTime($selectStartHour, $selectStartMinute, $selectEndHour, $selectEndMinute) {
        var hours = parseInt($selectStartHour.val());
        var minutes = parseInt($selectStartMinute.val());

        $([$selectEndMinute, $selectEndHour]).each(function () {
            $(this).find('option').css('display','inline');
        });

        disableOverdueHours(hours, $selectEndHour);

        switch (isSelectedNow($selectStartHour, $selectStartMinute)){
            case 'now':
                disableOverdueMinutes(new Date().getMinutes(), $selectStartMinute);
                minutes = parseInt($selectStartMinute.val());
                $selectStartMinute.attr('data-status', 'currentHour');
                break;
            case 'today':
                $selectStartMinute.attr('data-status', 'noCurrentHour');
                $selectStartMinute.find('option').css('display', 'inline');
                break;
        }

        disableOverdueMinutes(minutes, $selectEndMinute);

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
            slideAndReturnAnimation($('#month-year-calendar'), function () {
                $( '#calendar' ).calendario('gotoNow', updateMonthYear);
                $('#lastDaySelected').trigger('click');
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


// TODO al usar el autocomplete de jquery simplemente asigno el valor seleccionado a la variable del viewmodel (en el metodo select o change de autocomplete)

var vm = function CalendarViewModel() {
    var self = this;
    self.newFlightTest = null;
    self.newFlightRoute = null;
    self.addFlight = function (points, markers) {
        var start = $('#flight_start_hour').val() + ':' + $('#flight_start_minute').val();
        var end = $('#flight_end_hour').val() + ':' + $('#flight_end_minute').val();
        return $.ajax({
            url : urlAddFlightTest,
            type: 'POST',
            data : ko.toJSON({
                date: SELECTED_DATE.toString('yyyy-M-d'),
                start: start,
                end: end,
                cost: $('#flight_cost').val(),
                route: {
                    name: 'La concha',
                    description: 'La concha el mejor lugar para bailar en tijuana',
                    points: points,
                    markers: markers
                },
                _token : TOKEN
            }),
            contentType: "application/json"
        });
    };
    self.addFlightRoute = function () {

    };

    return self;
};


function FlightTest(data) {
    this.date = data.date;
    this.start = data.start;
    this.end = data.end;
    this.cost = data.cost;
    this.flight_route = new FlightRoute(data.flight_route);
    this.instructor = data.instructor;
    this.airplane = data.airplane;
}

function FlightRoute(data) {
    this.name = data.name;
    this.description = data.description;
    this.points = data.points;
    this.markers = data.markers;
}

ko.applyBindings(vm);


