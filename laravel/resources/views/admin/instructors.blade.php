@extends('layouts.master-admin')
@section('individual-styles')

    <style>

        .panel {
            float: left;
            margin-left: 12%;
            width: 60%;
            margin-top: 30px;
            font-family: "HelveticaNeue-Light", "Helvetica-Neue", "Helvetica", "Arial", "Sans-serif", "serif";
        }
        .panelIn{
            padding-top: 10px;
            border-top: 1px solid #b0bec5;
        }
        .edit{
            cursor: pointer;
        }


    </style>
@endsection

@section('content')

    <div id="conteiner-calendar-events">
        <button id="newInstructor" type="button" class="btn btn-primary">New Instructor</button>
        <div class="panel panel-default">
            <table class="table table" >
                <thead>
                <tr>
                    <td><h4><strong>Id</strong></h4></td>
                    <td><h4><strong>Name</strong></h4></td>
                    <td><h4><strong>Created at</strong></h4></td>
                    <td><h4><strong></strong></h4></td>

                <tr>
                </thead>
                @foreach($posts as $post)
                    <tr class="post">
                        <td class="people">{{$post->id}}</td>
                        <td class="people">{{$post->person->last_name}} {{$post->person->first_name}}</td>
                        <td class="people">{{$post->created_at}}</td>
                        <td class="edit"><button class="btn btn-primary">Edit</button></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!--add instructor form-->
    <div id="instructor-modal" tabindex="-1" role="dialog" class="modal bs-example-modal-lg">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add instructor</h4>
                </div>
                <div class="modal-body">
                    <div id="instructorForm" >
                        <form id="form-add-instructor">
                            <div class="panelI">
                                <div class="form-group">
                                    <label for="exampleInputGender">Gender</label>
                                    <input type="text" class="form-control" name="gender" id="gender" placeholder="Gender">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFirstName">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputLastName">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity">City Country of Birth</label>
                                    <input type="text" class="form-control" name="city_country_of_birth" id="city_country_of_birth" placeholder="City Country of Birth">
                                </div>
                            </div>
                            <div class="panelIn">
                                <div class="form-group">
                                    <label for="exampleInputLastName">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                </div>
                            </div>
                            <input type="hidden" value="{{Session::token()}}" name="_token">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-footer">
                        <button type="button" class="btn btn-default" id="cancel-add" data-dismiss="modal">Close</button>
                        <button id="add-instructor-btn" type="submit" data-dismiss="modall" class="btn btn-primary">Save</button>

                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('javascript')
    <script src="{{URL::to('js/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/additional-methods.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/intlTelInput.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/autosize.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $('#newInstructor').click(function() {
            showModalAnimation($('#instructor-modal'));
            $('#newInstructor').hide();
        });

        $("#cancel-add").click(function() {
            $('#newInstructor').show();
        });

        $('#add-instructor-btn').click(function () {
            $('#form-add-instructor').submit();
        });


        //Add new Instructor
        $('#form-add-instructor').validate({
            errorClass: "error",
            errorElement: "span",
            rules: {
                gender:{
                    required: true
                },
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                city_country_of_birth: {
                    required: true
                },
                email:{
                    required:true
                },
                password:{
                    required:true
                }
            },
            submitHandler: function(form) {
                console.log('ENTRO');
                $('#add-instructor-btn').prop('disabled', true);
                $('#newInstructor').show();

                var data = $(form).serializeArray();

                $.ajax({
                    method: 'post',
                    url: '{{route('addinstructor')}}',
                    data: data
                }).done(function(response){
                    console.log(response);
                    var $form = $('#form-add-instructor');

                    if(response.status === 0)
                    {
                        $form.empty();
                        location.reload();
                    }
                    else
                    {
                        $form.append('<div class="done-message">Instructor not added.</div>');
                    }
                });
            }
        });

    </script>
@endsection