<div id="conteiner-weather">
    <div id="close-btn">
        <img src="{{URL::to('svg/ic_close_black_24px.svg')}}">
    </div>
    <div id="content-weather">
        <div class="prop-weather"><img class="icon" src="{{URL::to('svg/calendar/43.svg')}}"><span id="temperature">...</span></div>
        <div class="prop-weather"><img id="imgSummary" class="icon" src="{{URL::to('svg/calendar/ic_hourglass_empty_white_24px.svg')}}"><span id="summary">...</span></div><br>
        <div class="prop-weather" style="clear: both;"><img class="icon" src="{{URL::to('svg/calendar/44.svg')}}"><span id="wind">...</span></div>
    </div>
</div>
<div id="show-weather-btn">
    <img src="{{URL::to('svg/calendar/2.svg')}}">
</div>