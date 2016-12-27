@extends('layouts.master-layout')

@section('individual-styles')
    <style>
        .Footer {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div id="app">
            <div class="section">
                <h5>Password Change</h5>
            </div>
            <div class="divider"></div>
            @if ($updated)
            <div class="card-panel green accent-2">Your password has been change successfully, you can <a href="{{route('signin')}}">Sign in</a>.
                <br>
                We send you a mail with your password.
            </div>
            @endif

            @if (!$updated)
                <div class="card-panel deep-orange lighten-2">
                    We were unable to change your password. Please <a href="{{route("contact")}}">Contact us</a>. We apologize for any inconvenience this may cause.
                </div>
            @endif
        </div>
    </div>
@endsection