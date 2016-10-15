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

        .people{
            cursor: pointer;
        }
        .modal-dialog{
            width: 70%;
        }


    </style>

@endsection
@section('content')

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

    <div tabindex="-1" role="dialog" id="aspirant-modal" class="modal bs-example-modal-lg">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Aspirant information</h4>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class='col-sm-4'>
                            <div class="form-group">
                                <p><strong>Personal Information</strong></p>
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
                        </div>
                        <div class='col-sm-4'>
                            <div class="form-group">
                                <p><strong>Student Details</strong></p>
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
                        <div class='col-sm-4'>
                            <div class="form-group">
                                <p><strong>School Record</strong></p>
                                <ul class="list-group">
                                    <li id="person-schoolName" class="list-group-item"></li>
                                    <li id="person-schoolInUsa" class="list-group-item"></li>
                                    <li id="person-diplomaDegree" class="list-group-item"></li>
                                    <li id="person-attendanceDateFinish" class="list-group-item"></li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <p><strong>School Record 2</strong></p>
                                <ul class="list-group">
                                    <li id="person-schoolName1" class="list-group-item"></li>
                                    <li id="person-schoolInUsa1" class="list-group-item"></li>
                                    <li id="person-diplomaDegree1" class="list-group-item"></li>
                                    <li id="person-attendanceDateFinish1" class="list-group-item"></li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <p><strong>Authentication</strong></p>
                                <ul class="list-group">
                                    <li id="person-informationApplicationFactual" class="list-group-item"></li>
                                    <li id="person-electronicSignature" class="list-group-item"></li>
                                    <li id="person-todaysDate" class="list-group-item"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="close-modal" type="button" class="btn btn-default custom-btn-default">Close</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('javascript')
    <script type="text/javascript">

        $('#close-modal').click(function(){
            hideModalAnimation($('#aspirant-modal'))
        });

        $('.post').on('click', function(event) {
            var $postBody =  $(event.currentTarget);
            var idAdmission = $postBody.attr('data-id');
            console.log(idAdmission);

            getStudentById(idAdmission).done(function (response) {
                console.log(response);
                //Personal Information
                $('#person-gender').html("<Strong>Gender :</Strong> " + response.student.person.gender);
                $('#person-dateOfBirth').html("<Strong>Date of birth :</Strong> " + response.student.person.date_of_birth);
                $('#person-fullName').html("<Strong>Name :</Strong> " +  response.student.person.last_name+" "+response.student.person.first_name);
                $('#person-email').html("<Strong>Email :</Strong> " + response.student.person.user.email);
                $('#person-address').html("<Strong>Address :</Strong> " + response.student.person.address.address);
                $('#person-city').html("<Strong>City :</Strong> " + response.student.person.address.city);
                $('#person-country').html("<Strong>Country :</Strong> " + response.student.person.address.country);
                $('#person-phoneNumber').html("<Strong>Phone Number :</Strong> " + response.student.person.address.phone_number);
                $('#person-state').html("<Strong>State :</Strong> " + response.student.person.address.state);
                $('#person-zipCode').html("<Strong>Zip Code :</Strong> " + response.student.person.address.zip_code);
                //Student Detail
                $('#person-cityCountryOfBirth').html("<Strong>City Country Of Birth :</Strong> " + response.student.person.city_country_of_birth);
                $('#person-citizenship').html("<Strong>Citizenship :</Strong> " + response.student.person.legal_information.citizenship);
                $('#person-countryOfPassportIssuance').html("<Strong>Country Of Passport Issuance :</Strong> " + response.student.person.legal_information.country_of_passport_issuance);
                $('#person-passportNumber').html("<Strong>Passport Number :</Strong> " + response.student.person.legal_information.passport_number);
                $('#person-passportExpiration').html("<Strong>Passport Expiration Date:</Strong> " + response.student.person.legal_information.passport_expiration_date);
                $('#person-startDate').html("<Strong>Start Date :</Strong> " + response.student.start_date);
                $('#person-pilotProgram').html("<Strong>Pilot Program :</Strong> " + response.student.pilot_program.name);
                $('#person-requestingFinancialAid').html("<Strong>Requesting Financial Aid? :</Strong> " +  response.student.requesting_financial_aid == 1 ? '<Strong>Requesting Financial Aid? :</Strong> yes' : '<Strong>Requesting Financial Aid? :</Strong> no');
                $('#person-elegibleVaBenefits').html("<Strong>Elegible VA Benefits? :</Strong> " + response.student.elegible_va_benefits  == 1 ? '<Strong>Elegible VA Benefits? :</Strong> yes' : '<Strong>Elegible VA Benefits? :</Strong> no');
                $('#person-englishNativeLanguage').html("<Strong>English Native Language ? :</Strong> " + response.student.english_native_language  == 1 ? '<Strong>English Native Language ? :</Strong> yes' : '<Strong>English Native Language ? :</Strong> no');
                $('#person-convictedCrime').html("<Strong>Convicted Crime? :</Strong> " + response.student.convicted_crime  == 1 ? '<Strong>Convicted Crime? :</Strong> yes' : '<Strong>Convicted Crime? :</Strong> no');
                $('#person-flightCertificatesRating').html("<Strong>Flight Certificates Rating :</Strong> " + response.student.flight_certificates_rating);
                $('#person-schoolsRatingObtained').html("<Strong>Schools Rating Obtained :</Strong> " + response.student.schools_rating_obtained);
                $('#person-ffaMedical').html("<Strong>Ffa Medical :</Strong> " + response.student.ffa_medical);
                //School Records
                $('#person-schoolName').html("<Strong>School Name :</strong>" + response.student.person.school_records[0].school_name);
                $('#person-schoolInUsa').html("<Strong>School In Usa? :</strong>" + response.student.person.school_records[0].school_in_usa == 1 ? '<Strong>School In Usa? :</strong> yes' : '<Strong>School In Usa? :</strong> no');
                $('#person-diplomaDegree').html("<Strong>Diploma Degree :</strong>" + response.student.person.school_records[0].diploma_degree);
                $('#person-attendanceDateFinish').html("<Strong>Attendance Date Finish :</strong>" + response.student.person.school_records[0].attendance_date_finish);

                $('#person-schoolName1').html("<Strong>School Name :</strong>" + response.student.person.school_records[1].school_name);
                $('#person-schoolInUsa1').html("<Strong>School In Usa? :</strong>" + response.student.person.school_records[1].school_in_usa == 1 ? '<Strong>School In Usa? :</strong> yes' : '<Strong>School In Usa? :</strong> no');
                $('#person-diplomaDegree1').html("<Strong>Diploma Degree :</strong>" + response.student.person.school_records[1].diploma_degree);
                $('#person-attendanceDateFinish1').html("<Strong>Attendance Date Finish :</strong>" + response.student.person.school_records[1].attendance_date_finish);
                //Authentication
                $('#person-informationApplicationFactual').html("<Strong>Information Application Factual :</Strong> " + response.student.information_application_factual == 1 ? '<Strong>Information Application Factual :</Strong> yes' : '<Strong>Information Application Factual :</Strong> no');
                $('#person-electronicSignature').html("<Strong>Electronic Signature :</Strong> " + response.student.electronic_signature);
                $('#person-todaysDate').html("<Strong>Todays Date :</Strong> " + response.student.todays_date);

            });
            showModalAnimation($('#aspirant-modal'));
        });

        function getStudentById(id){
            return $.ajax({
                method: 'get',
                url: '{{route('getStudentById')}}'+'/id',
                data: {'id' : id}
            });
        }


    </script>
@endsection
