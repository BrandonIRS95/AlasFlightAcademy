/**
 * Created by brandonirs on 28/09/2016.
 */

// TODO Cuando falten menos de 5 minutos para la siguiente hora arreglar bug, igual con los minutos

function CalendarViewModel() {
    var self = this;
    self.currentEvents = ko.observableArray([]);
    self.newFlightTest = null;
    self.newFlightRoute = null;
    self.addFlight = function (points, markers) {
        var start = $('#flight_start_hour').val() + ':' + $('#flight_start_minute').val();
        var end = $('#flight_end_hour').val() + ':' + $('#flight_end_minute').val();
        var data = {
            date: SELECTED_DATE.toString('yyyy-M-d'),
            start: start,
            end: end,
            id: $('#id-flight').val(),
            status: $('#flight_status').val(),
            option: $('#flight-option').val(),
            description: $('#flight_description').val(),
            cancellation: $('#flight_cancellation').val(),
            cost: $('#flight_cost').val(),
            instructor: 'current',
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
    self.addTest = function () {
        var data = {
            subject: $('#subject').val(),
            description: $('#test_description').val(),
            date: SELECTED_DATE.toString('yyyy-M-d'),
            id: $('#id-test').val(),
            status: $('#test_status').val(),
            cancellation: $('#test_cancellation').val(),
            option: $('#test-option').val(),
            start: $('#test_start_hour').val() + ':' + $('#test_start_minute').val(),
            end: $('#test_end_hour').val() + ':' + $('#test_end_minute').val(),
            instructor_id: 'current',
            _token : TOKEN
        };
        return $.ajax({
            url : urlAddTest,
            type: 'POST',
            data : ko.toJSON(data),
            contentType: "application/json"
        });
    };
    self.getClass = function (entry) {
        return 'status ' + entry.status.toString();
    };
    self.getIcon = function (entry) {
        return entry.type === 'App\\FlightTest' ? urlSvgCalendar + 'ic_airplanemode_active_light_48px.svg' : urlSvgCalendar + 'ic_content_paste_light_48px.svg';
    };
    self.getEventsByMonth = function(){
        var $calendar = $('#calendar');
        return $.ajax({
            url : urlGetEventsByMonth + $calendar.calendario('getMonth') + '/year/' + $calendar.calendario('getYear') + '/instructor/current',
            type: 'GET'
        });
    };

    self.getEventsByDate = function () {
        return $.ajax({
            url : urlGetEventsByDate + SELECTED_DATE.toString('yyyy-M-d') + '/instructor/current/status/' + $('.filtering-status .selected').attr('data-status') + '/type/' + $('.event-filter.selected').attr('data-event'),
            type: 'GET'
        });
    };

    self.updateCalendarEvents = function () {
        self.getEventsByMonth().done(function (response) {
            $('#calendar').calendario('setData', JSON.parse(response));
            if (DAY_ELEMENT_SELECTED !== null)$('.fc-body').find("[data-id='" + DAY_ELEMENT_SELECTED + "']").trigger('click');
        });
    };

    self.showEvent = function(data){
        var event = data.eventable;
        $('.add').css('display','none');
        $('.detail').css('display', 'block');
        $('#conteiner-cancellation-flight').css('display', 'none');
        $('#conteiner-cancellation-test').css('display', 'none');
        
        if(data.type === 'App\\FlightTest')
        {
            console.log(data);
            settingsFlightModal();
            PROCESS_MESSAGE = 'Editing flight test';
            DONE_MESSAGE = 'Flight test successfully edited!';
            var $flightInstructor = $('#flight_instructor');
            var $airplane = $('#flight_airplane');
            var $route = $('#search-route');
            var $description = $('#flight_description');
            var $startHour = $('#flight_start_hour');
            var $startMinute = $('#flight_start_minute');
            var $endHour = $('#flight_end_hour');
            var $endMinute = $('#flight_end_minute');
            var $status = $('#flight_status');
            var $cost = $('#flight_cost');
            var $conteinerBooked = $('#conteiner-booked');
            var $availableOption = $('#available-option');
            var $bookedOption = $('#booked-option');
            var airplane = event.airplane;
            var route = event.flight_route;
            $('#id-flight').val(data.id);
            $('#flight-option').val('edit');
            $('#flight_cancellation').val(data.cancellation);
            $flightInstructor.val(data.instructorFullName());
            $flightInstructor.attr('data-id', data.instructor.id);
            $airplane.val(airplane.name);
            $airplane.attr('data-id', airplane.id);
            $route.val(route.name);
            $route.attr('data-id', route.id);
            $description.val(event.description);
            $cost.val(event.cost);
            $startHour.val(data.startHour());
            $startMinute.val(data.startMinute());
            $endHour.val(data.endHour());
            $endMinute.val(data.endMinute());
            $status.find('option[value="' + data.status + '"]').prop('selected',true);
            if(data.status === 'canceled') {$('#conteiner-cancellation-flight').css('display', 'block');}
            if(event.student_id >= 1) {
                var person = event.student.person;
                $conteinerBooked.css('display', 'block'); 
                $('#student').val(person.first_name + ' ' + person.last_name);
                $availableOption.css('display','none');
                $bookedOption.css('display','inline'); 
            } else {
                $conteinerBooked.css('display','none');
                $availableOption.css('display','inline');
                $bookedOption.css('display','none');  
            }
            showModalAnimation($('#modalAddFlight'), function () {
                google.maps.event.trigger(map, 'resize');
                drawMarkers(route.markers);
                drawPoints(route.points);

            }, function () {
                $('#modalAddFlight').find('input, textarea').val('');
                cleanDataInMap();
                google.maps.event.removeListener(MAP_CLICK_EVENT);
                poly.setEditable(false);
                NEW_ROUTE = false;
                $('#coordinates-error').remove();
                $('#route-name-error').remove();
                $('.newRoute').css('display','none');
                $('.noNewRoute').css('display','block');
            });
        }
        if (data.type === 'App\\Test')
        {
            settingsTestModal();
            PROCESS_MESSAGE = 'Editing test';
            DONE_MESSAGE = 'Test succesfully edited!';
            var $subject = $('#subject');
            var $instructor = $('#test_instructor');
            var $description = $('#test_description');
            var $startHour = $('#test_start_hour');
            var $startMinute = $('#test_start_minute');
            var $endHour = $('#test_end_hour');
            var $endMinute = $('#test_end_minute');
            var $status = $('#test_status');
            $('#id-test').val(data.id);
            $('#test-option').val('edit');
            $('#test_cancellation').val(data.cancellation);
            $subject.val(event.subject);
            $instructor.val(data.instructorFullName());
            $instructor.attr('data-id', data.instructor.id);
            $description.val(event.description);
            $startHour.val(data.startHour());
            $startMinute.val(data.startMinute());
            $endHour.val(data.endHour());
            $endMinute.val(data.endMinute());
            $status.find('option[value="' + data.status + '"]').prop('selected',true);
            if(data.status === 'canceled') $('#conteiner-cancellation-test').css('display', 'inline');
            showModalAnimation($('#modalAddTest'), null, function () {
                $('#modalAddTest').find('input, textarea').val('');
            });
        }

    };

    return self;
}

function EventCalendar(data){
    this.id = data.id;
    this.date = data.date;
    this.start = data.start;
    this.end = data.end;
    this.status = data.status;
    this.instructor = data.instructor;
    this.eventable = data.eventable;
    this.cancellation = data.cancellation_description;
    this.type = data.eventable_type;
    this.timeFormat = function(){
        return this.start.substring(0,5) + ' - ' + this.end.substring(0,5);
    };
    this.instructorFullName = function() {
        var person = this.instructor.person;
        return person.first_name + ' ' + person.last_name;
    };
    this.startHour = function(){
      return this.start.substring(0,2);
    };
    this.endHour = function(){
        return this.end.substring(0,2);
    };
    this.startMinute = function () {
        return this.start.substring(3,5);
    };
    this.endMinute = function () {
        return this.end.substring(3,5);
    };
}

var vm = new CalendarViewModel();

ko.applyBindings(vm);

$(function() {

    window.SELECTED_DATE = new Date();
    var RANGE_OF_MINUTES = 5;
    var CALENDAR_EVENTS;
    window.PROCESS_MESSAGE;
    window.DONE_MESSAGE;
    window.DAY_ELEMENT_SELECTED = null;

    $('#flight_status').change(function () {
        var $cancel = $('#conteiner-cancellation-flight');
        if($(this).val() === 'canceled')
            $cancel.css('display','block');
        else{
            $cancel.css('display','none');
        }
    });

    $('#test_status').change(function () {
        var $cancel = $('#conteiner-cancellation-test');
        if($(this).val() === 'canceled')
            $cancel.css('display','inline');
        else{
            $cancel.css('display','none');
        }
    });

    $('#showFlights').click(function () {
        $('.calendarIcons.airplane').css('display','inline');
        $('.calendarIcons.test').css('display','none');
    });

    $('#showTests').click(function () {
        $('.calendarIcons.airplane').css('display','none');
        $('.calendarIcons.test').css('display','inline');
    });

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
            cancellation: {
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

            loadingAnimation.show(PROCESS_MESSAGE);
            
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

            vm.addFlight(jsonPoints, jsonMarkers).done(function (response) {
                if(response.status === 0)
                {
                    vm.updateCalendarEvents();
                    loadingAnimation.done(DONE_MESSAGE, function () {
                        $('#modalAddFlight').modal('hide');
                        $submitButton.prop('disabled', false);
                    });
                }
            });
        }
    });

    $('#form-add-test').validate({
        rules: {
            subject: {
                required: true
            },
            test_instructor: {
                required: true,
                elementSelected: true
            },
            cancellation: {
                required: true
            }
        },
        messages: {
            test_instructor: {
                elementSelected: 'Please, select an instructor.'
            }
        },
        submitHandler: function () {
            var loadingAnimation = new loadingProcessAnimation();
            var $submitButton = $('#addTestSubmit');

            $submitButton.prop('disabled', true);

            loadingAnimation.show(PROCESS_MESSAGE);

            vm.addTest().done(function (response) {
                if(response.status === 0)
                {
                    vm.updateCalendarEvents();
                    loadingAnimation.done(DONE_MESSAGE, function () {
                        $('#modalAddTest').modal('hide');
                        $submitButton.prop('disabled', false);
                    });
                }
            });
        }
    });
    
    $('.event-filter').click(function (e) {
        var $elementClicked = $(e.currentTarget);
        if($elementClicked.attr('class') === 'event-filter selected')
        {
            var $all = $('#allEvents');
            $elementClicked.removeAttr('id');
            $elementClicked.attr('class','event-filter');
            $all.addClass('selected');
        }
        else{
            var $selectedStatus = $('#selectedEvent');
            if($selectedStatus){
                $selectedStatus.removeAttr('id');
                $selectedStatus.attr('class','event-filter');
            }
            $elementClicked.addClass('selected');
            $elementClicked.attr('id','selectedEvent');
        }
        showEventsByDate();
    });

    /** <!-- FLIGHT TEST ...*/

    $('#add-new-route').click(function () {
        var $newRoute = $('.newRoute');
        cleanDataInMap();
        MAP_CLICK_EVENT = map.addListener('click', addLatLng);
        poly.setEditable(true);
        NEW_ROUTE = true;
        $('.noNewRoute').css('display','none');
        $newRoute.css('display','block');
        $('#search-route-error').remove();
    });

    $('#cancel-new-route').click(function () {
        var $noNewRoute = $('.noNewRoute');
        cleanDataInMap();
        google.maps.event.removeListener(MAP_CLICK_EVENT);
        poly.setEditable(false);
        NEW_ROUTE = false;
        $('#coordinates-error').remove();
        $('#route-name-error').remove();
        $('.newRoute').css('display','none');
        $noNewRoute.css('display','block');
    });

    $('#flight_start_hour, #flight_start_minute').change(function () {
        updateEndTime($('#flight_start_hour'), $('#flight_start_minute'), $('#flight_end_hour'), $('#flight_end_minute'));
    });

    $('#test_start_hour, #test_start_minute').change(function () {
        updateEndTime($('#test_start_hour'), $('#test_start_minute'), $('#test_end_hour'), $('#test_end_minute'));
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

    $('#test_end_hour').change(function () {
        var $selectEndHour = $(this);
        var $selectEndMinute = $('#test_end_minute');

        switch (isSelectedNow($selectEndHour, $selectEndMinute)){
            case 'now':
                disableOverdueMinutes(parseInt($('#test_start_minute').val()), $selectEndMinute);
                $selectEndMinute.attr('data-status', 'currentHour');
                break;
            case 'today':
                $selectEndMinute.attr('data-status', 'noCurrentHour');
                $selectEndMinute.find('option').css('display', 'inline');
                break;
        }
        if($selectEndHour.val() >  $('#test_start_hour').val()){
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
            $input.val( ui.item.name);
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
        var $modalAddFlight = $('#modalAddFlight');
        $modalAddFlight.find('h2').remove();
        $modalAddFlight.find('div').remove();
    });

    $addBtn.click(function () {
        showModalSelectOption();
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
        $('#conteiner-cancellation-flight').css('display', 'none');
        $('#conteiner-cancellation-test').css('display', 'none');

        $divContainer1.click(function () {
            $('.add').css('display','block');
            $('.detail').css('display', 'none');
            $('#flight-option').val('add');
            PROCESS_MESSAGE = 'Saving flight test';
            DONE_MESSAGE = 'Flight test successfully added!';
            $divBackground.remove();

            settingsFlightModal();

            showModalAnimation($('#modalAddFlight'), function(){

                google.maps.event.trigger(map, 'resize');
                map.setCenter({lat: -34.397, lng: 150.644});

            }, function(){
                $('#modalAddFlight').find('input, textarea').val('');
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

        $divContainer2.click(function () {
            $('.add').css('display','block');
            $('.detail').css('display', 'none');
            $('#test-option').val('add');
            PROCESS_MESSAGE = 'Saving test';
            DONE_MESSAGE = 'Test successfully added!';
            $divBackground.remove();

            settingsTestModal();

            showModalAnimation($('#modalAddTest'), null, function () {
                $('#modalAddTest').find('input, textarea').val('');
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

    window.settingsFlightModal = function (){
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

    };

    window.settingsTestModal = function (){
        var $selectHour = $('#test_start_hour');
        var $selectMinutes = $('#test_start_minute');
        var $selectHourEnd = $('#test_end_hour');
        var $selectMinutesEnd = $('#test_end_minute');

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
            $selectHour.trigger('change');
        }
        else {
            $([$selectHour, $selectMinutes, $selectHourEnd, $selectMinutesEnd]).each(function () {
                $(this).find('option:first').prop('selected',true);
            });
        }

    };

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
        showEventsByDate();
    });

    $(window).resize(function () {

    });

    function updateMonthYear() {
        $( '#custom-month' ).html( $( '#calendar' ).calendario('getMonthName') );
        $( '#custom-year' ).html( $( '#calendar' ).calendario('getYear'));
        vm.updateCalendarEvents();
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
                vm.updateCalendarEvents();
            });

        } );
        vm.updateCalendarEvents();
    });

    $('#calendar').on('shown.calendar.calendario', function(){
        $('div.fc-row > div').on('onDayClick.calendario', function(e, dateprop) {

            var $element = $(e.target);

            DAY_ELEMENT_SELECTED = $element.attr('data-id');

            if($element.find('.fc-emptydate').length === 0) {

                SELECTED_DATE = parseDateCalendarToJsDate(dateprop.year, dateprop.month, dateprop.day);

                highlightDaySelected($element);

                slideAndReturnAnimation($('#date-selected'), function () {
                    updateDateInfo(dateprop);
                });

                showEventsByDate();

            }

        });
    });

    var cal = $( '#calendar' ).calendario({
        checkUpdate : false,
        fillEmpty : true,
        displayWeekAbbr : true,
        events: ['click', 'focus'],
        feed: ''
    });

    function showEventsByDate(){
        vm.getEventsByDate().done(function (response) {

            var mappedEvents = $.map(response.events, function(item) {
                return new EventCalendar(item);
            });

            vm.currentEvents(mappedEvents);
        });
    }

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




