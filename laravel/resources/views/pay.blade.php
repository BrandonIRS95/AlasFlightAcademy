@extends('layouts.master-layout')

@section('individual-styles')
    <style>
        .Footer {
            display: none;
        }

        [v-cloak] { display: none }
    </style>
    <script src="{{URL::to('js/vue.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div id="app">
            <div class="section">
                <h5>Enrollment application payment</h5>
            </div>
            <div class="divider"></div>
            <div class="card-panel {{$success ? 'green accent-2' : 'orange lighten-2'}}">
                <h5>
                    @if($success)
                        CONGRATULATIONS! Your pay has been made successfully!
                    @endif

                    @if(!$success)
                        Something went wrong with the payment. Please <a href="{{route('contact')}}">Contact us</a> to help you with this issue.
                    @endif
                </h5>
            </div>
            @if($success)
                <div class="section">
                    <p>Now you can <a href="{{route('signin')}}">Sign in</a> with your email in Alas Flight Academy.</p>
                    <p>The adventure begins!</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('javascript-functions')
    <script type="text/javascript">

    </script>
@endsection