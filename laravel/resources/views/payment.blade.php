@extends('layouts.master-layout')

@section('individual-styles')

    <style>
        .Footer {
            display: none;
        }
    </style>
    <script src="{{URL::to('js/vue.js')}}"></script>
    <script src="{{URL::to('js/vue-resource.min.js')}}"></script>
    <script src="{{URL::to('js/vee-validate.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div id="app">
            <div class="section">
                <h5>Enrollment application payment</h5>
            </div>
            <div class="divider"></div>
            <div class="card-panel blue lighten-4">Remember, you need a <a href="https://www.paypal.com">PayPal</a> account to pay your admission.</div>
            <div v-if="!isRegistered" class="section">
                <div class="row">
                    <div class="input-field col s12">
                        <input v-validate data-vv-rules="required|email" :class="{'input': true, 'is-danger': errors.has('email') }" name="email" type="text" class="validate" v-model="email">
                        <div style="color: red;" v-show="errors.has('email')" class="help-block">@{{ errors.first('email') }}</div>
                        <label class="active" for="email">Enter the email which you register your Enrollment Application:</label>
                        <div class="card-panel  orange lighten-2" v-if="notRegistered">You're not registered in Alas Flight Academy, please go to <a
                                    href="enroll">Enroll Now</a> and complete the Enrollment Application (Step 1).</div>
                        <div v-if="searching" class="progress">
                            <div class="indeterminate"></div>
                        </div>
                        <br>
                        <button @click="checkIfIsRegistered()" class="waves-effect waves-light btn" v-bind:class="validateEmail || searching ? 'disabled' : ''">@{{message}}</button>
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
        Vue.use(VeeValidate);

        new Vue({
            el: '#app',
            data: {
                isRegistered: false,
                notRegistered: false,
                searching: false,
                message: 'Check e-mail',
                email: ''
            },
            methods: {
                checkIfIsRegistered() {
                    if(!this.validateEmail && this.searching === false) {
                        this.message = 'Checking e-mail';
                        this.searching = true;

                        this.$http.post('{{route('verifyEmail')}}', {email: this.email, _token: '{{Session::token()}}'}).then((response) => {
                            var found = response.body.found;
                            this.searching = false;
                            this.isRegistered = found;
                            this.notRegistered = !found;

                            if(!found) {
                                this.message = 'Check e-mail'
                            }


                        }, (response) => {
                            // error callback
                        });
                    }
                }
            },
            computed: {
                validateEmail: function() {
                    if(this.errors.has('email') || this.email.length === 0) return true;
                    return false;
                }
            }

        });
    </script>
@endsection

