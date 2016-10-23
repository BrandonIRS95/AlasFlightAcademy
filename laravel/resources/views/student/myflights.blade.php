@extends('layouts.master-student')
@section('individual-styles')
    <style media="screen">
      #conteiner-calendar-events{
        bottom: auto;
      }
    </style>
    @endsection
@section('content')
    <div id="conteiner-calendar-events" class="container">
      <div class="page-header">
        <h1>My flights</h1>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Next flights</h4>
        </div>
        <div class="panel-body">
          <table class="table" id="nextFlights">
            <thead>
              <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Instructor</th>
                <th>Airplane</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody data-bind="foreach: nextFlights">
              <tr>
                <td data-bind="text: getFormatDate()"></td>
                <td data-bind="text: timeFormat()"></td>
                <td data-bind="text: instructorFullName()"></td>
                <td data-bind="text: eventable.airplane.name"></td>
                <td data-bind="text: status" style="text-transform: capitalize;"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Previous flights</h4>
        </div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Instructor</th>
                <th>Airplane</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody data-bind="foreach: previousFlights">
              <tr>
                <td data-bind="text: getFormatDate()"></td>
                <td data-bind="text: timeFormat()"></td>
                <td data-bind="text: instructorFullName()"></td>
                <td data-bind="text: eventable.airplane.name"></td>
                <td data-bind="text: status" style="text-transform: capitalize;"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
    @endsection

@section('javascript')
  <script src="{{URL::to('js/knockout-3.4.0.js')}}" type="text/javascript"></script>
  <script src="{{URL::to('js/moment.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript">
    var urlGetNextFlights = '{{route('getNextFlights')}}';
    var urlGetPreviousFlights = '{{route('getPreviousFlights')}}';
    var NOW = null;
    function MyFlightsVM() {
      var self = this;
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

      self.getNextFlights().done(function (response) {
        console.log(response);
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
    }

    var vm = new MyFlightsVM();

    ko.applyBindings(vm);

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
    }
  </script>
@endsection
