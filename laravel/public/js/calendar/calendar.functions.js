/**
 * Created by brandonirs on 28/09/2016.
 */

// TODO Cuando falten menos de 5 minutos para la siguiente hora arreglar bug, igual con los minutos

$(function() {

    window.SELECTED_DATE = new Date();
    var RANGE_OF_MINUTES = 5;

    $.validator.addMethod("elementSelected", function (value, element) {

        return this.optional(element) || ($(element).attr("data-id") > 0);
    }, "Select an element from the drop down.");

    $('#form-add-flight-test').validate({
        ignore: ':hidden:not("#coordinates")',
        rules: {
            instructor: {
                required: true,
                elementSelected: true
            },
            airplane: {
                required: true,
                elementSelected: true
            },
            cost: {
                required: true,
                number: true
            },
            search_route: {
                elementSelected: true,
                required: true
            },
            route_name: {
                required: true
            },
            coordinates: {
                required: {
                  depends : function () {
                      return NEW_ROUTE;
                  }
                }
            }
        },
        messages: {
            instructor: {
                elementSelected: 'Please, select an instructor.'
            },
            airplane: {
                elementSelected: 'Please, select an airplane.'
            },
            search_route: {
                elementSelected: 'Please, select a route.'
            },
            coordinates: {
                required: 'Please, draw the route.'
            }
        },
        submitHandler: function () {

            var $submitButton = $('#addflightsubmit');
            $submitButton.prop('disabled', true);

            var loadingAnimation = new loadingProcessAnimation();

            loadingAnimation.show('Saving flight test');
            
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

            for(var x = 0; x < MARKERS.length; x++)
            {
                if(first) first = false; else stringMarkers += ',';
                var marker = MARKERS[x];
                var position = marker.getPosition();
                stringMarkers += '{ "label": "' + marker.getLabel() + '", "lat": "' + position.lat() + '", "lng": "' + position.lng() + '" }';
            }

            stringMarkers += ']';

            var jsonPoints =  JSON.parse(stringPoints);
            var jsonMarkers = JSON.parse(stringMarkers);

            vm().addFlight(jsonPoints, jsonMarkers).done(function (response) {
                if(response.status === 0)
                {
                    loadingAnimation.done('Flight test successfully added!', function () {
                        $('#modalAddEvent').modal('hide');
                        $submitButton.prop('disabled', false);
                    });
                }
            });
        }
    });

    /** <!-- FLIGHT TEST ...*/

    $('#add-new-route').click(function () {
        cleanDataInMap();
        MAP_CLICK_EVENT = map.addListener('click', addLatLng);
        poly.setEditable(true);
        NEW_ROUTE = true;
        $('.noNewRoute').css('display','none');
        $('.newRoute').css('display','block');
        $('#search-route-error').remove();
    });

    $('#cancel-new-route').click(function () {
        cleanDataInMap();
        google.maps.event.removeListener(MAP_CLICK_EVENT);
        poly.setEditable(false);
        NEW_ROUTE = false;
        $('#coordinates-error').remove();
        $('#route-name-error').remove();
        $('.newRoute').css('display','none');
        $('.noNewRoute').css('display','block');
    });

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

    $('#search-route').autocomplete({
        minLength: 0,
        source: function( request, response ) {
            if(request.term !== '') $.ajax( {
                url: urlGetRoutes + '/' + request.term,
                method: "GET",
                success: function( data ) {
                    response(data.routes);
                }
            } );
        },
        focus: function( event, ui ) {
            $(this).valid();
            return false;
        },
        select: function( event, ui ) {
            var $input = $(this);
            $input.val( ui.item.name);
            $input.attr('data-id',ui.item.id);
            $input.valid();
            cleanDataInMap();
            drawMarkers(ui.item.markers);
            drawPoints(ui.item.points);
            return false;
        }
    }).keydown(function (event) {
        if (event.keyCode == 8) {
            $(this).attr('data-id','0');
        }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<div>" + item.name + "</div>" )
            .appendTo( ul );
    };

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
            $(this).valid();
            return false;
        },
        select: function( event, ui ) {
            var $input = $( "#flight_instructor" );
            $input.val( ui.item.person.first_name + ' ' + ui.item.person.last_name);
            $input.attr('data-id',ui.item.id);
            $(this).valid();
            return false;
        }
    }).keydown(function (event) {
        if (event.keyCode == 8) {
            $(this).attr('data-id','0');
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
            $(this).valid();
            return false;
        },
        select: function( event, ui ) {
            var $input = $( "#flight_airplane" );
            $input.val( ui.item.plate);
            $input.attr('data-id',ui.item.id);
            $(this).valid();
            return false;
        }
    }).keydown(function (event) {
        if (event.keyCode == 8) {
            $(this).attr('data-id','0');
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

        showModalSelectOption();

        /*settingsFlightModal();

        showModalAnimation($('#modalAddEvent'), function(){

            google.maps.event.trigger(map, 'resize');
            map.setCenter({lat: -34.397, lng: 150.644});
            


        }, function(){
            $('#modalAddEvent').find('input, textarea').val('');
            cleanDataInMap();
            google.maps.event.removeListener(MAP_CLICK_EVENT);
            poly.setEditable(false);
            NEW_ROUTE = false;
            $('#coordinates-error').remove();
            $('#route-name-error').remove();
            $('.newRoute').css('display','none');
            $('.noNewRoute').css('display','block');
        });*/
        
    });
    
    function showModalSelectOption() {
        var $divBackground = $('<div>', {class: 'backgroundModalProcess'});
        var $divContentModal = $('<div>', {class: 'contentModalOptions'});
        var $title = $('<h4>', {html: 'Select an option:'});
        var $body = $('body');
        var $airplaneSvg = $('<img>', { class: 'iconOptions', src: urlSvgImages + '/calendar/' + 'ic_airplanemode_active_white_48px.svg'});
        var $testSvg = $('<img>', { class: 'iconOptions', src: urlSvgImages + '/calendar/' + 'ic_content_paste_white_48px.svg'});
        var $flightTitle = $('<div>', { class: 'optionTitle', html: 'Flight'});
        var $testTitle = $('<div>', { class: 'optionTitle', html: 'Test'});
        var $divContainer1 = $('<div>',{ id: 'btnAddFlight', class: 'optionConteiner'});
        var $divContainer2 = $('<div>',{ id: 'btnAddTest', class: 'optionConteiner'});

        $divContainer1.click(function () {

            $divBackground.remove();

            settingsFlightModal();

            showModalAnimation($('#modalAddEvent'), function(){

                google.maps.event.trigger(map, 'resize');
                map.setCenter({lat: -34.397, lng: 150.644});



            }, function(){
                $('#modalAddEvent').find('input, textarea').val('');
                cleanDataInMap();
                google.maps.event.removeListener(MAP_CLICK_EVENT);
                poly.setEditable(false);
                NEW_ROUTE = false;
                $('#coordinates-error').remove();
                $('#route-name-error').remove();
                $('.newRoute').css('display','none');
                $('.noNewRoute').css('display','block');
            });
        });

        $divBackground.click(function () {
            TweenMax.to($divBackground, 0.2, {y: '-100%', ease: Power0.easeNone, onComplete: function () {
                $divBackground.remove();
            }});
        });

        $divContainer1.append($airplaneSvg);
        $divContainer1.append($flightTitle);
        $divContainer2.append($testSvg);
        $divContainer2.append($testTitle);

        $divContentModal.append($title);
        $divContentModal.append($divContainer1);
        $divContentModal.append($divContainer2);
        $divBackground.append($divContentModal);
        $body.append($divBackground);
        TweenMax.set($divBackground, {perspective:300});
        TweenMax.set($divContentModal, {transformStyle:"preserve-3d"});
        TweenMax.from($divContentModal, 0.6, {scale: 0.5, rotationY:'0_short', opacity: 0, rotationX:'80_short', rotation:'0_short', transformOrigin: 'top 90% -600'});
    }

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
        var data = {
            date: SELECTED_DATE.toString('yyyy-M-d'),
            start: start,
            end: end,
            cost: $('#flight_cost').val(),
            instructor: $('#flight_instructor').attr('data-id'),
            airplane: $('#flight_airplane').attr('data-id'),
            _token : TOKEN
        };

        if(NEW_ROUTE) {
            data.route = {
                name: $('#route-name').val(),
                description: $('#ta-route-description').val(),
                points: points,
                markers: markers
            };
        }
        else {
            data.route_id = $('#search-route').attr('data-id');
        }

        return $.ajax({
            url : urlAddFlightTest,
            type: 'POST',
            data : ko.toJSON(data),
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


