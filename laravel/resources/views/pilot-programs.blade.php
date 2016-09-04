@extends('layouts.master-layout')

@section('individual-styles')
  <link rel="stylesheet" href="{{URL::to('css/pilot-programs-page.css')}}">
@endsection

@section('content')
  <div class="Page__header parallax-container">
    <div class="parallax"><img src="{{URL::to('images/programsheader.jpg')}}" width="100%"></div>
    <div class="Page__header__filter"></div>
    <div class="Page__header__text">Pilot programs</div>
  </div>
  <div class="CTA_bar">
    <h3 class="CTA_bar__text">Have questions?</h3>
    <button class="CTA_bar__button" onclick="window.location.href = '{{URL::to('contact')}}'">Contact us!</button>
  </div>
  <div class="Programs__description">
    <h3 class="Programs__description__title">Our Programs</h3>
    <p class="Programs__description__text">

      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime sed voluptas sapiente explicabo laborum ullam voluptate, quaerat officia fugit eligendi, alias labore, vel esse. Tenetur, itaque qui quibusdam suscipit dolores. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </p>
  </div>
  <div class="Programs__container">
    <ul class="Programs__list">
      <li class="Programs__item"><img src="{{URL::to('images/programs-1.jpg')}}" class="Programs__item__image">
        <div class="Programs__item__description">
          <h4 class="Programs__item__title">Pilot Program #1</h4>
          <p class="Programs__item__text">

            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
          <button class="Programs__item__button">Apply now</button>
        </div>
      </li>
      <li class="Programs__item">
        <div class="Programs__item__description">
          <h4 class="Programs__item__title">Pilot Program #2</h4>
          <p class="Programs__item__text">

            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
          <button class="Programs__item__button">Apply now</button>
        </div><img src="{{URL::to('images/programs-1.jpg')}}" class="Programs__item__image">
      </li>
      <li class="Programs__item"><img src="{{URL::to('images/programs-1.jpg')}}" class="Programs__item__image">
        <div class="Programs__item__description">
          <h4 class="Programs__item__title">Pilot Program #3</h4>
          <p class="Programs__item__text">

            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
          <button class="Programs__item__button">Apply now</button>
        </div>
      </li>
    </ul>
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
