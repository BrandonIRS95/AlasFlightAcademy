var lastDaySelected;
var currentDaySelected;

$(function() {
    var transEndEventNames = {
            'WebkitTransition' : 'webkitTransitionEnd',
            'MozTransition' : 'transitionend',
            'OTransition' : 'oTransitionEnd',
            'msTransition' : 'MSTransitionEnd',
            'transition' : 'transitionend'
        },
        transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
        $wrapper = $( '#custom-inner' ),
        $calendar = $( '#calendar' ),
        cal = $calendar.calendario( {
            onDayClick : function( $el, $contentEl, dateProperties ) {
                
                $div = $contentEl.context;
                
                console.log(dateProperties);
                
                localStorage.setItem('daySelected', dateProperties.day);
                localStorage.setItem('monthSelected', dateProperties.month);
                localStorage.setItem('monthNameSelected', dateProperties.monthname);
                localStorage.setItem('yearSelected', dateProperties.year);
                
                if(currentDaySelected != null) 
                {
                    lastDaySelected = currentDaySelected;
                    lastDaySelected.style.background = 'white';
                }
                if($div.className !== 'fc-today ')
                {
                    currentDaySelected = $div;
                    currentDaySelected.style.background = '#ddd';
                }
                
                $('#content-date-selected').html('EVENTS FOR ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year);
                    
                /*if( $contentEl.length > 0 ) {
                    showEvents( $contentEl, dateProperties );
                }*/
            },
            caldata : codropsEvents,
            displayWeekAbbr : true
        } ),
        $month = $( '#custom-month' ).html( cal.getMonthName() ),
        $year = $( '#custom-year' ).html( cal.getYear() );

    $( '#custom-next' ).on( 'click', function() {
        cal.gotoNextMonth( updateMonthYear );
        
    } );
    $( '#custom-prev' ).on( 'click', function() {
        cal.gotoPreviousMonth( updateMonthYear );
    } );
    
    $('#content-date-selected').html('EVENTS FOR ' + cal.getMonthName() + ' ' + new Date().getDate() + ', ' + cal.getYear());

    function updateMonthYear() {				
        $month.html( cal.getMonthName() );
        $year.html( cal.getYear() );
    }

    // just an example..
    function showEvents( $contentEl, dateProperties ) {

        hideEvents();

        var $events = $( '<div id="custom-content-reveal" class="custom-content-reveal"><h4>Events for ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>' ),
            $close = $( '<span class="custom-content-close"></span>' ).on( 'click', hideEvents );

        $events.append( $contentEl.html() , $close ).insertAfter( $wrapper );

        setTimeout( function() {
            $events.css( 'top', '0%' );
        }, 25 );
    }
    
    function hideEvents() {

        var $events = $( '#custom-content-reveal' );
        if( $events.length > 0 ) {

            $events.css( 'top', '100%' );
            Modernizr.csstransitions ? $events.on( transEndEventName, function() { $( this ).remove(); } ) : $events.remove();
        }
    }

    $('#addEventBtn').click(

        /*cal.setData( {
            '05-29-2016' : '<a/>',
            '05-27-2016' : '<a/>',
            '05-27-2016' : '<a/>'
        } );
        // goes to a specific month/year
        cal.goto( 04, 2016, updateMonthYear );*/
        
        /*var $content = $("<div>");
        showModal($content);*/
        
        function() {
            var $triangleBack = $('#triangle-box');
            var $triangleFront = $('#triangle-box-front');
            
            $('#content-add-options').css('display', 'inline');
            TweenMax.to([$triangleBack, $triangleFront], 0.2, {width: '65px', height: '65px'});
            TweenMax.to($('#content-popup-options'), 0.1, {height: '130px'});
            TweenMax.to($('#close-add-options'), 0.4, {rotation: 180});
            TweenMax.to($('.buttons-options-popup'), 0.2, {width: '50px', height: '50px'});
            TweenMax.to($('.buttons-options-popup img'), 0.2, {scale: 1, delay:0.1});
            
          } 
       

    );
    
    $('#content-add-options').mouseleave(function() {
        hideOptionsPopup();
    } );
    
    /*$('#close-add-options').click(function(){
        hideOptionsPopup();
    });*/
    
    $('#add-test-btn').click(function(){
        showModal($('<div></div>'));
    });
    
    $('#add-flight-btn').click(function(){
        
        /*var $divContent = $('<div>', {id: "content-popup", class: "popup-add-event"});
        
        var $title = $('<div>', {id: "title-add-flight", class: "title-popup-add-event"});
        $title.html("ADD FLIGHT");
        $divContent.append($title);
        
        var $imgIcon = $("<img>", {class: "icon-popup", src: "images/white-plane-icon.png"})
        $divContent.append($imgIcon);
        
        var $datePopup = $('<div>', {id: "date-popup-add-flight"});
        $datePopup.html("JUNE");
        $divContent.append($datePopup);
        
        var $titleFlightTime = $('<div>', {class: "content-inputs-add-event"});
            var $divStart = $('div', {class: "label-block"});
            var $divFinish = $('div', {class: "label-block"});
            $divStart.html('Start');
            $divFinish.html('Finish');
        $titleFlightTime.append($divStart);
        $titleFlightTime.append($divFinish);
        
        var $contentSelectTime = $('<div>', {class: "content-inputs-add-event"});
            var $selectStart 
        
        
        
        var $divAnimation = $("<div>", {id: "animation-add-flight"});
        
        var $cloud6 = $("<img>", {id: "cloud6", src: "svg/cloud6.svg"});
        var $cloud5 = $("<img>", {id: "cloud5", src: "svg/cloud5.svg"});
        var $cloud4 = $("<img>", {id: "cloud4", src: "svg/cloud4.svg"});
        var $cloud1 = $("<img>", {id: "cloud1", src: "svg/cloud1.svg"});
        var $cloud2 = $("<img>", {id: "cloud2", src: "svg/cloud2.svg"});
        var $cloud3 = $("<img>", {id: "cloud3", src: "svg/cloud3.svg"});
        $divAnimation.append($cloud6);
        $divAnimation.append($cloud5);
        $divAnimation.append($cloud4);
        $divAnimation.append($cloud1);
        $divAnimation.append($cloud2);
        $divAnimation.append($cloud3);
        
        var $plane = $("<img>", {id: "plane-svg", src: "svg/plane.svg"});
        $divAnimation.append($plane);
        
        $divContent.append($divAnimation);*/
        
        /*TweenMax.to($divContent, 0.2, {width: '550px', height: '600px'});
    TweenMax.to($plane, 2, {left: '50%', rotation: 0, delay: 0.3, ease: Back.easeOut.config(2)});*/
        
        showModal($.parseHTML($CONTENT_POPUP_ADD_FLIGHT));
        
    });
    
    function hideOptionsPopup()
    {
        
        var $content = $('#content-popup-options');
        
            var $triangleBack = $('#triangle-box');
            var $triangleFront = $('#triangle-box-front');


            TweenMax.to($('.buttons-options-popup img'), 0.2, {scale: 0, delay:0});
            TweenMax.to($('.buttons-options-popup'), 0.3, {width: '0px', height: '0px', delay:0, ease: Back.easeOut.config(1.7)});
            TweenMax.to($content, 0.2, {height: '0px', delay: 0.1, opacity: 0});
            TweenMax.to([$triangleBack, $triangleFront], 0.2, {width: '0px', height: '0px', delay: 0.1});
            TweenMax.to($('#close-add-options'), 0.4, {rotation: 0});
            TweenMax.to($('#content-add-options'), 0, {display: 'none', delay:0.4});
            TweenMax.to($content, 0, {opacity: 1, delay:0.4});
        
        
    }
    
});
			
$(function(){	
        $('.scroll-pane').jScrollPane();
    });

jQuery( document ).ready(function( $ ) {
    
});