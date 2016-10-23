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
            <tbody>
              <tr>
                <td>2016-05-12</td>
                <td>22:05 - 22:30</td>
                <td>Maria Guadalupe</td>
                <td>Superman</td>
                <td>
                  Available
                </td>
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
            <tbody>
              <tr>
                <td>2016-05-12</td>
                <td>22:05 - 22:30</td>
                <td>Maria Guadalupe</td>
                <td>Superman</td>
                <td>
                  Canceled
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
    @endsection

@section('javascript')
  <script src="{{URL::to('js/knockout-3.4.0.js')}}" type="text/javascript"></script>
  <script type="text/javascript">
    var urlGetNextFlights = '{{route('getNextFlights')}}';

    function MyFlightsVM() {
      var self = this;
      self.getNextFlights = function () {
        return $.ajax({
            url : urlGetNextFlights,
            type: 'GET'
        });
      };
    }

    var vm = new MyFlightsVM();

    vm.getNextFlights().done(function (response) {
      console.log(response);
    });


  </script>
@endsection
