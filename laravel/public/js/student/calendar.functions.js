/**
 * Created by brandonirs on 28/09/2016.
 */

// TODO Cuando falten menos de 5 minutos para la siguiente hora arreglar bug, igual con los minutos

function CalendarViewModel() {
    var self = this;
    self.currentEvents = ko.observableArray([]);
    self.getClass = function (entry) {
        return 'status ' + entry.status.toString();
    };
    self.getIcon = function (entry) {
        return entry.type === 'App\\FlightTest' ? urlSvgCalendar + 'ic_airplanemode_active_light_48px.svg' : urlSvgCalendar + 'ic_content_paste_light_48px.svg';
    };
    self.getEventsByMonth = function(){
        var $calendar = $('#calendar');
        return $.ajax({
            url : urlGetEventsByMonth + $calendar.calendario('getMonth') + '/year/' + $calendar.calendario('getYear') + '/instructor/null',
            type: 'GET'
        });
    };

    self.getEventsByDate = function () {
        return $.ajax({
            url : urlGetEventsByDate + SELECTED_DATE.toString('yyyy-M-d') + '/instructor/null/status/' + $('.filtering-status .selected').attr('data-status') + '/type/' + $('.event-filter.selected').attr('data-event'),
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
        console.log(data);
        $('.add').css('display','none');
        $('.detail').css('display', 'block');
        $('#conteiner-cancellation-flight').css('display', 'none');
        $('#conteiner-cancellation-test').css('display', 'none');

        if(data.type === 'App\\FlightTest')
        {
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
            var airplane = event.airplane;
            var route = event.flight_route;
            $('#id-flight').val(data.eventable.id);
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
            if(data.status === 'canceled') $('#conteiner-cancellation-flight').css('display', 'inline');
            if (data.status === 'booked' || data.status === 'canceled') {
                $('#btnBookFlight').css('display','none');
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
                $('#btnBookFlight').css('display','inline');
                hideWeather();
            });
        }
        if (data.type === 'App\\Test')
        {
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

    self.bookFlight = function () {
        var data = {
            student: studentId,
            flight: $('#id-flight').val(),
            _token: TOKEN
        };

        return $.ajax({
            url : urlBookFlight,
            type: 'POST',
            data: data
        });
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

    $('#btnBookFlight').click(function(){

        var loadingAnimation = new loadingProcessAnimation();

        loadingAnimation.show('Booking flight test');

        vm.bookFlight().done(function(response){
            if(response.status === 0) {
                vm.updateCalendarEvents();
                loadingAnimation.done('Flight test successfully booked!',function () {
                        $('#modalAddFlight').modal('hide');
                });
            }
        });
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

    $('.filtering-status > div').click(function (e) {
        var $elementClicked = $(e.currentTarget);
        var $selectedStatus = $('#selectedStatus');
        $selectedStatus.removeAttr('id');
        $selectedStatus.attr('class','');
        $elementClicked.addClass('selected');
        $elementClicked.attr('id','selectedStatus');
        showEventsByDate();
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
        weeks : weeks,
        weekabbrs : weekabbrs,
        months : months,
        monthabbrs : monthabbrs,
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
        var normalArray = [4,5,6,7,8,9,0];
        var excArray = [11,12,13];

        if(normalArray.includes(firstDigit) || excArray.includes(parseInt(number)))
            return number + th;

        return number + specialArray[firstDigit - 1];

    }
});


// TODO al usar el autocomplete de jquery simplemente asigno el valor seleccionado a la variable del viewmodel (en el metodo select o change de autocomplete)
