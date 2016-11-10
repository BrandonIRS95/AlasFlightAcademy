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

    self.showEvent = function(data, e){
        var dataType = $(e.currentTarget).attr('data-id');
        var $btnCancelBook = $('#cancelBooking');
        if(dataType === 'next') $btnCancelBook.css('display','inline');
        if(dataType === 'previous') $btnCancelBook.css('display','none');
        var event = data.eventable;
        $('.add').css('display','none');
        $('.detail').css('display', 'block');
        $('#conteiner-cancellation-flight').css('display', 'none');
        $('#conteiner-cancellation-test').css('display', 'none');

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
        $('#date-modal').html(dateTrans + ': ' + data.getFormatDate());
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

    };

    self.nextFlights = ko.observableArray();
    self.previousFlights = ko.observableArray();
    self.getNextFlights = function () {
      return $.ajax({
          url : urlGetNextFlights,
          type: 'GET'
      });
    };

    self.getPreviousFlights = function () {
      return $.ajax({
          url : urlGetPreviousFlights,
          type: 'GET'
      });
    }

    self.updateTables = function () {
      self.getNextFlights().done(function (response) {
        NOW = response.now;
        var mappedFlights = $.map(response.tests, function(item) {
            return new EventCalendar(item);
        });

        self.nextFlights(mappedFlights);
      });

      self.getPreviousFlights().done(function (response) {
        NOW = response.now;
        var mappedFlights = $.map(response.tests, function(item) {
            return new EventCalendar(item);
        });

        self.previousFlights(mappedFlights);
      });
    };

    self.cancelBookFlight = function () {
      var data = {
        flight: $('#id-flight').val(),
        _token: TOKEN
      };
      return $.ajax({
          url : urlCancelBookFlight,
          type: 'POST',
          data: data
      });
    };

    self.updateTables();

    return self;
}

function EventCalendar(data){
    var self = this;
    this.id = data.id;
    this.date = data.date;
    this.start = data.start;
    this.end = data.end;
    this.status = data.status;
    this.instructor = data.instructor;
    this.eventable = data.eventable;
    this.cancellation = data.cancellation_description;
    this.type = data.eventable_type;
    this.getFormatDate = function () {
      var now = moment(NOW).startOf('day');
      var tomorrow = moment(NOW).add(1,'days').startOf('day');
      var given = moment(this.date);
      if(now.isSame(given)) return 'Today';
      if(tomorrow.isSame(given)) return 'Tomorrow';
      return this.date;
    };
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
    this.getStatus = function () {
      var result = $.grep(statusArray, function(e){
        return e.status === self.status; });
      return result[0].trans;
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

    $('#cancelBooking').click(function () {
      var loadingAnimation = new loadingProcessAnimation();

      loadingAnimation.show('Cancelling book');

      vm.cancelBookFlight().done(function (response) {
        if(response.status === 0) {
          vm.updateTables();
          loadingAnimation.done('Cancel booking complete!', function () {
            $('#modalAddFlight').modal('hide');
          });
        }
      });
    });

    function parseDateCalendarToJsDate(year, month, day){
        return new Date(year, (month - 1), parseInt(day));
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
