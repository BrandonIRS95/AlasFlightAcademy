<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alas Academy</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons|Antic|Cantarell|Copse|Raleway|Varel" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::to('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/shared.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/landing-page.css') }}">
  </head>
  <body>
    <div class="Application_container">
      <nav class="Navbar--transparent">
        <div class="Navbar__wrapper nav-wrapper"><a href="{{ route('home') }}" class="Navbar__logo brand-logo"><span class="Navbar__logo--alas">Alas</span><span class="Navbar__logo--academy">Academy</span></a><a id="menu-button" href="#" data-activates="side-nav" class="Navbar__menu_button button-collapse"><i class="material-icons">menu</i></a>
          <ul class="Navbar__link_list right hide-on-med-and-down">
            <li class="Navbar__item"><a href="./about.html" class="Navbar__item_link"><span class="Navbar__item_text">About us</span></a></li>
            <li class="Navbar__item"><a href="./pilot-programs.html" class="Navbar__item_link"><span class="Navbar__item_text">Pilot programs</span></a></li>
            <li class="Navbar__item"><a href="./contact.html" class="Navbar__item_link"><span class="Navbar__item_text">Contact</span></a></li>
            <li class="Navbar__item"><a href="#become-pilot" class="Navbar__item_link"><span class="Navbar__item_text">Become a pilot</span></a></li>
            <li class="Navbar__item"><a href="./enroll.html" class="Navbar__item_link"><span class="Navbar__item_text">Enroll Now</span></a></li>
            <li class="Navbar__item"><a href="#signin" class="Navbar__item_link"><span class="Navbar__item_text">Sign in</span></a></li>
          </ul>
        </div>
      </nav>
      <ul id="side-nav" class="Sidenav__list side-nav">
        <li class="Sidenav__item"><a href="./index.html" class="Sidenav__item_link"><span class="Sidenav__item_title"> <span class="Sidenav__item_title--alas">Alas</span><span class="Sidenav__item_title--academy">Academy</span></span></a></li>
        <li class="Sidenav__item"><a href="./about.html" class="Sidenav__item_link"><span class="Sidenav__item_text">About us</span></a></li>
        <li class="Sidenav__item"><a href="./pilot-programs.html" class="Sidenav__item_link"><span class="Sidenav__item_text">Pilot programs</span></a></li>
        <li class="Sidenav__item"><a href="./contact.html" class="Sidenav__item_link"><span class="Sidenav__item_text">Contact</span></a></li>
        <li class="Sidenav__item"><a href="#become-pilot" class="Sidenav__item_link"><span class="Sidenav__item_text">Become a pilot</span></a></li>
        <li class="Sidenav__item"><a href="./enroll.html" class="Sidenav__item_link"><span class="Sidenav__item_text">Enroll Now</span></a></li>
        <li class="Sidenav__item"><a href="#signin" class="Sidenav__item_link"><span class="Sidenav__item_text">Sign in</span></a></li>
      </ul>
      <div class="Page__header--landing Page__header parallax-container">
        <div class="parallax"><img src="{{ URL::to('images/enroll.jpg') }}" width="100%"></div>
        <div class="Page__header__filter--landing"></div>
        <div class="Page__header__text">Spread your wings</div>
      </div>
      <div class="CTA_bar">
        <h3 class="CTA_bar__text">Want to become a pilot?</h3>
        <button class="CTA_bar__button">Apply now!</button>
      </div>
      <div class="Landing__sections row"><a id="land-section-1" href="#" class="Landing__section col l8 s12">
          <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-become-a-pilot.jpg') }}" class="Landing__section__image">
            <figcaption class="Landing__section__title">Become a pilot</figcaption>
          </figure></a><a id="land-section-2" href="#" class="Landing__section col l4 s12">
          <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-enroll-now.jpg') }}" class="Landing__section__image">
            <figcaption class="Landing__section__title">Enroll now</figcaption>
          </figure></a><a id="land-section-3" href="#" class="Landing__section col l4 s12">
          <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-pilot-programs.jpg') }}" class="Landing__section__image">
            <figcaption class="Landing__section__title">Pilot programs</figcaption>
          </figure></a><a id="land-section-4" href="#" class="Landing__section col l4 s12">
          <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-about-us.jpg') }}" class="Landing__section__image">
            <figcaption class="Landing__section__title">About us</figcaption>
          </figure></a><a id="land-section-5" href="#" class="Landing__section col l4 s12">
          <figure class="Landing__section__image_container"><img src="{{ URL::to('images/landing-contact.jpg') }}" class="Landing__section__image">
            <figcaption class="Landing__section__title">Contact</figcaption>
          </figure></a></div>
      <div id="land-section-6" class="Landing__description">
        <h2 class="Landing__description__title">Alas Flight Academy</h2>
        <p class="Landing__description__text"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex cumque ipsa recusandae vitae optio, nesciunt placeat ipsum, eaque eveniet obcaecati doloremque, cum amet. Ullam expli enim amet quod pariatur modi! Lorem ipsum dolor sit amet, consectetur, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis dolor exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</p>
      </div>
      <div class="Landing__cta parallax-container">
        <div class="parallax"><img src="{{ URL::to('images/landing-cta-2.jpg')}}" width="100%"></div>
        <div class="Landing__cta__overlay"></div>
        <h2 id="land-section-7" class="Landing__cta__title">Make your dream come true</h2>
        <button id="land-section-8" class="Landing__cta__button">Contact us</button>
      </div>
      <footer class="Footer">
        <ul class="Footer__list">
          <li class="Footer__list_item"><a class="Footer__link">About us</a></li>
          <li class="Footer__list_item"><a class="Footer__link">Pilot programs</a></li>
          <li class="Footer__list_item"><a class="Footer__link">Contact</a></li>
          <li class="Footer__list_item"><a class="Footer__link">Become a pilot</a></li>
          <li class="Footer__list_item"><a class="Footer__link">Sign in</a></li>
          <li class="Footer__list_item"><a class="Footer__link">Enroll now</a></li>
        </ul>
        <p class="Footer__text">© 2016 Alas Academy</p>
      </footer>
    </div>
    <script src="{{ URL::to('js/vendor.js')}}"></script>
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
  </body>
</html>