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
            margin-bottom: 5px;
        }
        .panel-heading{
            position: relative;
        }
        #newAirplane{
            position: absolute;
            top: 10px;
            right: 16px;
            font-size: 15px;
        }



    </style>
@endsection

@section('content')

    <div id="conteiner-calendar-events">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p></p><h3 class="panel-title">New Airplane</h3></p>
                <button id="newAirplane" type="button" class="btn btn-primary">New Airplane</button>
            </div>

            <div id="crateForm" class="col-md-8 col-md-offset-2">
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
                        <input type="text" class="form-control" name="photo" id="photo" placeholder="Photo">
                    </div>
                    <select class="form-control" name="status">
                        <option value="active">Active</option>
                        <option value="Unactive">Unactive</option>
                    </select>
                    <div class="form-footer">
                        <button id="cancel-add" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="add-airplane-btn" type="submit" class="btn btn-default">Save</button>
                        <input type="hidden" value="{{Session::token()}}" name="_token">
                    </div>
                </form>
            </div>

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
                        <td  data-id="{{$post->id}}" class="edit"><button id="editAirplane" class="btn btn-primary">Edit</button></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>




    <div id="airplane-modal" tabindex="-1" role="dialog" class="modal bs-example-modal-lg">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Airplane</h4>
                </div>
                <div class="modal-body">
                    <div id="editForm" >
                        <form id="form-edit-airplane">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" id="editName" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Plate</label>
                                <input type="text" class="form-control" name="plate" id="editPlate" placeholder="Plate">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Photo</label>
                                <input type="text" class="form-control" name="photo" id="editPhoto" placeholder="Photo">
                            </div>
                            <select class="form-control" name="status" id="editStatus">
                                <option value="active">Active</option>
                                <option value="Unactive">Unactive</option>
                            </select>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="edit-airplane-btn" type="submit" data-dismiss="modal" class="btn btn-primary">Save changes</button>
                        <input type="hidden" value="{{Session::token()}}" name="_token">
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

        //variables
        var token = '{{Session::token()}}';
        var url = '{{route('edit')}}';
        var idAirplane = 0;
        var postBodyElement = null;

        //Animations

        $('#crateForm').hide();

        $("#newAirplane").click(function() {
            $("#crateForm" ).show("slow");
            $('#newAirplane').hide();
        });

        $("#cancel-add").click(function() {
            $("#crateForm" ).hide("slow");
            $('#newAirplane').show();
        });

        //Add new Airplane
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

        //Edit Airplane
        $('.edit').on('click', function(event) {

            var $postBody =  $(event.currentTarget);
             idAirplane = $postBody.attr('data-id');
            console.log(idAirplane);

            getAirplaneById(idAirplane).done(function (response) {
                console.log(response);
               // $('.modal-body').html(response.contact.email);
                $('#editName').val(response.airplane.name);
                $('#editPlate').val(response.airplane.plate);
                $('#editPhoto').val(response.airplane.photo);
                $('#editStatus').val(response.airplane.status);


            });

            showModalAnimation($('#airplane-modal'));
        });

        function getAirplaneById(id)
        {
            return $.ajax({
                method: 'get',
                url: '{{route('getAirplaneById')}}'+'/id',
                data: {'id' : id}
            });
        }

        $('#edit-airplane-btn').on('click', function () {
           $.ajax({
               method: 'POST',
               url: url,
               data: {name: $('#editName').val(),
                      plate: $('#editPlate').val(),
                      photo: $('#editPhoto').val(),
                      status: $('#editStatus').val(), postId: idAirplane, _token: token}

           })
           .done(function (msg) {
                $(postBodyElement).text(msg['new_body']);
                location.reload();

           });
        });



    </script>

@endsection
