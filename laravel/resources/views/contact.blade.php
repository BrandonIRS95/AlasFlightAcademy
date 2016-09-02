@extends('layouts.master-layout')

@section('individual-styles')
    <link rel="stylesheet" href="{{URL::to('css/contact-page.css')}}">
@endsection

@section('content')
    <div class="Map">
        <div id="map" class="Map__canvas"></div>
        <div class="Map__triangle"></div>
    </div>
    <div class="Contact">
        <h2 class="Contact__title">We'll be glad to help you becoming a pilot</h2>
        <div class="Contact__content">
            <div class="Contact__info">
                <h2 class="Contact__info__brand"><span class="Contact__info__brand--alas">Alas</span><span class="Contact__info__brand--academy">Academy</span></h2>
                <p class="Contact__info__phone">713-604-0668</p>
                <p class="Contact__info__direction">6670 Cormier Grove</p>
                <p class="Contact__info__direction">San Diego, CA 19661-8622</p>
                <p class="Contact__info__email">contact@alasacademy.com</p>
            </div>
            <form class="Contact__form">
                <div class="input-field">
                    <label for="firstName">First Name</label>
                    <input id="firstName" type="text">
                </div>
                <div class="input-field">
                    <label for="lastName">Last Name</label>
                    <input id="lastName" type="text">
                </div>
                <div class="input-field">
                    <label for="phoneNumber">Phone Number</label>
                    <input id="phoneNumber" type="text">
                </div>
                <div class="input-field">
                    <label for="email">E-mail</label>
                    <input id="email" type="text">
                </div>
                <div class="input-field">
                    <label for="comments">Comments of questions</label>
                    <input id="comments" type="text">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript-functions')
    <script>
        $('.button-collapse').sideNav();
        var $navbarItems = $('.Navbar__item');
        $navbarItems.on('click', function() {
            var $el = $(this);
            $navbarItems.removeClass('Navbar__item--active');
            $el.addClass('Navbar__item--active');
        })
    </script>
    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3yLB8Z-4fx9RsAOJETr7CndhqHjo_za4&amp;callback=initMap"></script>
@endsection