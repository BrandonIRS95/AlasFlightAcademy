<?php

namespace App\Http\Controllers;

use App\Address;
use App\Admission;
use App\PersonLegalInformation;
use App\PilotProgram;
use App\SchoolRecord;
use App\TypeOfUser;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DateTime;
use App\Person;
use App\Http\Requests;

class AdmissionController extends Controller
{
    public function postAddAdmission(Request $request)
    {
        $person = new Person();
        $person->gender = $request['gender'];
        $person->date_of_birth = $request['prefix__date_of_birth__suffix'];
        $person->first_name = $request['first_name'];
        $person->last_name = $request['last_name'];
        $person->city_country_of_birth = $request['city_country_of_birth'];

        $person->save();

        $address = new Address();
        $address->address = $request['address'];
        $address->country = $request['country'];
        $address->state = $request['state'];
        $address->city = $request['city'];
        $address->zip_code = $request['zip_code'];
        $address->phone_number = $request['phone_number'];

        $person->address()->save($address);

        $legalInformation = new PersonLegalInformation();
        $legalInformation->citizenship = $request['citizenship'];
        $legalInformation->country_of_passport_issuance = $request['country_of_passport_issuance'];
        $legalInformation->passport_number = $request['passport_number'];
        $expiration = $request['prefix__passport_expiration_date__suffix'];
        $legalInformation->passport_expiration_date = (is_null($expiration) || empty($expiration) || strlen($expiration) < 1 ? NULL : $expiration);

        $person->legalInformation()->save($legalInformation);

        $schoolRecord1 = new SchoolRecord();
        $schoolRecord1->school_name = $request['school_name1'];
        $schoolRecord1->school_in_usa = $request['school_in_usa1'];
        $schoolRecord1->diploma_degree = $request['diploma_degree1'];
        $attendance1 = $request['prefix__attendance_date_finish1__suffix'];
        $schoolRecord1->attendance_date_finish = (is_null($attendance1) || empty($attendance1) || strlen($attendance1) < 1 ? NULL : $attendance1);

        $person->schoolRecords()->save($schoolRecord1);

        $schoolRecord2 = new SchoolRecord();
        $schoolRecord2->school_name = $request['school_name2'];
        $schoolRecord2->school_in_usa = $request['school_in_usa2'];
        $schoolRecord2->diploma_degree = $request['diploma_degree2'];
        $attendance2 = $request['prefix__attendance_date_finish2__suffix'];
        $schoolRecord2->attendance_date_finish = (is_null($attendance2) || empty($attendance2) || strlen($attendance2) < 1 ? NULL : $attendance2);

        $person->schoolRecords()->save($schoolRecord2);

        $admission = new Admission();
        $admission->status = 'onhold';
        $admission->start_date = $request['prefix__start_date__suffix'];
        $admission->requesting_financial_aid = $request['requesting_financial_aid'];
        $admission->elegible_va_benefits = $request['elegible_va_benefits'];
        $admission->english_native_language = $request['english_native_language'];
        $admission->convicted_crime = $request['convicted_crime'];
        $admission->flight_certificates_rating = $request['flight_certificates_rating'];
        $admission->schools_rating_obtained = $request['schools_rating_obtained'];
        $admission->ffa_medical = $request['ffa_medical'];
        $admission->information_application_factual = $request['information_application_factual'];
        $admission->electronic_signature = $request['electronic_signature'];
        $admission->todays_date = $request['prefix__todays_date__suffix'];
        $admission->person()->associate($person);
        $admission->pilotProgram()->associate(PilotProgram::find($request['pilot_program']));

        $admission->save();


        $user = new User();
        $user->password = bcrypt('alasfa2016');
        $user->status = 0;
        $user->typeOfUser()->associate(TypeOfUser::find(2));
        $user->email = $request['email'];
        $user->person()->associate($person);

        $user->save();

        return response()->json(['status' => 0,
            'message' => 'Admission successfully added.'], 200);

    }

    public function getAdmissionById(Request $request)
    {
        $admission = Admission::find($request['id']);
        $admission->person;
        $admission->person->user;
        $admission->pilotProgram;
        $admission->person->address;
        $admission->person->schoolRecords;
        $admission->person->legalInformation;

        return response()->json(['admission' => $admission,
            'status' => '0'], 200);
    }

    public function getStudentById(Request $request)
    {
        $admission = Admission::find($request['id']);
        $admission->person;
        $admission->person->user;
        $admission->pilotProgram;
        $admission->person->address;
        $admission->person->schoolRecords;
        $admission->person->legalInformation;

        return response()->json(['student' => $admission,
            'status' => '0'], 200);
    }
}
