@extends('layouts.master-layout')

@section('individual-styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        html{
            height: 100%;
        }
        body, .Application_container{
            /*background: url(https://newevolutiondesigns.com/images/freebies/city-wallpaper-18.jpg) no-repeat fixed;*/
            height: 100%;
        }
        .Footer{
            position: absolute;
            bottom: 0px;
            height: 15%;
            width: 100%;
        }
        label, input {
            color: white;
        }

        fieldset {
            border: 1px solid transparent;
        }

        
        #alas-video{
            position: absolute;
              top: 50%; 
              left: 50%;
              -webkit-transform: translateX(-50%) translateY(-50%);
              transform: translateX(-50%) translateY(-50%);
              min-width: 100%; 
              min-height: 100%; 
              width: auto; 
              height: auto;
              z-index: 0; 
              overflow: hidden;
        }
        .Navbar{
            z-index: 10;
            position: absolute;
        }
        
        .Footer{
            display: none;
        }

        .horizontal-center{
            padding-left: 30px;
        }

    </style>
@endsection
@section('content')
    <video id="alas-video" width="100%" autoplay loop>
        <source src="{{URL::to('videos/sky.mp4')}}" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    <!--<div id="clouds">
        <div class="cloud x1"></div>
        
        <div class="cloud x2"></div>
        <div class="cloud x3"></div>
        <div class="cloud x4"></div>
        <div class="cloud x5"></div>
        <div class="cloud x6"></div>
        <div class="cloud x7"></div>
    </div>-->
    <!DOCTYPE html>
    <html >
    <head>
        <meta charset="UTF-8">
        <title>boxy-login</title>
        <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
        <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
        <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css'>
        <link rel="stylesheet" href="css/styleLogin.css">

    </head>

    <body>

    <div id="wrapper">

        <div id="boxy-login-wrapper">

            <form id="boxy-login-form" name="boxy-login-form" >

                <fieldset>
                    <div class="boxy-form-inner rotateFirst3d">

                        <span class="end-cap left"><span class="glyphicon glyphicon-user" data-toggle="tooltip" title="click to login"></span></span>

                        <span class="side front">
                                  <span class="glyphicon glyphicon-user" data-toggle="tooltip" title="enter your username"></span>
                                  <input id="boxy-input"  type="input" name="username" class="rotate" placeholder="username" required />
                                  <button class="boxy-button next-field" data-step="0"></button>
                            </span>

                        <span class="side bottom">
                                  <span class="glyphicon glyphicon-asterisk" data-toggle="tooltip" title="enter your password"></span>
                                  <input style="padding: 0px 0px 0px 20px;" id="boxy-password" step="2" type="password" name="password" class="rotate" placeholder="password" required />
                                  <button type="submit" onclick="login();" class="btn-primary" data-step="1"></button>
                            </span>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.2.0/bootbox.min.js'></script>
    <script src='http://s3-us-west-2.amazonaws.com/s.cdpn.io/1251/bootstrap.glyphs.js'></script>

    <script src="js/indexLogin.js"></script>



    </body>
    </html>

@endsection
@section('javascript-functions')
    <script src="{{URL::to('js/jquery-migrate-1.4.1.min.js')}}"></script>
    <script src="{{URL::to('js/jquery.validate.js')}}"></script>
    <script src="{{URL::to('js/additional-methods.js')}}"></script>
    <script>
        function login(){
            var email = document.getElementById("boxy-input").value;
            var password = document.getElementById("boxy-password").value;
            alert(email +" : "+password);
        }
        
    </script>
@endsection
