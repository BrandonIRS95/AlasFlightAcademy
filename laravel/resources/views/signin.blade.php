@extends('layouts.master-layout')

@section('individual-styles')
    <!-- Latest compiled and minified CSS -->
    <style>
        html{
            background: url({{URL::to('images/clouds-1579565_1920.jpg')}}) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            height: 100%;
        }
        body, .Application_container{
            height: 100%;
        }
        .Footer{
            position: absolute;
            bottom: 0px;
            width: 100%;
            display: none;
        }
        label, input {
            color: white;
        }
    </style>
@endsection

@section('content')
    <div>
        <form id="login-form" method="post" action="{{route('signin')}}">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <button type="submit">Sign in</button>
        </form>
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