<?php

namespace App\Http\Controllers;

use App\Address;
use App\PersonLegalInformation;
use App\SchoolRecord;
use Illuminate\Http\Request;
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
        $legalInformation->passport_expiration_date = $request['prefix__passport_expiration_date__suffix'];

        $person->legalInformation()->save($legalInformation);

        $schoolRecord1 = new SchoolRecord();
        $schoolRecord1->school_name = $request['school_name1'];
        $schoolRecord1->school_in_usa = $request['school_in_usa1'];
        $schoolRecord1->diploma_degree = $request['diploma_degree1'];
        $schoolRecord1->attendance_date_finish = $request['prefix__attendance_date_finish1__suffix'];

        $person->schoolRecords()->save($schoolRecord1);

        $schoolRecord2 = new SchoolRecord();
        $schoolRecord2->school_name = $request['school_name2'];
        $schoolRecord2->school_in_usa = $request['school_in_usa2'];
        $schoolRecord2->diploma_degree = $request['diploma_degree2'];
        $schoolRecord2->attendance_date_finish = $request['prefix__attendance_date_finish2__suffix'];

        $person->schoolRecords()->save($schoolRecord2);





    }
}
