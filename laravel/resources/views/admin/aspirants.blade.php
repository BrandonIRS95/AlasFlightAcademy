@extends('layouts.master-admin')

@section('individual-styles')
    <link rel="stylesheet" href="{{URL::to('css/admin/bootstrap.css')}}" >
        <style>
        .panel {
            float: left;
            margin-left: 12%;
            width: 60%;
            margin-top: 30px;
            font-family: "HelveticaNeue-Light", "Helvetica-Neue", "Helvetica", "Arial", "Sans-serif", "serif";
        }

        .people{
            cursor: pointer;
        }
        .modal-dialog {
            width: 60%;
        }

    </style>

@endsection
@section('content')
    <section class="row posts">
        <div class="panel panel-default">
               <table class="table table-striped" >
                   <thead>
                        <tr>
                            <td><h4><strong>Name</strong></h4></td>
                            <td><h4><strong>Gender</strong></h4></td>
                            <td><h4><strong>City/Country of birth</strong></h4></td>
                            <td><h4><strong>Pilot program</strong></h4></td>

                        <tr>
                   </thead>
                   @foreach($posts as $post)
                   <tr class="post" data-id="{{$post->id}}">
                        <td class="people">{{$post->Person->last_name }} {{$post->Person->first_name}}</td>
                        <td class="people">{{$post->Person->gender}}</td>
                        <td class="people">{{$post->Person->city_country_of_birth}}</td>
                        <td class="people">{{$post->PilotProgram->name}}</td>
                   </tr>
                   @endforeach
               </table>
            {!! $posts->render() !!}
        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="aspirant-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Aspirant information</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="post-body"> Personal information</label>
                        <ul class="list-group">
                            <li id="person-dateOfBirth" class="list-group-item"></li>
                            <li id="person-fullName" class="list-group-item"></li>
                            <li id="person-FullName" class="list-group-item"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('javascript')
    <script src="{{URL::to('js/jquery-migrate-1.4.1.min.js')}}"></script>
    <script src="{{URL::to('js/admin/bootstrap.min.js')}}"></script>
    <script type="text/javascript">


        $('.post').on('click', function(event) {
            event.preventDefault();

            var $postBody =  $(event.currentTarget);
            var idAdmission = $postBody.attr('data-id');
            console.log(idAdmission);

            getAdmissionById(idAdmission).done(function (response) {
                console.log(response);
                $('#person-dateOfBirth').html("<Strong>Date of birth :</Strong> " + response.admission.person.date_of_birth);
                $('#person-fullName').html("<Strong>Name :</Strong> " +  response.admission.person.last_name+" "+response.admission.person.first_name);
                $('#person-Email').html("<Strong>Name :</Strong> " + response.admission.id);
                $('#person-Address').html("Id: " + response.admission.id);
            });

           $('#aspirant-modal').modal();
        });

        function getAdmissionById(id)
        {
            return $.ajax({
                method: 'get',
                url: '{{route('getAdmissionById')}}'+'/id',
                data: {'id' : id}
            });
        }


    </script>
 @endsection

