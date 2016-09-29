/**
 * Created by brandonirs on 28/09/2016.
 */

// TODO Cuando falten menos de 5 minutos para la siguiente hora arreglar bug, igual con los minutos
// TODO Si no es la hora actual no esconder los minutos
// TODO Al seleccionar un dia del calendario, actualizar la vista y la variable CURRENT-DAY-SELECTED

$(function() {

    var SELECTED_DATE = new Date();
    var RANGE_OF_MINUTES = 5;

    $('document').ready(function(){
        var $selectHour = $('#flight_start_hour');
        var $selectMinutes = $('#flight_start_minute');
        disableOverdueHours(SELECTED_DATE.getHours(), $selectHour);
        disableOverdueMinutes(SELECTED_DATE.getMinutes(), $selectMinutes);
        disableOverdueHours(parseInt($selectHour.val()), $('#flight_end_hour'));
        disableOverdueMinutes(parseInt($selectMinutes.val()), $('#flight_end_minute'));
    });

    /** <!-- FLIGHT TEST ...*/

    $('#flight_start_hour').change(function () {
        var $select = $('#flight_end_hour');
        $select.find('option').css('display','inline');
        disableOverdueHours(parseInt($(this).val()), $select);
    });

    $('#flight_start_minute').change(function(){
        var $select = $('#flight_end_minute');
        $select.find('option').css('display','inline');
        disableOverdueMinutes(parseInt($(this).val()), $select);
    });

    $( "#flight_instructor" ).autocomplete({
        minLength: 0,
        source: function( request, response ) {
            if(request.term !== '') $.ajax( {
                url: urlGetInstructors + '/' + request.term,
                method: "GET",
                success: function( data ) {
                    console.log(data);
                    response(data.instructors);
                }
            } );
        },
        focus: function( event, ui ) {
            return false;
        },
        select: function( event, ui ) {
            var $input = $( "#flight_instructor" );
            $input.val( ui.item.person.first_name + ' ' + ui.item.person.last_name);
            $input.attr('data-id',ui.item.id);
            return false;
        }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<div>" + item.person.first_name + ' ' + item.person.last_name + "</div>" )
            .appendTo( ul );
    };

    $( "#flight_airplane" ).autocomplete({
        minLength: 0,
        source: function( request, response ) {
            if(request.term !== '') $.ajax( {
                url: urlGetAirplanes + '/' + request.term,
                method: "GET",
                success: function( data ) {
                    console.log(data);
                    response(data.airplanes);
                }
            } );
        },
        focus: function( event, ui ) {
            /*$( "#project" ).val( ui.item.label );*/
            return false;
        },
        select: function( event, ui ) {
            var $input = $( "#flight_airplane" );
            $input.val( ui.item.plate);
            $input.attr('data-id',ui.item.id);
            return false;
        }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<div>" + item.plate + "</div>" )
            .appendTo( ul );
    };

    /*-->*/

    var $addBtn = $('#add-btn');

    function disableOverdueHours(hour, $hourSelect){
        var $arrayOptions = $hourSelect.find('option');
        var index = hour - 1;

        for(var x = index; x >= 0 ; x--){
            $($arrayOptions[x]).css('display','none');
        }

        $($arrayOptions[hour]).prop('selected', true);
    }

    function disableOverdueMinutes(minute, $minuteSelect) {
        var $arrayOptions = $minuteSelect.find('option');
        var startIndex = Math.floor(minute / RANGE_OF_MINUTES);
        //startIndex += 1;
        for (var x = startIndex; x >= 0; x--) {
            $($arrayOptions[x]).css("display", "none");
        }

        console.log(startIndex);

        $($arrayOptions[startIndex + 1]).prop('selected', true);
    }

    $('#add-marker-btn').click(function(){
        addMarkerLastCoordinates();
    });

    $('#btn-add-flight').click(function () {
        var $modalAddEvent = $('#modalAddEvent');
        $modalAddEvent.find('h2').remove();
        $modalAddEvent.find('div').remove();
    });

    $addBtn.click(function () {
        showModalAnimation($('#modalAddEvent'), function(){
            google.maps.event.trigger(map, 'resize');
            map.setCenter({lat: -34.397, lng: 150.644});
        }, function(){
            $('#modalAddEvent').find('input, textarea').val('');
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
            }
            //poly.setMap(null);
            poly.getPath().clear();
            markers = [];
            addMarker = true;
        });
    });

    $('.filtering-status > div').click(function (e) {
        var $elementClicked = $(e.currentTarget);
        var $selectedStatus = $('#selectedStatus');
        $selectedStatus.removeAttr('id');
        $selectedStatus.attr('class','');
        $elementClicked.addClass('selected');
        $elementClicked.attr('id','selectedStatus');
    });

    $('.conteiner-events').jScrollPane();

    $(window).resize(function () {
        $('.conteiner-events').jScrollPane();
    });

    function updateMonthYear() {
        $( '#custom-month' ).html( $( '#calendar' ).calendario('getMonthName') );
        $( '#custom-year' ).html( $( '#calendar' ).calendario('getYear'));
    }

    $(document).on('finish.calendar.calendario', function(e){
        $( '#custom-month' ).html( $( '#calendar' ).calendario('getMonthName') );
        $( '#custom-year' ).html( $( '#calendar' ).calendario('getYear'));
        $( '#custom-next' ).on( 'click', function() {
            $( '#calendar' ).calendario('gotoNextMonth', updateMonthYear);
        } );
        $( '#custom-prev' ).on( 'click', function() {
            $( '#calendar' ).calendario('gotoPreviousMonth', updateMonthYear);
        } );
        $( '#custom-current' ).on( 'click', function() {
            $( '#calendar' ).calendario('gotoNow', updateMonthYear);
        } );
    });

    $('#calendar').on('shown.calendar.calendario', function(){
        $('div.fc-row > div').on('onDayClick.calendario', function(e, dateprop) {

            var $element = $(e.target);

            if($element.find('.fc-emptydate').length === 0) {
                var $lastDaySelected = $('#lastDaySelected');
                $lastDaySelected.css('background', 'transparent');
                $lastDaySelected.find('span').css('color', '#a4afb9');
                $lastDaySelected.removeAttr('id');

                $element.css('background', '#1784c7');
                $element.find('span').css('color', '#fff');
                $element.attr('id', 'lastDaySelected');
            }

        });
    });

    var $calendar = $( '#calendar' ).calendario({
        checkUpdate : false,
        caldata : events,
        fillEmpty : true,
        displayWeekAbbr : true,
        events: ['click', 'focus']
    });
});
