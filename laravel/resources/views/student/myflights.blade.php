@extends('layouts.master-student')
@section('individual-styles')
    <link rel="stylesheet" type="text/css" href="{{URL::to('css/jquery-ui.min.css')}}" />
    <style media="screen">
      #conteiner-calendar-events{
        bottom: auto;
      }

      .custom-modal-content {
          border-radius: 0;
          background: #1784c7;
          color: #FFFFFF;
      }
      .custom-modal-content .modal-header {
          border-bottom: none;
      }
      .modal-principal-icon {
          position: absolute;
          right: 30px;
          top: 30px;
      }
      #map {
          width: 100%;
          height: 270px;
      }
      #ta-route-description, #flight_description, #test_description, #flight_cancellation, #test_cancellation {
          resize: vertical;
      }
      #modalAddFlight fieldset legend, #modalAddTest fieldset legend {
          color: white;
      }
      legend {
          border-bottom: 1px dotted #e5e5e5;
      }
      .nopadding-right {
          padding-right: 0px;
      }
      .nopadding-left {
          padding-left: 0px;
      }
      #flight_cost {
          text-align: right;
      }
      .custom-modal-content .custom-btn-default, #cancel-new-route {
          background: transparent;
          border-radius: 0px;
          border: 1px solid #ffffff;
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
          color: #fff;
      }
      .modal-footer .btn + .btn {
          margin-bottom: 0;
          margin-left: 5px;
      }
      .custom-modal-content .custom-btn-primary, .custom-modal-content .custom-btn-default {
          min-width: 100px;
      }
      .custom-modal-content .custom-btn-primary {
          background: #FF9410;
          border-color: transparent;
          border-radius: 3px;
      }
      .custom-modal-content .modal-footer {
          border-top: none;
      }

      h4, th {
        color: #9aa5af;
      }

      h1 {
        color: #87939e;
      }

      #date-modal{
        color: #fff;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="{{URL::to('css/calendar/weather.css')}}" />
    @endsection
@section('content')
    <div id="conteiner-calendar-events" class="container">
      <div class="page-header">
        <h1>{!! trans('myflights.title') !!}</h1>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>{!! trans('myflights.next_flights') !!}</h4>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-hover" id="nextFlights">
              <thead>
                <tr>
                  <th>{!! trans('flightform.date') !!}</th>
                  <th>{!! trans('flightform.time') !!}</th>
                  <th>{!! trans('flightform.instructor') !!}</th>
                  <th>{!! trans('flightform.airplane') !!}</th>
                  <th>{!! trans('flightform.status') !!}</th>
                </tr>
              </thead>
              <tbody data-bind="foreach: nextFlights">
                <tr data-bind="click: $parent.showEvent" data-id="next">
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

      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>{!! trans('myflights.prev_flights') !!}</h4>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>{!! trans('flightform.date') !!}</th>
                  <th>{!! trans('flightform.time') !!}</th>
                  <th>{!! trans('flightform.instructor') !!}</th>
                  <th>{!! trans('flightform.airplane') !!}</th>
                  <th>{!! trans('flightform.status') !!}</th>
                </tr>
              </thead>
              <tbody data-bind="foreach: previousFlights">
                <tr data-bind="click: $parent.showEvent" data-id="previous">
                  <td data-bind="text: getFormatDate()"></td>
                  <td data-bind="text: timeFormat()"></td>
                  <td data-bind="text: instructorFullName()"></td>
                  <td data-bind="text: eventable.airplane.name"></td>
                  <td data-bind="text: getStatus()" style="text-transform: capitalize;"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div id="modalAddFlight" class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          <div id="modalWrapper" class="modal-dialog" role="document">
              <div id="content-modal-add-event" class="modal-content custom-modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h2 class="modal-title detail">{{trans('flightform.title')}}</h2>
                      <h4 id="date-modal"></h4>
                      <img class="modal-principal-icon" src="{{URL::to('svg/calendar/ic_airplanemode_active_white_48px.svg')}}">
                  </div>
                  <form  id="form-add-flight-test" autocomplete="off">
                      <div class="modal-body">
                          <div class="row">
                              <div class='col-sm-12'>
                                  <fieldset class="form-group">
                                      <legend>{{trans('flightform.route')}}</legend>
                                      <div class='row'>
                                          <div class='col-sm-12'>
                                              <div class='form-group' style="position:relative; overflow-y: hidden;">
                                                  <div id="map"></div>
                                                  @include('includes.weather')
                                                  <input type="hidden" name="coordinates" id="coordinates">
                                              </div>
                                          </div>
                                      </div>
                                  </fieldset>
                              </div>
                          </div>
                          <fieldset class="form-group">
                              <legend>{{trans('flightform.information')}}</legend>
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class='row'>
                                          <div class='col-sm-6'>
                                              <div class='form-group'>
                                                  <label for="instructor">{{trans('flightform.instructor')}}</label>
                                                  <input class="form-control" id="flight_instructor" name="instructor" type="text" data-id="0" readonly/>
                                              </div>
                                          </div>
                                          <div class='col-sm-6'>
                                              <div class='form-group'>
                                                  <label for="airplane">{{trans('flightform.airplane')}}</label>
                                                  <input class="form-control" id="flight_airplane" name="airplane" type="text" data-id="0" readonly/>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-12">
                                              <div class="form-group">
                                                  <label for="flight_description">{{trans('flightform.description')}}</label>
                                                  <textarea id="flight_description" name="flight_description" class="form-control" readonly></textarea>
                                              </div>
                                          </div>
                                      </div>
                                      <div class='row'>
                                          <div class='col-sm-6'>
                                              <fieldset class="form-group">
                                                  <legend>{{trans('flightform.start')}}</legend>
                                                  <div class="col-xs-6 nopadding-left">
                                                      <div class='form-group'>
                                                          <label for="flight_start_hour">{{trans('flightform.hour')}}</label>
                                                          <select class="form-control" id="flight_start_hour" name="flight_start_hour" disabled="true">
                                                              @for($x =0; $x < 24; $x++)
                                                                  <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                              @endfor
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="col-xs-6 nopadding-right">
                                                      <div class='form-group'>
                                                          <label for="start">{{trans('flightform.minute')}}</label>
                                                          <select class="form-control" id="flight_start_minute" name="start" disabled="true">
                                                              @for($x =0; $x < 60; $x+=5)
                                                                  <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                              @endfor
                                                          </select>
                                                      </div>
                                                  </div>
                                              </fieldset>
                                          </div>
                                          <div class='col-sm-6'>
                                              <fieldset class="form-group">
                                                  <legend>{{trans('flightform.finish')}}</legend>
                                                  <div class="col-xs-6 nopadding-left">
                                                      <div class='form-group'>
                                                          <label for="start">{{trans('flightform.hour')}}</label>
                                                          <select class="form-control" id="flight_end_hour" name="start" disabled="true">
                                                              @for($x =0; $x < 24; $x++)
                                                                  <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                              @endfor
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="col-xs-6 nopadding-right">
                                                      <div class='form-group'>
                                                          <label for="start">{{trans('flightform.minute')}}</label>
                                                          <select class="form-control" id="flight_end_minute" name="start" disabled="true">
                                                              @for($x =0; $x < 60; $x+=5)
                                                                  <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                              @endfor
                                                          </select>
                                                      </div>
                                                  </div>
                                              </fieldset>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-6">
                                              <div class="form-group">
                                                  <label for="cost">{{trans('flightform.cost')}} ({{trans('flightform.usd')}})</label>
                                                  <div class="input-group">
                                                      <span class="input-group-addon">$</span>
                                                      <input id="flight_cost" type="text" name="cost" class="form-control" readonly>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 detail">
                                              <div class="form-group">
                                                  <label for="status">{{trans('flightform.status')}}</label>
                                                  <select id="flight_status" name="status" class="form-control" disabled="true">
                                                      <option value="available">{!! trans('flightform.available') !!}</option>
                                                      <option value="booked">{!! trans('flightform.booked') !!}</option>
                                                      <option value="canceled">{!! trans('flightform.canceled') !!}</option>
                                                  </select>
                                              </div>
                                              <div id="conteiner-cancellation-flight" class="form-group" style="display: none;">
                                                  <label for="cancellation">{{trans('flightform.reason_cancellation')}}</label>
                                                  <textarea id="flight_cancellation" name="cancellation" class="form-control" readonly></textarea>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </fieldset>
                      </div>
                      <input type="hidden" id="id-flight">
                      <input type="hidden" id="flight-option">
                      <div class="modal-footer">
                          <button id="close-modal" type="button" class="btn btn-default custom-btn-default" data-dismiss="modal">{{trans('flightform.close')}}</button>
                          <button id="cancelBooking" type="button" class="btn btn-primary custom-btn-primary">{!! trans('flightform.cancel_booking') !!}</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    @endsection

@section('javascript')
  <script type="text/javascript">
    var urlGetNextFlights = '{{route('getNextFlights')}}';
    var urlGetPreviousFlights = '{{route('getPreviousFlights')}}';
    var urlCancelBookFlight = '{{route('cancelBookFlight')}}';
    var TOKEN = '{{ Session::token() }}';
    var NOW = null;
    var urlSvgCalendar = urlSvgImages + '/calendar/';
    window.dateTrans = '{{trans('flightform.date')}}';
    var statusArray = [
      {'status' : 'available', 'trans' : '{{trans('flightform.available')}}'},
      {'status' : 'booked', 'trans' : '{{trans('flightform.booked')}}'},
      {'status' : 'canceled', 'trans' : '{{trans('flightform.canceled')}}'}
    ];
  </script>
  <script type="text/javascript" src="{{URL::to('js/jquery-ui.min.js')}}"></script>
  <script src="{{URL::to('js/knockout-3.4.0.js')}}" type="text/javascript"></script>
  <script src="{{URL::to('js/moment.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript" src="{{URL::to('js/calendar/map.functions.js')}}"></script>
  <script type="text/javascript" src="{{URL::to('js/student/myflights.functions.js')}}"> </script>
            <script type="text/javascript" src="{{URL::to('js/calendar/date.js')}}"></script>
            <script type="text/javascript" src="{{URL::to('js/calendar/weather.js')}}"> </script>
  <script
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6KW7B-xPGNZIpgADTsdMfmhv0Yap_BeM&signed_in=true&libraries=drawing&callback=initMap">
  </script>
@endsection
