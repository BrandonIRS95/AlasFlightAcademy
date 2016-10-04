@extends('layouts.master-admin')

@section('individual-styles')

    <style>

        .panel {
            float: left;
            margin-left: 12%;
            width: 60%;
            margin-top: 60px;
            font-family: "HelveticaNeue-Light", "Helvetica-Neue", "Helvetica", "Arial", "Sans-serif", "serif";
        }
        .edit{
            cursor: pointer;
        }
        .form-footer{
            float: right;
            margin-top: 5px;
        }
    </style>
@endsection

@section('content')
    <dvi class="newAirplane">
        <button id="newAirplane" type="button" class="btn btn-primary">New</button>
    </dvi>

    <div id="crateForm" class="col-md-6 col-md-offset-2">
        <form id="form-add-airplane">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Plate</label>
                <input type="text" class="form-control" name="plate" id="plate" placeholder="Plate">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Photo</label>
                <input type="text" class="form-control" name="photo" id="name" placeholder="Name">
            </div>
            <select class="form-control" name="status">
                <option value="active">Active</option>
                <option value="Unactive">Unactive</option>
            </select>
            <div class="form-footer">
                <button id="cancel-add" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="add-airplane-btn" type="submit" class="btn btn-default">Submit</button>
                <input type="hidden" value="{{Session::token()}}" name="_token">
            </div>
        </form>
    </div>

    <div class="panel panel-default">
        <table class="table table" >
            <thead>
            <tr>
                <td><h4><strong>Id</strong></h4></td>
                <td><h4><strong>Name</strong></h4></td>
                <td><h4><strong>Plate</strong></h4></td>
                <td><h4><strong>Status</strong></h4></td>
                <td><h4><strong>Created at</strong></h4></td>
                <td><h4><strong></strong></h4></td>

            <tr>
            </thead>
            @foreach($posts as $post)
                <tr class="post">
                    <td class="people">{{$post->id}}</td>
                    <td class="people">{{$post->name}}</td>
                    <td class="people">{{$post->plate}}</td>
                    <td class="people">{{$post->status}}</td>
                    <td class="people">{{$post->created_at}}</td>
                    <td class="edit"><button class="btn btn-primary">Edit</button></td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
@section('javascript')
    <script src="{{URL::to('js/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/additional-methods.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/intlTelInput.js')}}" type="text/javascript"></script>
    <script src="{{URL::to('js/autosize.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

        $('#crateForm').hide();

        $( "#newAirplane" ).click(function() {
            $("#crateForm" ).show("slow");
            $('#newAirplane').hide();
        });

        $( "#cancel-add" ).click(function() {
            $("#crateForm" ).hide("slow");
            $('#newAirplane').show();
        });

        $('#form-add-airplane').validate({
            errorClass: "error",
            errorElement: "span",
            rules: {
                name:{
                    required: true
                },
                plate: {
                    required: true
                },
                photo: {
                    required: true
                },
                status: {
                    required: true
                }
            },
            submitHandler: function(form) {

                $("#add-airplane-btn").prop('disabled', true);
                $('#newAirplane').show();

                var data = $(form).serializeArray();

                $.ajax({
                    method: 'post',

                    url: '{{route('addairplane')}}',
                    data: data
                }).done(function(response){
                    console.log(response);
                    var $form = $('#form-add-airplane');

                    if(response.status === 0)
                    {

                        $form.empty();
                        location.reload();
                    }
                    else
                    {
                        $form.append('<div class="done-message">Airplane not added.</div>');
                    }
                });
            }
        });
    </script>

@endsection
