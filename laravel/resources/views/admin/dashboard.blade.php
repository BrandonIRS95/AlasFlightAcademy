
@extends('layouts.master-admin')
@section('title-view')

    @endsection
@section('content')

        <!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0">
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
<!--<input type="text" id="cordenadax" value="">
  <input type="text" id="cordenaday" >-->
<input class="pull-right" type='text' id='name' value=''>
<input class="pull-right" type='text' id='cordenadax' value=''>
<input class="pull-right" type='text' id='cordenaday' value=''>
<input class="pull-right" type="button"  onclick="localizar();" value="localizar">
<div class="pull-right" id="map" style="width: 50%;height: 50%;"></div>
<script>
    function localizar(){
        navigator.geolocation.watchPosition(showPosition);
        document.getElementById("name").value = "mi ubicacion";
        initMap();
    }
    function showPosition(position){
        document.getElementById("cordenadax").value = position.coords.latitude;
        document.getElementById("cordenaday").value = position.coords.longitude;
    }
    var map;
    var marker;
    function initMap() {
        var cordenadax = document.getElementById("cordenadax").value;
        var cordenaday = document.getElementById("cordenaday").value;
        map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(32.715,-117.1625),
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
        var place = new google.maps.LatLng(32.715,-117.1625);
        marker = new google.maps.Marker({
            position: place ,
            title: "my ubication",
            map: map,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        google.maps.event.addListener(marker,"click",showInfo);
    }
    function showInfo() {
        map.setZoom(5);
        map.setCenter(marker.getPosition());
        var infowindow = new google.maps.InfoWindow({
            content: "ubicacion del arduino"});
        infowindow.open(map,marker);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjBKcrrs3pz18wuE-u41gD8n-GOZsac1g&callback=initMap"
        async defer></script>
</body>
</html>
    @endsection