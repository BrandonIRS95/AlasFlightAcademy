
@extends('layouts.master-admin')
@section('title-view')
        <!DOCTYPE html>
<html>
<head>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- jQuery 2.2.3 -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="css/AdminLTE.css">

    <meta charset="utf-8">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }

    </style>
</head>
<body>
<!-- Small boxes (Stat box) -->
<!-- CSRF Token -->
<input  type="hidden" name="_token" value="{{ Session::token() }}">
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!--<input type="text" id="cordenadax" value="">
  <input type="text" id="cordenaday" >-->
<div style="width: 100%;">
    <!-- TO DO List -->
    <div  class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>

            <h3 class="box-title">To Do List</h3>

            <div class="box-tools pull-right" style="margin-bottom: 10px;">
                {!! $posts->render() !!}
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ul class="todo-list">
                @foreach($posts as $post)
                    <li id="thing{{$post->id}}">
                    <!-- drag handle -->
                    <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                    <!-- checkbox -->
                    <input type="checkbox" value="">
                    <!-- todotext -->
                        <td class="post"  data-id="">{{$post->description}}</td>
                    <!-- Emphasis label -->
                    <small class="label label-danger"><i class="fa fa-clock-o"></i> {{$post->start_date}}</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                       <i onclick="deleteThing({{$post->id}})" class="fa fa-trash fa-lg"></i>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
            <button data-toggle="modal" data-target="#Modal" type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
        </div>
    </div>

    <div class="pull-right"  id="map" style="width: 50%;height: 60.5%;"></div>
</div>
<!-- Modal -->
<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div style="text-align: center;font-size: 20px;font-weight: bold;">Add thing to do</div>
            </div>
            <div class="modal-body" style="text-align: center;">
                <label>Description : </label>
                <input id="descriptionThing" class="form-control" type="text" id="description">
            </div>
            <div class="modal-footer">
                <button id="addThing" type="submit" class="btn btn-primary" >Accept</button>
            </div>
        </div>

    </div>
</div>
<script>
    var locations = [
        ['ca'],
        ['Republica Dominicana'],
        ['china'],
        ['brazil'],
        ['Tijuana, Mexico']
    ];
    var i = 0;
    /* function localizar(){
     navigator.geolocation.watchPosition(showPosition);
     document.getElementById("name").value = "mi ubicacion";
     initMap();
     }
     function showPosition(position){
     document.getElementById("cordenadax").value = position.coords.latitude;
     document.getElementById("cordenaday").value = position.coords.longitude;
     }*/
    var map;
    var marker;
    function initMap() {

        //var cordenadax = document.getElementById("cordenadax").value;
        //var cordenaday = document.getElementById("cordenaday").value;
        map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(-34.397, 150.644),
            zoom: 1,
            styles: [
                {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                {
                    featureType: 'administrative.locality',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#d59563'}]
                },
                {
                    featureType: 'poi',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#d59563'}]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'geometry',
                    stylers: [{color: '#263c3f'}]
                },
                {
                    featureType: 'poi.park',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#6b9a76'}]
                },
                {
                    featureType: 'road',
                    elementType: 'geometry',
                    stylers: [{color: '#38414e'}]
                },
                {
                    featureType: 'road',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#212a37'}]
                },
                {
                    featureType: 'road',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#9ca5b3'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry',
                    stylers: [{color: '#746855'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.stroke',
                    stylers: [{color: '#1f2835'}]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#f3d19c'}]
                },
                {
                    featureType: 'transit',
                    elementType: 'geometry',
                    stylers: [{color: '#2f3948'}]
                },
                {
                    featureType: 'transit.station',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#d59563'}]
                },
                {
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{color: '#17263c'}]
                },
                {
                    featureType: 'water',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#515c6d'}]
                },
                {
                    featureType: 'water',
                    elementType: 'labels.text.stroke',
                    stylers: [{color: '#17263c'}]
                }
            ]
        });
        var geocoder = new google.maps.Geocoder();

        $(function() {
            geocodeAddress(geocoder, map);
        });

    }
    function showInfo() {
        map.setZoom(5);
        map.setCenter(marker.getPosition());
        var infowindow = new google.maps.InfoWindow({
            content: "ubicacion del arduino"});
        infowindow.open(map,marker);
    }
    function geocodeAddress(geocoder, resultsMap) {
        var address = locations;

        for( i = 0;i < locations.length; i++)
        {
            geocoder.geocode({'address': address[i][0].toString()}, function (results, status) {
                if (status === 'OK') {
                    resultsMap.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: resultsMap,
                        title:"visitors",
                        position: results[0].geometry.location
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    }
    //variables
    var token = '{{Session::token()}}';
    var url  = '{{route('deletethings')}}';
    var url2 = '{{route('addThing')}}';
    var url3 = '{{route('AddressState')}}';
    function deleteThing(id) {
        $('#thing' + id).click(function () {
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': token},
                data: {'id' : id},
                type: 'POST',
                success: function( msg ) {
                    if ( msg.status === 'success' ) {
                        $('#thing' + id).hide();
                    }
                },
                error: function( data ) {
                    if ( data.status === 422 ) {
                        toastr.error('Cannot delete the category');
                    }
                }
            });
        });
    }
    $('#addThing').click(function () {
        var descripcion = document.getElementById('descriptionThing').value;
            $.ajax({
                url: url2,
                headers: {'X-CSRF-TOKEN': token},
                data: {'descripcion' : descripcion},
                type: 'POST',
                success: function( msg ) {
                    if ( msg.status === 'success' ) {
                        window.reload();
                    }
                },
                error: function( data ) {
                    if ( data.status === 422 ) {
                        alert('Cannot delete the category');
                    }
                }
            });
        location.reload();
    });
    $( document ).ready(function() {
        getAirplaneById().done(function (response) {
            console.log(response);
            // $('.modal-body').html(response.contact.email);
        });
    });
    function getAirplaneById() {
        $.ajax({
            method: 'get',
            url: url3
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjBKcrrs3pz18wuE-u41gD8n-GOZsac1g&callback=initMap"
        async defer></script>

</body>
</html>
    @endsection
@section('content')


    @endsection