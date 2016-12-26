@extends('layouts.master-layout')

@section('individual-styles')
    <style>
        .Footer {
            display: none;
        }

        [v-cloak] { display: none }
    </style>
    <script src="{{URL::to('js/vue.js')}}"></script>
    <script src="{{URL::to('js/vee-validate.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <div id="app">
            <div class="section">
                <h5>Admission payment</h5>
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
                <p>We send you an email with the payment information.</p>
            </div>
            @if($success)
                <div class="section">
                    <h5>Now, enter the password for your Alas Account:</h5>
                    <br>
                    <form id="form_password" method="post" action="{{route('addPassword')}}" @submit.prevent="validateBeforeSubmit">
                        <div class="input-field col s12">
                            <input v-validate data-vv-rules="required" name="password" type="password" class="validate" v-model="password">
                            <div style="color: red;" v-show="errors.has('password')" class="help-block">@{{ errors.first('password') }}</div>
                            <label class="active" for="email">Password:</label>
                        </div>
                        <div class="input-field col s12">
                            <input v-validate data-vv-rules="required" name="confirm_password" type="password" class="validate" v-model="confirm_password">
                            <div style="color: red;" v-show="errors.has('confirm_password')" class="help-block">@{{ errors.first('confirm_password') }}</div>
                            <label class="active" for="email">Confirm password:</label>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                            <input type="hidden" name="email" value="{{$email}}">
                            <br>
                            <div style="color: red;" v-show="notEqual" class="help-block">Passwords are not equal, please enter the same password.</div>
                            <br>
                            <button type="submit" class="waves-effect waves-light btn">OK</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('javascript-functions')
    <script type="text/javascript">
        Vue.use(VeeValidate);

        new Vue({
            el: '#app',
            data: {
                password: '',
                confirm_password: '',
                notEqual: false
            },
            methods: {
                validateBeforeSubmit() {
                    // Validate All returns a promise and provides the validation result.
                    this.$validator.validateAll().then(success => {
                        if (! success) {
                            // handle error
                            return;
                        }

                        if(this.password !== this.confirm_password){
                            this.notEqual = true;
                            return;
                        }
                        else this.notEqual = false;

                        document.getElementById('form_password').submit();

                    });
                }
            }
        });
    </script>
@endsection