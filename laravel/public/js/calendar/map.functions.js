/*var map;

window.onload = function () {
    initMap();
}

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 8
    });

    var drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.MARKER,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                google.maps.drawing.OverlayType.MARKER,
                google.maps.drawing.OverlayType.CIRCLE,
                google.maps.drawing.OverlayType.POLYGON,
                google.maps.drawing.OverlayType.POLYLINE,
                google.maps.drawing.OverlayType.RECTANGLE
            ]
        },
        //markerOptions: {icon: 'images/beachflag.png'},
        circleOptions: {
            fillColor: '#ffff00',
            fillOpacity: 1,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1
        },
        polylineOptions:{
            editable: true
        }
    });

    google.maps.event.addListener(drawingManager, 'polylinecomplete', function(line) {
    console.log(line.getPath().getArray().toString());

    });


    google.maps.event.addListener(drawingManager, 'insert_at', function(vertex) {
        console.log('Vertex' + vertex + ' inserted to path.');
    });

    google.maps.event.addListener(drawingManager, 'set_at', function(vertex) {
        console.log('Vertex' + vertex + ' updated on path.');
    });

    drawingManager.setMap(map);
}*/


var poly;
var map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: {lat: 41.879, lng: -87.624}  // Center the map on Chicago, USA.
    });

    poly = new google.maps.Polyline({
        strokeColor: '#000000',
        strokeOpacity: 1.0,
        strokeWeight: 3,
        editable: true
    });
    poly.setMap(map);

    google.maps.event.addListener(poly.getPath(), 'set_at', function(event) {
        console.log('Vertex moved on outer path.');
        console.log(event);
        console.log(poly.getPath().getArray().toString());
    });

    google.maps.event.addListener(poly.getPath(), 'insert_at', function(event) {
        console.log('Vertex insert at from inner path.');
        console.log(event);
        console.log(poly.getPath().getArray().toString());
    });

    google.maps.event.addListener(poly.getPath(), 'remove_at', function(event) {
        console.log('Vertex remove at from inner path.');
        console.log(event);
        console.log(poly.getPath().getArray().toString());
    });

    google.maps.event.addListener(poly, 'rightclick', deleteNode);
    // Add a listener for the click event
    map.addListener('click', addLatLng);
}

var deleteNode = function(mev) {
    if (mev.vertex != null) {
        poly.getPath().removeAt(mev.vertex);
    }
    //poly.set('editable',false);
}

// Handles click events on a map, and adds a new point to the Polyline.
function addLatLng(event) {
    var path = poly.getPath();

    // Because path is an MVCArray, we can simply append a new coordinate
    // and it will automatically appear.
    path.push(event.latLng);

    // Add a new marker at the new plotted point on the polyline.
    /*var marker = new google.maps.Marker({
        position: event.latLng,
        title: '#' + path.getLength(),
        map: map
    });*/
}
