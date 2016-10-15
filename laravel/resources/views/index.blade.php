@extends('layouts.master-layout')

@section('individual-styles')
  <link rel="stylesheet" href="{{ URL::to('css/landing-page.css') }}">
  <style>
    @media only screen and (max-width:725px){
      #text-header{
        font-size: 30px;
      }
    }
    @media only screen and (max-width:387px){
      #text-header{
        font-size: 22px;
      }
    }
  </style>
@endsection

@section('content')
  <div id="parent-video"  class="Page__header--landing Page__header parallax-container">
    <div class="parallax" id="header-video">
      <video id="alas-video" width="100%" autoplay loop>
        <source src="{{URL::to('videos/alasvideo.mp4')}}" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <div style="clear: both"></div>
    </div>
    <div class="Page__header__filter--landing"></div>
    <div id="text-header" class="Page__header__text">Spread your wings</div>
  </div>
  <div class="CTA_bar">
    <h3 class="CTA_bar__text">Want to become a pilot?</h3>
    <button class="CTA_bar__button">Apply now!</button>
  </div>
  <div class="Landing__sections row"><a id="land-section-1" href="{{route('index')}}" class="Landing__section col l8 s12">
      <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-become-a-pilot.jpg') }}" class="Landing__section__image">
        <figcaption class="Landing__section__title">Become a pilot</figcaption>
      </figure></a><a id="land-section-2" href="{{route('enroll')}}" class="Landing__section col l4 s12">
      <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-enroll-now.jpg') }}" class="Landing__section__image">
        <figcaption class="Landing__section__title">Enroll now</figcaption>
      </figure></a><a id="land-section-3" href="{{route('pilot-programs')}}" class="Landing__section col l4 s12">
      <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-pilot-programs.jpg') }}" class="Landing__section__image">
        <figcaption class="Landing__section__title">Pilot programs</figcaption>
      </figure></a><a id="land-section-4" href="{{route('about')}}" class="Landing__section col l4 s12">
      <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-about-us.jpg') }}" class="Landing__section__image">
        <figcaption class="Landing__section__title">About us</figcaption>
      </figure></a><a id="land-section-5" href="{{route('contact')}}" class="Landing__section col l4 s12">
      <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-contact.jpg') }}" class="Landing__section__image">
        <figcaption class="Landing__section__title">Contact</figcaption>
      </figure></a></div>
  <div id="land-section-6" class="Landing__description">
    <h3 class="Landing__description__title">ALAS | Regional Airline Academy</h3>
    <p class="Landing__description__text"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex cumque ipsa recusandae vitae optio, nesciunt placeat ipsum, eaque eveniet obcaecati doloremque, cum amet. Ullam expli enim amet quod pariatur modi! Lorem ipsum dolor sit amet, consectetur, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis dolor exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</p>
  </div>
  <div class="Landing__cta parallax-container">
    <div class="parallax"><img src="{{ URL::to('images/landing-cta-2.jpg')}}" width="100%"></div>
    <div class="Landing__cta__overlay"></div>
    <h2 id="land-section-7" class="Landing__cta__title">Make your dream come true</h2>
    <button id="land-section-8" onclick="window.location.href = '{{URL::to('contact')}}'" class="Landing__cta__button">Contact us</button>
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
    $('.parallax').parallax();
    function addIsShowingClass(el) {
      $(el).addClass('is-showing');
    }
    var options = [
      {selector: '#land-section-1', offset: 0, callback: addIsShowingClass },
      {selector: '#land-section-2', offset: 0, callback: addIsShowingClass },
      {selector: '#land-section-3', offset: 100, callback: addIsShowingClass },
      {selector: '#land-section-4', offset: 100, callback: addIsShowingClass },
      {selector: '#land-section-5', offset: 100, callback: addIsShowingClass },
      {selector: '#land-section-6', offset: 300, callback: addIsShowingClass },
      {selector: '#land-section-7', offset: 100, callback: addIsShowingClass },
      {selector: '#land-section-8', offset: 20, callback: addIsShowingClass },
    ];
    Materialize.scrollFire(options);
  </script>
  <script>

    $(document).ready(function(){
      resizeHeaderDivs();
    });

    $( window ).resize(function() {
        resizeHeaderDivs();
;    });

    function resizeHeaderDivs()
    {
      if($(window).width() <= 1100)
      {
        $("#header-video, #parent-video").height($("#alas-video").height());
      }
      else {
        $("#header-video, #parent-video").height(620);
      }
    }
  </script>
@endsection
