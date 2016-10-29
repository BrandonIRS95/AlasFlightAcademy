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

    // POLY.GETPATH.GETARRAY TRAE TODOS LOS PUNTOS DE LA LINEA


var poly;
var map;
var addMarker = true;
var MARKERS = [];
window.NEW_ROUTE = false;
var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var MAP_CLICK_EVENT;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: {lat: 41.879, lng: -87.624}  // Center the map on Chicago, USA.
    });

    var lineSymbol = {
      path: 'M 0,-1 0,1',
      strokeOpacity: 1,
      strokeColor: '#1784c7',
      strokeWeight: '30px',
      scale: 2
    };

    poly = new google.maps.Polyline({
        strokeOpacity: 0,
        editable: true,
        icons: [{
          icon: lineSymbol,
          offset: '0',
          repeat: '10px'
        }]
    });
    poly.setMap(map);

    google.maps.event.addListener(poly.getPath(), 'set_at', function(event) {



    });

    google.maps.event.addListener(poly.getPath(), 'insert_at', function(event) {



    });

    google.maps.event.addListener(poly.getPath(), 'remove_at', function(event) {



    });

    google.maps.event.addListener(poly, 'rightclick', deleteNode);
    // Add a listener for the click event
}

var deleteNode = function(mev) {
    if (mev.vertex != null) {
        poly.getPath().removeAt(mev.vertex);
    }
    //poly.set('editable',false);
};

// Handles click events on a map, and adds a new point to the Polyline.
function addLatLng(event) {
    var path = poly.getPath();

    // Because path is an MVCArray, we can simply append a new coordinate
    // and it will automatically appear.
    path.push(event.latLng);



    // Add a new marker at the new plotted point on the polyline.
    if(addMarker) {
        var marker = new google.maps.Marker({
            position: event.latLng,
            label: 'A',
            map: map,
            draggable: true,
            index: 0
        });
        addMarker = false;
        MARKERS.push(marker);
        $('#coordinates').val('1').valid();
    }

}

window.drawMarkers = function(markers)
{
    map.setCenter(new google.maps.LatLng(parseFloat(markers[0].lat),parseFloat(markers[0].lng)));

    for(var x=0; x < markers.length; x++){
        var markerObj = markers[x];
        var marker = new google.maps.Marker({
            position: { lat: parseFloat(markerObj.lat), lng: parseFloat(markerObj.lng) },
            label: markerObj.label,
            map: map,
            draggable: false
        });
        MARKERS.push(marker);
        // $('#coordinates').val('1').valid();
    }
};

window.drawPoints = function(points){
    for(var x = 0; x < points.length; x++){
        var point = points[x];
        var path = poly.getPath();
        path.push(new google.maps.LatLng(parseFloat(point.lat),parseFloat(point.lng)));
    }

    poly.setEditable(false);
};

window.cleanDataInMap = function(){
    for (var i = 0; i < MARKERS.length; i++) {
        MARKERS[i].setMap(null);
    }
    //poly.setMap(null);
    poly.getPath().clear();
    MARKERS = [];
    addMarker = true;
};

function addMarkerLastCoordinates()
{
    if(poly.getPath().getArray().length > 0) {
        var marker = new google.maps.Marker({
            position: poly.getPath().getArray()[poly.getPath().getArray().length - 1],
            label: labels.charAt(MARKERS.length),
            map: map,
            draggable: true,
            index: MARKERS[MARKERS.length - 1].index + 1
        });

        MARKERS.push(marker);


        marker.addListener("rightclick", function () {
            if (marker.index < (MARKERS.length - 1)) {
                MARKERS.splice(marker.index, 1);
                for (var x = marker.index; x < MARKERS.length; x++) {
                    var auxMarker = MARKERS[x];
                    auxMarker.index = x;
                    auxMarker.setLabel(labels.charAt(x));
                }
            }
            else MARKERS.splice(marker.index, 1);
            marker.setMap(null);
        });
    }
}
