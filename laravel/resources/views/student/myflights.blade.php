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
          height: 200px;
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
          <div class="table-responsive">
            <table class="table table-hover" id="nextFlights">
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
          <h4>Previous flights</h4>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-hover">
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
                <tr data-bind="click: $parent.showEvent" data-id="previous">
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

      <div id="modalAddFlight" class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          <div id="modalWrapper" class="modal-dialog" role="document">
              <div id="content-modal-add-event" class="modal-content custom-modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h2 class="modal-title detail">FLIGHT TEST DETAIL</h2>
                      <h4 id="date-modal"></h4>
                      <img class="modal-principal-icon" src="{{URL::to('svg/calendar/ic_airplanemode_active_white_48px.svg')}}">
                  </div>
                  <form  id="form-add-flight-test" autocomplete="off">
                  <div class="modal-body">
                          <div class="row">
                              <div class='col-sm-12'>
                                  <fieldset class="form-group">
                                      <legend>Route</legend>
                                      <div class='row'>
                                          <div class='col-sm-12'>
                                              <div class='form-group' style="position:relative;">
                                                  <div id="map"></div>
                                                  <input type="hidden" name="coordinates" id="coordinates">
                                              </div>
                                          </div>
                                      </div>
                                  </fieldset>
                              </div>
                          </div>
                      <fieldset class="form-group">
                          <legend>Flight information</legend>
                          <div class="row">
                              <div class="col-sm-12">
                                      <div class='row'>
                                          <div class='col-sm-6'>
                                              <div class='form-group'>
                                                  <label for="instructor">Instructor *</label>
                                                  <input class="form-control" id="flight_instructor" name="instructor" type="text" data-id="0" readonly="true"/>
                                              </div>
                                          </div>
                                          <div class='col-sm-6'>
                                              <div class='form-group'>
                                                  <label for="airplane">Airplane *</label>
                                                  <input class="form-control" id="flight_airplane" name="airplane" type="text" data-id="0" readonly="true"/>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-sm-12">
                                              <div class="form-group">
                                                  <label for="flight_description">Description</label>
                                                  <textarea id="flight_description" name="flight_description" class="form-control" readonly="true"></textarea>
                                              </div>
                                          </div>
                                      </div>
                                      <div class='row'>
                                          <div class='col-sm-6'>
                                              <fieldset class="form-group">
                                                  <legend>Start</legend>
                                                  <div class="col-xs-6 nopadding-left">
                                                      <div class='form-group'>
                                                          <label for="flight_start_hour">Hour</label>
                                                          <select class="form-control" id="flight_start_hour" name="flight_start_hour" disabled="true">
                                                              @for($x =0; $x < 24; $x++)
                                                                  <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                              @endfor
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="col-xs-6 nopadding-right">
                                                      <div class='form-group'>
                                                          <label for="start">Minute</label>
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
                                                  <legend>Finish</legend>
                                                  <div class="col-xs-6 nopadding-left">
                                                      <div class='form-group'>
                                                          <label for="start">Hour</label>
                                                          <select class="form-control" id="flight_end_hour" name="start" disabled="true">
                                                              @for($x =0; $x < 24; $x++)
                                                                  <option value="{{($x < 10 ? '0'.$x : $x)}}">{{($x < 10 ? '0'.$x : $x)}}</option>
                                                              @endfor
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="col-xs-6 nopadding-right">
                                                      <div class='form-group'>
                                                          <label for="start">Minute</label>
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
                                                  <label for="cost">Cost (USD) *</label>
                                                  <div class="input-group">
                                                      <span class="input-group-addon">$</span>
                                                      <input id="flight_cost" type="text" name="cost" class="form-control" readonly="true">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-sm-6 detail">
                                              <div class="form-group">
                                                  <label for="status">Status</label>
                                                  <select id="flight_status" name="status" class="form-control" disabled="true">
                                                      <option id="available-option" value="available">Available</option>
                                                      <option id="booked-option" value="booked">Booked</option>
                                                      <option value="canceled">Canceled</option>
                                                  </select>
                                              </div>
                                              <div id="conteiner-cancellation-flight" class="form-group" style="display: none;">
                                                  <label for="cancellation">Reason for cancellation *</label>
                                                  <textarea id="flight_cancellation" name="cancellation" class="form-control" readonly="true"></textarea>
                                              </div>
                                              <div class="form-group" id="conteiner-booked" style="display: none;">
                                                  <label for="student">Booked by</label>
                                                  <input id="student" name="student" class="form-control" readonly="true" />
                                              </div>
                                          </div>
                                      </div>
                              </div>
                          </div>
                      </fieldset>
                  </div>
                  <input type="hidden" id="id-flight">
                  <input type="hidden" id="flight-option">
                  <div class="modal-footer detail">
                      <button id="close-modal" type="button" class="btn btn-default custom-btn-default" data-dismiss="modal">Close</button>
                      <button id="cancelBooking" type="button" class="btn btn-primary custom-btn-primary">Cancel booking</button>
                  </div>
                  </form>
              </div>
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
  </script>
  <script type="text/javascript" src="{{URL::to('js/jquery-ui.min.js')}}"></script>
  <script src="{{URL::to('js/knockout-3.4.0.js')}}" type="text/javascript"></script>
  <script src="{{URL::to('js/moment.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript" src="{{URL::to('js/calendar/map.functions.js')}}"></script>
  <script type="text/javascript" src="{{URL::to('js/student/myflights.functions.js')}}"> </script>
  <script
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6KW7B-xPGNZIpgADTsdMfmhv0Yap_BeM&signed_in=true&libraries=drawing&callback=initMap">
  </script>
@endsection
