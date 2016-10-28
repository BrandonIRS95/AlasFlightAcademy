@extends('layouts.master-layout')

@section('individual-styles')
  <link rel="stylesheet" href="{{URL::to('css/enroll-page.css')}}">
  <link rel="stylesheet" href="{{URL::to('css/intlTelInput.css')}}">
  <style>
    div.error{
      color: red;
    }
    /*#gender-error {
      position: absolute;
      top: 50px;
    }*/
    input.error, select.error {
      border-bottom: 1px solid red;
      box-shadow: 0 1px 0 0 red;
    }

    .intl-tel-input{
      width: 100%;
      box-sizing: content-box;
    }

    #phone::-webkit-input-placeholder { /* Chrome/Opera/Safari */
      color:#9e9e9e;
    }
    #phone::-moz-placeholder { /* Firefox 19+ */
      color: #9e9e9e;
    }
    #phone:-ms-input-placeholder { /* IE 10+ */
      color: #9e9e9e;
    }
    #phone:-moz-placeholder { /* Firefox 18- */
      color: #9e9e9e;
    }

  </style>
@endsection

@section('content')
  <div class="Page__header parallax-container">
    <div class="parallax"><img src="{{URL::to('images/enroll.jpg')}}" width="100%"></div>
    <div class="Page__header__filter"></div>
    <div class="Page__header__text">{{trans('messages.enroll_now')}}</div>
  </div>
  <div class="CTA_bar">
    <h3 class="CTA_bar__text">{{trans('messages.have_questions')}}</h3>
    <button class="CTA_bar__button" onclick="window.location.href = '{{URL::to('contact')}}'">{{trans('messages.contact')}}!</button>
  </div>
  <div class="Enroll">
    <h2 class="Enroll__title">{{trans('enrollform.steps_enroll')}}</h2>
    <ul class="Enroll__step_list">
      <li class="Enroll__step">
        <h3 class="Enroll__step__number">1.</h3>
        <div class="Enroll__step__divider"></div>
        <p class="Enroll__step__description">{{trans('enrollform.step1_description')}}</p>
      </li>
      <li class="Enroll__step">
        <h3 class="Enroll__step__number">2.</h3>
        <div class="Enroll__step__divider"></div>
        <p class="Enroll__step__description">{{trans('enrollform.step2_description')}}</p>
      </li>
      <li class="Enroll__step">
        <h3 class="Enroll__step__number">3.</h3>
        <div class="Enroll__step__divider"></div>
        <p class="Enroll__step__description">{{trans('enrollform.step3_description')}}</p>
      </li>
      <li class="Enroll__step">
        <h3 class="Enroll__step__number">4.</h3>
        <div class="Enroll__step__divider"></div>
        {!!trans('enrollform.step4_description')!!}
      </li>
    </ul>
    <button id="enroll-button" data-target="enroll-modal" class="Enroll__button modal-trigger">{{trans('enrollform.enroll')}}</button>
  </div>
  <div id="enroll-modal" class="Enroll__modal modal">
    <form id="enroll-form" class="ModalForm row col s10">
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title">{{trans('enrollform.title_form')}}</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger">clear</i>
        </div>
        <div class="ModalForm__pages_container col s12 m12 row">
          <h3 class="ModalForm__page__step">{{trans('enrollform.step')}} 1 {{trans('enrollform.of')}} 5</h3>
          <h4 class="ModalForm__page__section_title">{{trans('enrollform.student_details')}}</h4>

          <div class="Modalform__checkboxes">
            <p>{{trans('enrollform.gender')}}</p>
            <input id="gender-female-input" type="radio" name="gender" value="female" class="ModalForm__input with-gap">
            <label for="gender-female-input">{{trans('enrollform.female')}}</label>
            <input id="gender-male-input" type="radio" name="gender" value="male" class="ModalForm__input with-gap">
            <label for="gender-male-input">{{trans('enrollform.male')}}</label>
          </div>
          <div class="input-field col s10 m8">
            <label for="birthdate">{{trans('enrollform.date_birth')}}</label>
            <input id="birthdate" name="date_of_birth" type="date" class="ModalForm__input datepicker">

          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="input-field col s12 m6">
            <label for="name">{{trans('messages.first_name')}}</label>
            <input id="name" name="first_name" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m6">
            <label for="name">{{trans('messages.last_name')}}</label>
            <input id="name" name="last_name" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m12">
            <label for="address">{{trans('enrollform.address')}}</label>
            <input id="address" type="text" name="address" class="ModalForm__input">
          </div>
          <div class="ModalForm__input--select input-field col s12 m6">
            <select id="country_select" name="country">
              <option value="" disabled selected>{{trans('enrollform.country')}}</option>
              <option>Mexico</option>
              <option>USA</option>
            </select>
          </div>
          <div class="ModalForm__input--select input-field col s12 m6">
            <select id="state_select" name="state">
              <option value="" disabled selected>{{trans('enrollform.state')}}</option>
              <option>CA</option>
              <option>FL</option>
              <option>TX</option>
            </select>
          </div>
          <div class="input-field col s12 m6">
            <label for="city">{{trans('enrollform.city')}}</label>
            <input id="city" type="text" name="city" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m6">
            <label for="zipcode">{{trans('enrollform.zip_code')}}</label>
            <input id="zipcode" type="text" name="zip_code" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m6">

            <input id="phone" type="text" name="phone_number" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m6">
            <label for="email">{{trans('messages.email')}}</label>
            <input id="email" type="email" name="email" class="ModalForm__input validate">
          </div>
          <div class="ModalForm__buttons col s12 m12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">{{trans('enrollform.cancel')}}</a><a class="waves-effect waves-light btn ModalForm__button--active modal-go-to-2">{{trans('enrollform.next')}}</a></div>

        </div>

      </div>
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title"> <i class="ModalForm__header__title__icon material-icons modal-go-to-1">keyboard_backspace</i>{{trans('enrollform.title_form')}}</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger"> clear</i>
        </div>
        <div class="ModalForm__pages_container row">
          <h3 class="ModalForm__page__step">{{trans('enrollform.step')}} 2 {{trans('enrollform.of')}} 5</h3>
          <h4 class="ModalForm__page__section_title">{{trans('enrollform.student_details')}}</h4>
          <div class="input-field col s12 m8">
            <label for="birthplace">{{trans('enrollform.city_country_birth')}}</label>
            <input id="birthplace" type="text" class="ModalForm__input" name="city_country_of_birth">
          </div>
          <div class="input-field col s12 m8">
            <label for="citizenship">{{trans('enrollform.citizenship')}}</label>
            <input id="citizenship" type="text" name="citizenship" class="ModalForm__input">
          </div>
          <div class="ModalForm__input--select input-field col s12 m8">
            <select name="country_of_passport_issuance">
              <option value="" disabled selected>{{trans('enrollform.country_passport_issuance')}}</option>
              <option>Mexico</option>
              <option>USA</option>
            </select>
          </div>
          <div class="input-field col s12 m6">
            <label for="passport">{{trans('enrollform.passport_number')}}</label>
            <input id="passport" name="passport_number" type="text" class="ModalForm__input">
          </div>
          <div class="col s10 m8">
            <label for="birthdate">{{trans('enrollform.passport_expiration')}}</label>
            <input id="birthdate" name="passport_expiration_date" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="ModalForm__buttons_margin col s12"></div>
          <div class="ModalForm__buttons col s12 m12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">{{trans('enrollform.cancel')}}</a><a class="waves-effect waves-light btn ModalForm__button--active modal-go-to-3">{{trans('enrollform.next')}}</a></div>
        </div>
      </div>
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title"> <i class="ModalForm__header__title__icon material-icons modal-go-to-2">keyboard_backspace</i>{{trans('enrollform.title_form')}}</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger">clear</i>
        </div>
        <div class="ModalForm__pages_container row">
          <h3 class="ModalForm__page__step">{{trans('enrollform.step')}} 3 {{trans('enrollform.of')}} 5</h3>
          <h4 class="ModalForm__page__section_title">{{trans('enrollform.school_record')}}</h4>
          <p class="Modal_Form__page__section_subtitle">{{trans('enrollform.school_record_description')}}</p>
          <div class="input-field col s12 m8">
            <label for="school-name-1">{{trans('enrollform.school_name')}}</label>
            <input id="school-name-1" name="school_name1" type="text" class="ModalForm__input">
          </div>
          <div class="Modalform__input col s12 m8">
            <p>{{trans('enrollform.school_in_usa')}}</p>
            <input id="school-in-usa-input" type="radio" name="school_in_usa1" value="1" class="ModalForm__input with-gap">
            <label for="school-in-usa-input">{{trans('enrollform.yes')}}</label>
            <input id="school-not-in-usa-input" type="radio" name="school_in_usa1" value="0" class="ModalForm__input with-gap">
            <label for="school-not-in-usa-input">{{trans('enrollform.no')}}</label>
          </div>
          <div class="input-field col s12 m6">
            <label for="degree-1">{{trans('enrollform.diploma_achieved')}}</label>
            <input id="degree-1" name="diploma_degree1" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s10 m8">
            <label for="attendance-1">{{trans('enrollform.attendance_finish')}}</label>
            <input id="attendance-1" type="date" name="attendance_date_finish1" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="ModalForm__divider col s12 m12"></div>
          <div class="input-field col s12 m8">
            <label for="school-name-2">{{trans('enrollform.school_name')}}</label>
            <input id="school-name-2" name="school_name2" type="text" class="ModalForm__input">
          </div>
          <div class="Modalform__input col s12 m8">
            <p>{{trans('enrollform.school_in_usa')}}</p>
            <input id="school-in-usa-input2" type="radio" name="school_in_usa2" value="1" class="ModalForm__input with-gap">
            <label for="school-in-usa-input2">{{trans('enrollform.yes')}}</label>
            <input id="school-not-in-usa-input2" type="radio" name="school_in_usa2" value="0" class="ModalForm__input with-gap">
            <label for="school-not-in-usa-input2">{{trans('enrollform.no')}}</label>
          </div>
          <div class="input-field col s12 m6">
            <label for="degree-2">{{trans('enrollform.diploma_achieved')}}</label>
            <input id="degree-2" name="diploma_degree2" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s10 m8">
            <label for="attendance-2">{{trans('enrollform.attendance_finish')}}</label>
            <input id="attendance-2" name="attendance_date_finish2" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="ModalForm__buttons col s12 m12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">{{trans('enrollform.cancel')}}</a><a class="waves-effect waves-light btn ModalForm__button--active modal-go-to-4">{{trans('enrollform.next')}}</a></div>
        </div>
      </div>
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title"> <i class="ModalForm__header__title__icon material-icons modal-go-to-3">keyboard_backspace</i>{{trans('enrollform.title_form')}}</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger"> clear</i>
        </div>
        <div class="ModalForm__pages_container row">
          <h3 class="ModalForm__page__step">{{trans('enrollform.step')}} 4 {{trans('enrollform.of')}} 5</h3>
          <h4 class="ModalForm__page__section_title">{{trans('enrollform.student_details')}}</h4>
          <div class="input-field col s10 m8">
            <label for="startdate">{{trans('enrollform.select_start')}}</label>
            <input id="startdate" name="start_date" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 m2 material-icons">today</i>
          <div class="ModalForm__input--select input-field col s12 m8">
            <select id="pilot_program_select" name="pilot_program">
              <option value="" selected disabled>{{trans('enrollform.select_pilot')}}</option>
              <option value="1">Program 1</option>
              <option value="2">Program 2</option>
              <option value="3">Program 3</option>
            </select>
          </div>
          <div class="Modalform__input col s12 m12">
            <p>{{trans('enrollform.financial_aid')}}</p>
            <input id="financial-aid-input" type="radio" name="requesting_financial_aid" value="1" class="ModalForm__input with-gap">
            <label for="financial-aid-input">{{trans('enrollform.yes')}}</label>
            <input id="not-financial-aid-input" type="radio" name="requesting_financial_aid" value="0" class="ModalForm__input with-gap">
            <label for="not-financial-aid-input">{{trans('enrollform.no')}}</label>
          </div>
          <div class="Modalform__input col s12 m12">
            <p>{{trans('enrollform.va_benefits')}}</p>
            <input id="va-benefits-input" type="radio" name="elegible_va_benefits" value="1" class="ModalForm__input with-gap">
            <label for="va-benefits-input">{{trans('enrollform.yes')}}</label>
            <input id="not-va-benefits-input" type="radio" name="elegible_va_benefits" value="0" class="ModalForm__input with-gap">
            <label for="not-va-benefits-input">{{trans('enrollform.no')}}</label>
          </div>
          <div class="Modalform__input col s12 m12">
            <p>{{trans('enrollform.native_language')}}</p>
            <input id="native-english-input" type="radio" name="english_native_language" value="1" class="ModalForm__input with-gap">
            <label for="native-english-input">{{trans('enrollform.yes')}}</label>
            <input id="not-native-english-input" type="radio" name="english_native_language" value="0" class="ModalForm__input with-gap">
            <label for="not-native-english-input">{{trans('enrollform.no')}}</label>
          </div>
          <div class="Modalform__input col s12 m12">
            <p>

              Have you been convicted of a crime in the past 10 years that may
              prevent you from passing a criminal history records check administered
              by TSA?
            </p>
            <input id="crime-input" type="radio" name="convicted_crime" value="1" class="ModalForm__input with-gap">
            <label for="crime-input">{{trans('enrollform.yes')}}</label>
            <input id="not-crime-input" type="radio" name="convicted_crime" value="0" class="ModalForm__input with-gap">
            <label for="not-crime-input">{{trans('enrollform.no')}}</label>
          </div>
          <div class="input-field col s12 m12">
            <label for="flight-certificates">{{trans('enrollform.flight_certificates')}}</label>
            <input id="flight-certificates" name="flight_certificates_rating" type="text" class="ModalForm__input">
          </div>
          <div class="input-field col s12 m12">
            <label for="rating-schools">{{trans('enrollform.name_schools_rating')}}</label>
            <input id="rating-schools" name="schools_rating_obtained" type="text" class="ModalForm__input">
          </div>
          <div class="Modalform__input col s12 m12">
            <p>{{trans('enrollform.ffa_medical')}}</p>
            <input id="none-ffa-medical-input" type="radio" name="ffa_medical" value="none" class="ModalForm__input with-gap">
            <label for="none-ffa-medical-input">{{trans('enrollform.none')}}</label>
            <input id="first-ffa-medical-input" type="radio" name="ffa_medical" value="first class" class="ModalForm__input with-gap">
            <label for="first-ffa-medical-input">{{trans('enrollform.first_class')}}</label>
            <input id="second-ffa-medical-input" type="radio" name="ffa_medical" value="second class" class="ModalForm__input with-gap">
            <label for="second-ffa-medical-input">{{trans('enrollform.second_class')}}</label>
            <input id="thid-ffa-medical-input" type="radio" name="ffa_medical" value="third class" class="ModalForm__input with-gap">
            <label for="thid-ffa-medical-input">{{trans('enrollform.third_class')}}</label>
          </div>
          <div class="ModalForm__buttons col s12 m12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">{{trans('enrollform.cancel')}}</a><a class="waves-effect waves-light btn ModalForm__button--active modal-go-to-5">{{trans('enrollform.next')}}</a></div>
        </div>
      </div>
      <div class="ModalForm__page container col s2">
        <div class="ModalForm__header">
          <h2 class="ModalForm__header__title"> <i class="ModalForm__header__title__icon material-icons modal-go-to-4">keyboard_backspace</i>{{trans('enrollform.title_form')}}</h2><i data-target="modalconfirm" class="ModalForm__header__icon material-icons modal-trigger">clear</i>
        </div>
        <div class="ModalForm__pages_container row">
          <h3 class="ModalForm__page__step">{{trans('enrollform.step')}} 5 {{trans('enrollform.of')}} 5</h3>
          <h4 class="ModalForm__page__section_title">{{trans('enrollform.authentication')}}</h4>
          <div class="Modalform__input col s12 ModalForm__certification">
            <input id="confirmation-input" type="checkbox" name="information_application_factual" value="1" class="ModalForm__input">
            <label for="confirmation-input">{{trans('enrollform.app_factual')}}</label>
          </div>
          <div class="input-field file-field col s10">
            <div class="file-path-wrapper col s8 ModalForm__input_file">
              <input type="text" name="electronic_signature" placeholder="{{trans('enrollform.electronic_signature')}}" class="file-path validate">
            </div>
            <!--<div class="btn grey lighten-2 col s4 m2 black-text"><span>ADD</span>
              <input type="file">
            </div>-->
          </div>
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <div class="input-field col s6">
            <label for="todays_date">{{trans('enrollform.todays_date')}}</label>
            <input id="todays_date" name="todays_date" type="date" class="ModalForm__input datepicker">
          </div><i class="ModalForm__input_icon col s2 material-icons">today</i>
          <div class="ModalForm__buttons_margin col s12"></div>
          <div class="ModalForm__buttons col s12"><a data-target="modalconfirm" class="waves-effect waves-light btn ModalForm__button grey lighten-2 modal-trigger">{{trans('enrollform.cancel')}}</a>
            <input type="submit" value="{{trans('enrollform.submit')}}" class="waves-effect waves-light btn ModalForm__button--active">
          </div>
        </div>
      </div>
    </form>
  </div>
  <div id="modalconfirm" class="modal fit-size">
    <div class="modal-content">
      <h5>{{trans('enrollform.title_confirm')}}</h5>
    </div>
    <div class="modal-footer col s12 ModalForm__buttons--fit">
      <button class="waves-effect waves-light btn ModalForm__button--active modal-close">{{trans('enrollform.cancel')}}</button>
      <button id="modal-close-button" class="waves-effect waves-light btn ModalForm__button grey lighten-2">{{trans('enrollform.close')}}</button>
    </div>
  </div>

@endsection

@section('javascript-functions')
  <script src="{{URL::to('js/jquery-migrate-1.4.1.min.js')}}"></script>
  <script src="{{URL::to('js/jquery.validate.js')}}"></script>
  <script src="{{URL::to('js/additional-methods.js')}}"></script>
  <script src="{{URL::to('js/intlTelInput.js')}}" type="text/javascript"></script>
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
      window.closeForm = function closeForm() {
        $enrollModal.closeModal();
        $confirmModal.closeModal();
        $enrollForm.trigger('reset');
        translateToModalPage(1);
      }
      function translateToModalPage(page) {
        var $calendarHolder = $('.ModalForm .picker__holder');
        var pageTranslation = (100/6) - (100/6)*page;
        var calendarTranslation = - 8 -3*(100/6) + (100/6)*page;
        $enrollModalContainer.css('transform', 'translateX('+ pageTranslation +'%)');
        $calendarHolder.css('transform', 'translateX('+ calendarTranslation +'%)');
      }
      // Modals
      $modalTriggers.leanModal({ dismissible: false });
      // Material stuff
      $('select').material_select();
      $('.datepicker').pickadate({
        formatSubmit: 'yyyy/mm/dd',
        selectMonths: true,
        selectYears: 100,
        hiddenPrefix: 'prefix__',
        hiddenSuffix: '__suffix'
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
  <script>
    $('#phone').intlTelInput({
      utilsScript: "js/utils.js"
    });

    jQuery.validator.addMethod("validPhoneFormat", function(value, element) {
      if ($.trim(value)) {
        if ($(element).intlTelInput("isValidNumber")) {
          return true;
        } else {
          return false;
        }
      }

      return true;
    }, "Please enter a valid phone number.");


    $('#pilot_program_select').change(function () {
       $(this).valid();
    });
    $('#country_select').change(function () {
      $(this).valid();
    });
    $('#state_select').change(function () {
      $(this).valid();
    });
    $('#birthdate').change(function () {
      $(this).valid();
    });
    $('#startdate').change(function () {
      $(this).valid();
    });
    $('#todays_date').change(function () {
      $(this).valid();
    });

    $("#enroll-form").validate({
        ignore: [],
        invalidHandler: function(event, validator) {
          // 'this' refers to the form
          var errors = validator.numberOfInvalids();
          if (errors) {
            alert('You missed ' + errors + ' fields, please check the form again.');
          } else {
            $("div.error").hide();
          }
        },
        errorElement: "div",
        errorPlacement: function(error, element) {

            $(element).parent().append(error);


        },
        rules : {
          gender: {
            required: true
          },
          date_of_birth: {
            required: true
          },
          first_name : {
            required: true
          },
          last_name : {
            required: true
          },
          address : {
            required: true
          },
          country : {
            required: true
          },
          phone_number : {
            required: true,
            validPhoneFormat: true
          },
          email : {
            required: true,
            email: true
          },
          city : {
            required: true
          },
          state : {
            required: true
          },
          country : {
            required: true
          },
          zip_code : {
            required: true
          },
          city_country_of_birth : {
            required: true
          },
          citizenship : {
            required: true
          },
          school_name1 : {
            required: true
          },
          school_in_usa1 : {
            required: true
          },
          diploma_degree1 : {
            required: true
          },
          school_name2 : {
            required: true
          },
          school_in_usa2 : {
            required: true
          },
          diploma_degree2 : {
            required: true
          },
          start_date : {
            required: true
          },
          pilot_program : {
            required: true
          },
          requesting_financial_aid : {
            required: true
          },
          english_native_language : {
            required: true
          },
          convicted_crime : {
            required: true
          },
          information_application_factual : {
            required: true
          },
          electronic_signature : {
            required: true
          },
          todays_date : {
            required: true
          }
        },
        submitHandler: function(form){
          console.log($(form).serializeArray());

          $("#add-contact-btn").prop('disabled', true);

          var data = $(form).serializeArray();
          data[10].value = $("#phone").intlTelInput("getNumber");

          $.ajax({
            method: 'post',
            url: '{{route('addAdmission')}}',
            data: data
          }).done(function (response) {
            if(response.status === 0)
            {
              alert('Admission sent. Now follow the other steps to complete your admission.');
              closeForm();
            }
            else {
              alert("Error: We could not send your data. Please try again.");
            }
          })
        }
    });
  </script>
@endsection
