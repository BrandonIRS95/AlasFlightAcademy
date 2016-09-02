@extends('layouts.master-layout')

@section('individual-styles')
  <link rel="stylesheet" href="{{URL::to('css/enroll-page.css')}}">
@endsection

@section('content')
  <div class="Page__header parallax-container">
    <div class="parallax"><img src="{{URL::to('images/enroll.jpg')}}" width="100%"></div>
    <div class="Page__header__filter"></div>
    <div class="Page__header__text">Enroll now</div>
  </div>
  <div class="CTA_bar">
    <h3 class="CTA_bar__text">Have questions?</h3>
    <button class="CTA_bar__button">Contact us!</button>
  </div>
  <div class="Enroll">
    <h2 class="Enroll__title">Steps to enroll</h2>
    <ul class="Enroll__step_list">
      <li class="Enroll__step">
        <h3 class="Enroll__step__number">1.</h3>
        <div class="Enroll__step__divider"></div>
        <p class="Enroll__step__description">Complete the Enrollment Application.</p>
      </li>
      <li class="Enroll__step">
        <h3 class="Enroll__step__number">2.</h3>
        <div class="Enroll__step__divider"></div>
        <p class="Enroll__step__description">Submit a $150 USD application fee. We accept VISA, Master Card, American Express, Discover or Wire Transfer. (Please contact Admissions for payment instructions)</p>
      </li>
      <li class="Enroll__step">
        <h3 class="Enroll__step__number">3.</h3>
        <div class="Enroll__step__divider"></div>
        <p class="Enroll__step__description">Submit a $300 USD housing deposit. Only for those who choose the Alas Academy on-campus dormitory. Limited availability.</p>
      </li>
      <li class="Enroll__step">
        <h3 class="Enroll__step__number">4.</h3>
        <div class="Enroll__step__divider"></div>
        <p class="Enroll__step__description">Provide the Academy with a copy of:
        <ul class="Enroll__step__description__list">
          <li class="Enroll__step__description__item">An FFA 1st or 2nd Class Medical Certificate.</li>
          <li class="Enroll__step__description__item">Your Highschool diploma or equivalent.</li>
          <li class="Enroll__step__description__item">Goverment Identification.</li>
        </ul>
        </p>
      </li>
    </ul>
    <button id="enroll-button" data-target="enroll-modal" class="Enroll__button modal-trigger">Enroll</button>
  </div>
  <div id="enroll-modal" class="Enroll__modal modal">
    <form id="enroll-form" method="post" action="/form" class="ModalForm row col s10">
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title">Application for admission</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger">clear</i>
        </div>
        <div class="ModalForm__pages_container col s12 m12 row">
          <h3 class="ModalForm__page__step">Step 1 of 5</h3>
          <h4 class="ModalForm__page__section_title">Student details</h4>
          <div class="Modalform__checkboxes">
            <p>Gender</p>
            <input id="gender-female-input" type="radio" name="gender" value="female" class="ModalForm__input with-gap">
            <label for="gender-female-input">Female</label>
            <input id="gender-male-input" type="radio" name="gender" value="male" class="ModalForm__input with-gap">
            <label for="gender-male-input">Male</label>
          </div>
          <div class="input-field col s10 m8">
            <label for="birthdate">Date of birth</label>
            <input id="birthdate" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="input-field col s12 m12">
            <label for="name">Name</label>
            <input id="name" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m12">
            <label for="address">Address</label>
            <input id="address" type="text" class="ModalForm__input">
          </div>
          <div class="ModalForm__input--select input-field col s12 m6">
            <select>
              <option value="" disabled selected>Country</option>
              <option>Mexico</option>
              <option>USA</option>
            </select>
          </div>
          <div class="ModalForm__input--select input-field col s12 m6">
            <select>
              <option value="" disabled selected>State</option>
              <option>CA</option>
              <option>FL</option>
              <option>TX</option>
            </select>
          </div>
          <div class="input-field col s12 m6">
            <label for="city">City</label>
            <input id="city" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m6">
            <label for="zipcode">Zip Code</label>
            <input id="zipcode" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m6">
            <label for="phone">Phone Number</label>
            <input id="phone" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m6">
            <label for="email">E-mail</label>
            <input id="email" type="email" class="ModalForm__input validate">
          </div>
          <div class="ModalForm__buttons col s12 m12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">cancel</a><a class="waves-effect waves-light btn ModalForm__button--active modal-go-to-2">NEXT</a></div>
        </div>
      </div>
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title"> <i class="ModalForm__header__title__icon material-icons modal-go-to-1">keyboard_backspace</i> Application for admission</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger"> clear</i>
        </div>
        <div class="ModalForm__pages_container row">
          <h3 class="ModalForm__page__step">Step 2 of 5</h3>
          <h4 class="ModalForm__page__section_title">Student details</h4>
          <div class="input-field col s12 m8">
            <label for="birthplace">City and coutry of birth</label>
            <input id="birthplace" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m8">
            <label for="citizenship">Citizenship</label>
            <input id="citizenship" type="text" class="ModalForm__input">
          </div>
          <div class="ModalForm__input--select input-field col s12 m8">
            <select>
              <option value="" disabled selected>Country of passport Inssuance</option>
              <option>Mexico</option>
              <option>USA</option>
            </select>
          </div>
          <div class="input-field col s12 m6">
            <label for="passport">Passport number</label>
            <input id="passport" type="text" class="ModalForm__input">
          </div>
          <div class="col s10 m8">
            <label for="birthdate">Passport expiration date</label>
            <input id="birthdate" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="ModalForm__buttons_margin col s12"></div>
          <div class="ModalForm__buttons col s12 m12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">cancel</a><a class="waves-effect waves-light btn ModalForm__button--active modal-go-to-3">NEXT</a></div>
        </div>
      </div>
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title"> <i class="ModalForm__header__title__icon material-icons modal-go-to-2">keyboard_backspace</i> Application for admission</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger">clear</i>
        </div>
        <div class="ModalForm__pages_container row">
          <h3 class="ModalForm__page__step">Step 3 of 5</h3>
          <h4 class="ModalForm__page__section_title">School record</h4>
          <p class="Modal_Form__page__section_subtitle">List two most recent schools attended (High School, University or Technical)</p>
          <div class="input-field col s12 m8">
            <label for="school-name-1">School Name</label>
            <input id="school-name-1" type="text" class="ModalForm__input">
          </div>
          <div class="Modalform__input col s12 m8">
            <p>Was this school located on the USA?</p>
            <input id="school-in-usa-input" type="radio" name="school-in-usa" value="true" class="ModalForm__input with-gap">
            <label for="school-in-usa-input">Yes</label>
            <input id="school-not-in-usa-input" type="radio" name="school-in-usa" value="false" class="ModalForm__input with-gap">
            <label for="school-not-in-usa-input">No</label>
          </div>
          <div class="input-field col s12 m6">
            <label for="degree-1">Diploma/Degree Achieved</label>
            <input id="degree-1" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s10 m8">
            <label for="attendance-1">Attendance date finish</label>
            <input id="attendance-1" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="ModalForm__divider col s12 m12"></div>
          <div class="input-field col s12 m8">
            <label for="school-name-2">School Name</label>
            <input id="school-name-2" type="text" class="ModalForm__input">
          </div>
          <div class="Modalform__input col s12 m8">
            <p>Was this school located on the USA?</p>
            <input id="school-in-usa-input" type="radio" name="school-in-usa" value="true" class="ModalForm__input with-gap">
            <label for="school-in-usa-input">Yes</label>
            <input id="school-not-in-usa-input" type="radio" name="school-in-usa" value="false" class="ModalForm__input with-gap">
            <label for="school-not-in-usa-input">No</label>
          </div>
          <div class="input-field col s12 m6">
            <label for="degree-2">Diploma/Degree Achieved</label>
            <input id="degree-2" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s10 m8">
            <label for="attendance-2">Attendance date finish</label>
            <input id="attendance-2" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="ModalForm__buttons col s12 m12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">cancel</a><a class="waves-effect waves-light btn ModalForm__button--active modal-go-to-4">NEXT</a></div>
        </div>
      </div>
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title"> <i class="ModalForm__header__title__icon material-icons modal-go-to-3">keyboard_backspace</i> Application for admission</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger"> clear</i>
        </div>
        <div class="ModalForm__pages_container row">
          <h3 class="ModalForm__page__step">Step 4 of 5</h3>
          <h4 class="ModalForm__page__section_title">Student details</h4>
          <div class="input-field col s10 m8">
            <label for="startdate">Select start date</label>
            <input id="startdate" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="ModalForm__input--select input-field col s12 m8">
            <select>
              <option value="" disabled selected>Select pilot program</option>
              <option>Program 1</option>
              <option>Program 2</option>
              <option>Program 3</option>
            </select>
          </div>
          <div class="Modalform__input col s12 m12">
            <p>Will you be requesting financial aid?</p>
            <input id="financial-aid-input" type="radio" name="financial-aid" value="true" class="ModalForm__input with-gap">
            <label for="financial-aid-input">Yes</label>
            <input id="not-financial-aid-input" type="radio" name="financial-aid" value="false" class="ModalForm__input with-gap">
            <label for="not-financial-aid-input">No</label>
          </div>
          <div class="Modalform__input col s12 m12">
            <p>Are you elegible for VA Benefits?</p>
            <input id="va-benefits-input" type="radio" name="va-benefits" value="true" class="ModalForm__input with-gap">
            <label for="va-benefits-input">Yes</label>
            <input id="not-va-benefits-input" type="radio" name="va-benefits" value="false" class="ModalForm__input with-gap">
            <label for="not-va-benefits-input">No</label>
          </div>
          <div class="Modalform__input col s12 m12">
            <p>Is english your native language?</p>
            <input id="native-english-input" type="radio" name="native-english" value="true" class="ModalForm__input with-gap">
            <label for="native-english-input">Yes</label>
            <input id="not-native-english-input" type="radio" name="native-english" value="false" class="ModalForm__input with-gap">
            <label for="not-native-english-input">No</label>
          </div>
          <div class="Modalform__input col s12 m12">
            <p>

              Have you been convicted of a crime in the past 10 years that may
              prevent you from passing a criminal history records check administered
              by TSA?
            </p>
            <input id="crime-input" type="radio" name="crime" value="true" class="ModalForm__input with-gap">
            <label for="crime-input">Yes</label>
            <input id="not-crime-input" type="radio" name="crime" value="false" class="ModalForm__input with-gap">
            <label for="not-crime-input">No</label>
          </div>
          <div class="input-field col s12 m12">
            <label for="flight-certificates">List all Flight Certificates/Ratings held</label>
            <input id="flight-certificates" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m12">
            <label for="rating-schools">Name of schools were rating was obtained.</label>
            <input id="rating-schools" type="text" class="ModalForm__input">
          </div>
          <div class="Modalform__input col s12 m12">
            <p>FFA Medical:</p>
            <input id="none-ffa-medical-input" type="radio" name="ffa-medical" value="true" class="ModalForm__input with-gap">
            <label for="none-ffa-medical-input">None</label>
            <input id="first-ffa-medical-input" type="radio" name="ffa-medical" value="false" class="ModalForm__input with-gap">
            <label for="first-ffa-medical-input">First class</label>
            <input id="second-ffa-medical-input" type="radio" name="ffa-medical" value="false" class="ModalForm__input with-gap">
            <label for="second-ffa-medical-input">Second class</label>
            <input id="thid-ffa-medical-input" type="radio" name="ffa-medical" value="false" class="ModalForm__input with-gap">
            <label for="thid-ffa-medical-input">Third class</label>
          </div>
          <div class="ModalForm__buttons col s12 m12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">cancel</a><a class="waves-effect waves-light btn ModalForm__button--active modal-go-to-5">NEXT</a></div>
        </div>
      </div>
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title"> <i class="ModalForm__header__title__icon material-icons modal-go-to-4">keyboard_backspace</i> Application for admission</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger">clear</i>
        </div>
        <div class="ModalForm__pages_container row">
          <h3 class="ModalForm__page__step">Step 5 of 5</h3>
          <h4 class="ModalForm__page__section_title">Authentication</h4>
          <div class="Modalform__input col s12 ModalForm__certification">
            <input id="confirmation-input" type="checkbox" name="confirmation" class="ModalForm__input">
            <label for="confirmation-input">I Certify that all the information entered in this application is factual.</label>
          </div>
          <div class="input-field file-field col s10">
            <div class="file-path-wrapper col s8 ModalForm__input_file">
              <input type="text" placeholder="Electronic signature" class="file-path validate">
            </div>
            <div class="btn grey lighten-2 col s4 m2 black-text"><span>ADD</span>
              <input type="file">
            </div>
          </div>
          <div class="input-field col s6">
            <label for="startdate">Today's date</label>
            <input id="startdate" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 material-icons">today</i>
          <div class="ModalForm__buttons_margin col s12"></div>
          <div class="ModalForm__buttons col s12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">cancel</a>
            <input type="submit" value="Submit" class="waves-effect waves-light btn ModalForm__button--active">
          </div>
        </div>
      </div>
    </form>
  </div>
  <div id="modalconfirm" class="modal fit-size">
    <div class="modal-content">
      <h5>Are you sure you want to close this form? Info will be lost</h5>
    </div>
    <div class="modal-footer col s12 ModalForm__buttons--fit">
      <button class="waves-effect waves-light btn ModalForm__button--active modal-close">CANCEL</button>
      <button id="modal-close-button" class="waves-effect waves-light btn ModalForm__button grey lighten-2">CLOSE</button>
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
    $(document).ready(function(){
      var $enrollModalContainer = $('.ModalForm');
      var $confirmModal = $('#modalconfirm');
      var $enrollModal = $('#enroll-modal');
      var $enrollForm  = $('#enroll-form');
      var $modalTriggers = $('.modal-trigger');
      function closeForm() {
        $enrollModal.closeModal();
        $confirmModal.closeModal();
        $enrollForm.trigger('reset');
        translateToModalPage(1);
      }
      function translateToModalPage(page) {
        var $calendarHolder = $('.ModalForm .picker__holder');
        var pageTranslation = (100/6) - (100/6)*page;
        var calendarTranslation = -3*(100/6) + (100/6)*page;
        $enrollModalContainer.css('transform', 'translateX('+ pageTranslation +'%)');
        $calendarHolder.css('transform', 'translateX('+ calendarTranslation +'%)');
      }
      // Modals
      $modalTriggers.leanModal({ dismissible: false });
      // Material stuff
      $('select').material_select();
      $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 100
      });
      // Listeners
      $('#modal-close-button').on('click', closeForm);
      $('.modal-go-to-1').on('click', function() {
        translateToModalPage(1);
      });
      $('.modal-go-to-2').on('click', function() {
        translateToModalPage(2);
      });
      $('.modal-go-to-3').on('click', function() {
        translateToModalPage(3);
      });
      $('.modal-go-to-4').on('click', function() {
        translateToModalPage(4);
      });
      $('.modal-go-to-5').on('click', function() {
        translateToModalPage(5);
      });
    });
  </script>
@endsection