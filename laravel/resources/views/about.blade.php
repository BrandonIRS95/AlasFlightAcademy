@extends('layouts.master-layout')

@section('individual-styles')
  <link rel="stylesheet" href="{{ URL::to('css/about-page.css') }}">
@endsection

@section('content')
  <div class="Page__header parallax-container">
    <div class="parallax"><img src="{{ URL::to('images/about.jpg')}}" width="100%"></div>
    <div class="Page__header__filter"></div>
    <div class="Page__header__text">About us</div>
  </div>
  <div class="CTA_bar">
    <h3 class="CTA_bar__text">Have questions?</h3>
    <button class="CTA_bar__button" onclick="window.location.href = '{{URL::to('contact')}}'">Contact us!</button>
  </div>
  <div class="About__offer">
    <h3 class="About__offer__title">What do we offer?</h3>
    <p class="About__offer__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia neque in optio at est iure vero quibusdam fugit voluptate officia cupiditate rerum quam animi, voluptatum odit cumque fuga similique veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </div>
  <div class="About__advantages parallax-container">
    <div class="parallax"><img src="{{ URL::to('images/airplane_bluesky.jpg')}}" width="100%"></div>
    <div class="About__advantages__filter"></div>
    <div class="About__advantages__header">
      <h3 class="About__advantages__title">What are the advanges of Alas?</h3>
      <p class="About__advantages__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam iusto praesentium corporis accusamus laborum enim, pariatur repellat commodi inventore! Debitis tempora, magnam dolor. Blanditiis cumque iure qui similique nam praesentium.</p>
    </div>
    <div class="About__advantages__list">
      <div class="About__advantages__item">
        <div class="About__advantages__item_decorator"></div>
        <p class="About__advantages__description"></p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia vitae sunt accusantium magni
      </div>
      <div class="About__advantages__item">
        <div class="About__advantages__item_decorator"></div>
        <p class="About__advantages__text"></p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia vitae sunt accusantium magni accusamus magnam repellendus, fugiat dolorem asperiores!
      </div>
      <div class="About__advantages__item">
        <div class="About__advantages__item_decorator"></div>
        <p class="About__advantages__text"></p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia vitae sunt accusantium magni accusamus magnam repellendus
      </div>
    </div>
  </div>
  <div class="About__history">
    <h3 class="About__history__title">History</h3>
    <p class="About__history__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia neque in optio at est iure vero quibusdam fugit voluptate officia cupiditate rerum quam animi, voluptatum odit cumque fuga similique veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia neque in optio at est iure vero quibusdam fugit voluptate officia cupiditate rerum quam animi, voluptatum odit cumque fuga similique veniam.</p>
  </div>
  <div class="About__founder parallax-container">
    <div class="parallax"><img src="{{ URL::to('images/blue_pattern.png')}}" width="100%"></div>
    <h3 class="About__founder__title">About the founder</h3>
    <div class="About__founder__info"><img src="{{ URL::to('images/ferret-with-sweater.jpg')}}" class="About__founder__image">
      <p class="About__founder__description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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

    $('.parallax').parallax();
  </script>
@endsection