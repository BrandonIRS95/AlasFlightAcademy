@extends('layouts.master-layout')

@section('individual-styles')
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        html{
            height: 100%;
        }
        body, .Application_container{
            background: url(https://newevolutiondesigns.com/images/freebies/city-wallpaper-18.jpg) no-repeat fixed;
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
            text-align: center;
        }
       /* fieldset p {
            text-align: center;
        }
        #login form span{
            float: left;
        }*/
    </style>
@endsection
@section('content')
    <div id="clouds">
        <div class="cloud x1"></div>
        <!-- Time for multiple clouds to dance around -->
        <div class="cloud x2"></div>
        <div class="cloud x3"></div>
        <div class="cloud x4"></div>
        <div class="cloud x5"></div>
        <div class="cloud x6"></div>
        <div class="cloud x7"></div>
    </div>
    <div class="container">
        <div id="login">
            <form id="login-form" method="post" action="{{route('signin')}}">
                <fieldset class="clearfix">
                            <p><span class="fontawesome-user"></span><input placeholder="Username" type="text" name="email" id="email"></p>
                            <p><span class="fontawesome-lock"></span><input placeholder="Password" type="password" name="password" id="password"></p>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <p><input type="submit" value="Sign In"></p>
                </fieldset>
            </form>
        </div> <!-- end login -->

    </div>
@endsection
@section('javascript-functions')
    <script src="{{URL::to('js/jquery-migrate-1.4.1.min.js')}}"></script>
    <script src="{{URL::to('js/jquery.validate.js')}}"></script>
    <script src="{{URL::to('js/additional-methods.js')}}"></script>
    <script>
       /* $("#login-form").validate({
           rules: {
               email: {
                   required: true,
                   email: true
               },
               password: {
                   required: true
               }
           },
            submitHandler: function (form) {
                $.ajax({
                    method: 'post',
                    url: '',
                    data: $(form).serialize()
                }).done(function (response) {
                    console.log(response);
                });
            }
        });*/
    </script>
@endsection