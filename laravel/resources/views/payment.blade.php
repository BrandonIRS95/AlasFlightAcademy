@extends('layouts.master-layout')

@section('individual-styles')

    <style>
        .Footer {
            display: none;
        }
    </style>
    <script src="{{URL::to('js/vue-resource.min.js')}}"></script>
    <script src="{{URL::to('js/vue.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div id="app">
            <div class="section">
                <h5>Admission payment</h5>
            </div>
            <div class="divider"></div>
            <div class="card-panel blue lighten-4">Remember, you need a <a href="https://www.paypal.com">PayPal</a> account to pay your admission.</div>
            <div v-if="!isRegistered" class="section">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="first_name2" type="text" class="validate">
                        <label class="active" for="first_name2">Enter the email which you register your Enrollment Application:</label>
                        <div class="card-panel  orange lighten-2" v-if="notRegistered">You're not registered in Alas Flight Academy, please go to <a
                                    href="enroll">Enroll Now</a> and complete the Enrollment Application (Step 1).</div>
                        <button @click="checkIfIsRegistered()" class="waves-effect waves-light btn">OK</button>
                    </div>
                </div>
            </div>
            <div v-if="isRegistered" class="section">
                <div class="row">
                    <div class="input-field col s12">
                        <h5>You are registered, now click continue to go to the next step.</h5>
                        <h6>Make sure you have your PayPal account ready.</h6>
                    </div>
                </div>
                <button class="waves-effect green accent-4 btn">Continue</button>
            </div>
        </div>
    </div>
@endsection

@section('javascript-functions')
    <script type="text/javascript">
        new Vue({
            el: '#app',
            data: {
                isRegistered: false,
                notRegistered: false
            },
            methods: {
                checkIfIsRegistered() {
                    this.isRegistered = true;
                }
            }
        });
    </script>
@endsection

