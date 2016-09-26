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
                        <ul class="list-group">
                            <li id="person-gender" class="list-group-item"></li>
                            <li id="person-dateOfBirth" class="list-group-item"></li>
                            <li id="person-fullName" class="list-group-item"></li>
                            <li id="person-email" class="list-group-item"></li>
                            <li id="person-address" class="list-group-item"></li>
                            <li id="person-city" class="list-group-item"></li>
                            <li id="person-country" class="list-group-item"></li>
                            <li id="person-phoneNumber" class="list-group-item"></li>
                            <li id="person-state" class="list-group-item"></li>
                            <li id="person-zipCode" class="list-group-item"></li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <ul class="list-group">
                            <li id="person-cityCountryOfBirth" class="list-group-item"></li>
                            <li id="person-citizenship" class="list-group-item"></li>
                            <li id="person-countryOfPassportIssuance" class="list-group-item"></li>
                            <li id="person-passportNumber" class="list-group-item"></li>
                            <li id="person-passportExpiration" class="list-group-item"></li>

                            <li id="person-startDate" class="list-group-item"></li>
                            <li id="person-pilotProgram" class="list-group-item"></li>
                            <li id="person-requestingFinancialAid" class="list-group-item"></li>
                            <li id="person-elegibleVaBenefits" class="list-group-item"></li>
                            <li id="person-englishNativeLanguage" class="list-group-item"></li>
                            <li id="person-convictedCrime" class="list-group-item"></li>
                            <li id="person-flightCertificatesRating" class="list-group-item"></li>
                            <li id="person-schoolsRatingObtained" class="list-group-item"></li>
                            <li id="person-ffaMedical" class="list-group-item"></li>
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
                //Personal Information
                $('#person-gender').html("<Strong>Gender :</Strong> " + response.admission.person.gender);
                $('#person-dateOfBirth').html("<Strong>Date of birth :</Strong> " + response.admission.person.date_of_birth);
                $('#person-fullName').html("<Strong>Name :</Strong> " +  response.admission.person.last_name+" "+response.admission.person.first_name);
                $('#person-email').html("<Strong>Email :</Strong> " + response.admission.person.user.email);
                $('#person-address').html("<Strong>Address :</Strong> " + response.admission.person.address.address);
                $('#person-city').html("<Strong>City :</Strong> " + response.admission.person.address.city);
                $('#person-country').html("<Strong>Country :</Strong> " + response.admission.person.address.country);
                $('#person-phoneNumber').html("<Strong>Phone Number :</Strong> " + response.admission.person.address.phone_number);
                $('#person-state').html("<Strong>State :</Strong> " + response.admission.person.address.state);
                $('#person-zipCode').html("<Strong>Zip Code :</Strong> " + response.admission.person.address.zip_code);
                //Student Detail
                $('#person-cityCountryOfBirth').html("<Strong>City Country Of Birth :</Strong> " + response.admission.person.city_country_of_birth);

                $('#person-startDate').html("<Strong>Start Date :</Strong> " + response.admission.start_date);
                $('#person-pilotProgram').html("<Strong>Pilot Program :</Strong> " + response.admission.pilot_program.name);
                $('#person-requestingFinancialAid').html("<Strong>Requesting Financial Aid :</Strong> " + response.admission.requesting_financial_aid);

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

