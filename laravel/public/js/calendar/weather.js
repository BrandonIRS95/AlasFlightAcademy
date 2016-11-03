$('#show-weather-btn').click(function () {
  var $conteiner = $('#conteiner-weather');
    var hourFormat = $('#flight_start_hour').val() + ':' + $('#flight_start_minute').val() + ':00';
  var template = '<img id="cloud6" class="weather" src="svg/calendar/cloud6.svg"/>' +
  '<img id="cloud5" class="weather" src="svg/calendar/cloud5.svg"/>' +
  '<img id="cloud4" class="weather" src="svg/calendar/cloud4.svg"/>' +
  '<img id="cloud1" class="weather" src="svg/calendar/cloud1.svg"/>' +
  '<img id="cloud2" class="weather" src="svg/calendar/cloud2.svg"/>' +
  '<img id="cloud3" class="weather" src="svg/calendar/cloud3.svg"/>' +
  '<img id="plane-svg" class="plane" src="svg/calendar/plane.svg"/>';
  $conteiner.append(template);

    $.ajax({
        url: 'https://api.darksky.net/forecast/5b3325c22c6254d2ba685f4a47343d3e/32.530833,-117.02,' + SELECTED_DATE.toString('yyyy-MM-dd') + 'T'+hourFormat+'?exclude=minutely,hourly,daily',
        method: 'GET',
        dataType: "jsonp"
    }).done(function (response) {
        var currently = response.currently;
        var $temp = $('#temperature');
        var $wind = $('#wind');
        var $summary = $('#summary');
        var tempFormat = '';
        var icon = currently.icon;
        var c = (currently.temperature - 32) / 1.8;
        tempFormat = c.toFixed(0) + ' &deg;C | ' + currently.temperature.toFixed(0) + ' &deg;F';
        $temp.html(tempFormat);
        $wind.html(currently.windSpeed + ' MPH');
        $summary.html(currently.summary);
        $('#imgSummary').attr('src', urlSvgCalendar + icon + '.svg');
        if(icon === 'clear-day') {
            $conteiner.css('background', 'linear-gradient(#01A9DB, #81DAF5)');
            $('.weather').remove();
            $conteiner.append($('<div>', {class: 'sun'}));
        }
        if(icon === 'clear-night') {
            $conteiner.css('background', 'linear-gradient(#0B0B3B, #0B2161)');
            $('.weather').remove();
            $('.plane').css('filter', 'brightness(0.6) saturate(3) hue-rotate(360deg) opacity(1) brightness(1) contrast(1.4)');
            $conteiner.append($('<img>', {src: urlSvgCalendar + 'moon.svg', class: 'moon'}));
        }
        if(icon === 'partly-cloudy-night') {
            $conteiner.css('background', 'linear-gradient(#210B61, #0489B1)');
            $('.weather').css('filter', 'brightness(0.5) saturate(10) hue-rotate(360deg) opacity(0.5) brightness(1) contrast(1)');
            $('.plane').css('filter', 'brightness(0.6) saturate(3) hue-rotate(360deg) opacity(1) brightness(1) contrast(1.4)');
            $conteiner.append($('<img>', {src: urlSvgCalendar + 'moon.svg', class: 'moon'}));
            $('#cloud6, #cloud1, #cloud5').remove();
            $('#cloud4').css('bottom','-80px');
        }
        if (icon === 'partly-cloudy-day') {
            $conteiner.css('background', 'linear-gradient(#01A9DB, #81DAF5)');
            $conteiner.append($('<div>', {class: 'sun'}));
            $('#cloud6, #cloud1, #cloud5').remove();
            $('#cloud4').css('bottom','-80px');
        }

        TweenMax.to($conteiner, 0.4, {top: 0, onComplete: function () {

            var t1 = new TimelineLite({onComplete:function() {
             this.restart();}
             });

             t1.to($("#plane-svg"), 8, {rotation: 10, ease: Power0.easeNone});

             t1.to($("#plane-svg"), 4, {rotation: -10, ease: Power0.easeNone});

             t1.to($("#plane-svg"), 4, {rotation: 0, ease: Power0.easeNone});
        }});

    });


});

$(document).on('click', '#close-btn', function () {
    hideWeather();
});

function hideWeather() {
    var $conteiner = $('#conteiner-weather');
    var $btn = $('#close-btn');
    TweenMax.to($conteiner, 0.4, {top: '100%', onComplete: function () {
        var $content = $('#content-weather');
        $('#conteiner-weather').empty().append([$content, $btn]);

    }});
}
