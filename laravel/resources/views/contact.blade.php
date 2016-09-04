@extends('layouts.master-layout')

@section('individual-styles')
    <link rel="stylesheet" href="{{URL::to('css/contact-page.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/intlTelInput.css')}}">
    <style>
        #add-contact-btn {
            background: #f3a536;
            border: none;
            padding: 1em 2em;
            border-radius: 10px;
            color: white;
            text-transform: uppercase;
        }
        .Contact__form
        {
            text-align: center;
        }

        .input-field{
            margin-bottom: 30px;
        }

        span.error {
            position: relative;
            width: 100%;
            text-align: left;
            float: left;
            font-size: 12px;
            margin-top: -10px;
            color: red;
        }

        input.error, textarea.error {
            border-bottom: 1px solid red;
            box-shadow: 0 1px 0 0 red;
        }

        .country-name{
            color: dimgray;
        }

        .intl-tel-input{
            width: 100%;
            box-sizing: content-box;
        }

        #phoneNumber::-webkit-input-placeholder { /* Chrome/Opera/Safari */
            color:#9e9e9e;
        }
        #phoneNumber::-moz-placeholder { /* Firefox 19+ */
            color: #9e9e9e;
        }
        #phoneNumber:-ms-input-placeholder { /* IE 10+ */
            color: #9e9e9e;
        }
        #phoneNumber:-moz-placeholder { /* Firefox 18- */
            color: #9e9e9e;
        }

        #content-email {
            margin-top: 50px;
        }

        #phoneNumber-error{
            position: absolute;
            left: 0;
            top: 60px;
        }

        #phone-number-label{
            position: relative;
            float: left;
            margin-top: -10px;
            margin-bottom: 20px;
        }

        #form-add-contact img {
            width: 200px;
        }

        .done-message{
            font-size: 2em;
            color: #FFFFFF;
        }

        #comments {
            padding-top: 10px;
            border-top: none;
            border-left: none;
            border-right: none;
            outline:none;
            resize: none;
        }

        #comments:focus:not([readonly]){
            border-bottom: 1px solid #367ac8;
            box-shadow: 0 1px 0 0 #367ac8;
        }

        #comments-error{
            margin-top: 5px;
        }

    </style>
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
            <form id="form-add-contact" class="Contact__form" autocomplete="off">
                <div class="input-field">
                    <label for="firstName">First Name *</label>
                    <input id="firstName" name="first_name" type="text">
                </div>
                <div class="input-field">
                    <label for="lastName">Last Name (optional)</label>
                    <input id="lastName" name="last_name" type="text">
                </div>
                <div class="input-field">
                    <label id="phone-number-label">Phone Number (optional)</label>
                    <input id="phoneNumber" name="phone_number" type="tel">
                </div>
                <div id="content-email" class="input-field">
                    <label for="email">E-mail *</label>
                    <input id="email" name="email" type="text">
                </div>
                <div class="input-field">
                    <label for="comments">Comments or questions *</label>
                    <textarea id="comments" name="question" type="text" rows="2"></textarea>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button id="add-contact-btn" class="btn-warning" type="submit">send</button>
            </form>
        </div>
    </div>
@endsection

@section('javascript-functions')
    <script src="{{URL::to('js/jquery-migrate-1.4.1.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/TweenMax.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/additional-methods.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/intlTelInput.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/autosize.js')}}" type="text/javascript"></script>
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
    <script>

        autosize($("#comments"));

        $('#phoneNumber').intlTelInput({
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

        jQuery.validator.addMethod("nulleable", function(value, element) {
            return true;
        }, "Please enter a valid phone number.");

        $('#form-add-contact').validate({
            errorClass: "error",
            errorElement: "span",
            rules: {
                phone_number: {
                    validPhoneFormat: true
                },
                first_name:{
                    required: true
                },
                last_name: {
                    nulleable: true
                },
                email: {
                    required: true,
                    email: true
                },
                question: {
                    required: true
                }
            },
            submitHandler: function(form) {

                $("#add-contact-btn").prop('disabled', true);

                var data = $(form).serializeArray();
                data[2].value = $("#phoneNumber").intlTelInput("getNumber");

                $.ajax({
                   method: 'post',

                    url: '{{route('addcontact')}}',
                    data: data
                }).done(function(response){
                    console.log(response);
                    var $form = $('#form-add-contact');

                    if(response.status === 0)
                    {

                        $form.empty();
                        $form.append('<img id="done-icon" src="{{URL::to('images/icons/ic_done_white_1024px.svg')}}" /><div class="done-message">We\'ll reply you in your email.<br>Thank you!</div>');
                        TweenMax.from($("#done-icon"), 0.8, {opacity: 0, scale: 0, rotation:360});
                        TweenMax.from($(".done-message"), 0.8, {opacity: 0, rotationY: 360});
                    }
                    else
                    {
                        $form.append('<div class="done-message">This service is not available.<br>We\'re working on it, sorry for the inconvenience.</div>');
                    }
                });
            }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3yLB8Z-4fx9RsAOJETr7CndhqHjo_za4&amp;callback=initMap"></script>
@endsection