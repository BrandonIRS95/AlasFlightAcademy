$('#show-weather-btn').click(function () {
  var $conteiner = $('#conteiner-weather');
  var template = '<img id="cloud6" src="svg/calendar/cloud6.svg"/>' +
  '<img id="cloud5" src="svg/calendar/cloud5.svg"/>' +
  '<img id="cloud4" src="svg/calendar/cloud4.svg"/>' +
  '<img id="cloud1" src="svg/calendar/cloud1.svg"/>' +
  '<img id="cloud2" src="svg/calendar/cloud2.svg"/>' +
  '<img id="cloud3" src="svg/calendar/cloud3.svg"/>' +
  '<img id="plane-svg" src="svg/calendar/plane.svg"/>';
  $conteiner.append(template);

  TweenMax.to($conteiner, 0.4, {top: 0, onComplete: function () {

        var t1 = new TimelineLite({onComplete:function() {
        this.restart();}
        });

        t1.to($("#plane-svg"), 8, {rotation: 10, ease: Power0.easeNone});

        t1.to($("#plane-svg"), 4, {rotation: -10, ease: Power0.easeNone});

        t1.to($("#plane-svg"), 4, {rotation: 0, ease: Power0.easeNone});
  }});

});

$('#close-btn').click(function () {
  var $conteiner = $('#conteiner-weather');
  TweenMax.to($conteiner, 0.4, {top: '100%', onComplete: function () {
    $('#plane-svg, #cloud1, #cloud2, #cloud3, #cloud4, #cloud5, #cloud6').remove();
  }});
});
