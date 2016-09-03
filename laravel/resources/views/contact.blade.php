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

        input.error {
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

        #phone-number-label{
            position: relative;
            float: left;
            margin-top: -10px;
            margin-bottom: 20px;
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
            <form id="form-add-contact" class="Contact__form" action="{{route('addcontact')}}" method="post">
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
                    <input id="comments" name="question" type="text">
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                <button id="add-contact-btn" class="btn-warning" type="submit">send</button>
            </form>
        </div>
    </div>
@endsection

@section('javascript-functions')
    <script src="{{URL::to('js/jquery-migrate-1.4.1.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/additional-methods.js')}}" type="text/javascript"></script>
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
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });
        }
    </script>
    <script>
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

                var data = $(form).serializeArray();
                data[2].value = $("#phoneNumber").intlTelInput("getNumber");

                $.ajax({
                   method: 'post',
                    url: '{{route('addcontact')}}',
                    data: data
                });
            }
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3yLB8Z-4fx9RsAOJETr7CndhqHjo_za4&amp;callback=initMap"></script>
@endsection