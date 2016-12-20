<?php

namespace App;

require 'vendor/autoload.php';

define('SITE_URL', 'http://localhost/AlasFlightAcademy/laravel/public/payment');

$paypal = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'Adihqrx8m_1iktN6donLICKgZCSgv2q9HOe_-oriNPeWLOG4ZIRdd6FKiP2CQ64BeQqRGJF_MZt56655'
        ,
        'EEHHJejiGylsdiwhLw0TjNJnyl1AtSSBplwDjA2Lg8hbKUTdPM5GU_CTfP7JM-F0yG2FUtGa2uKxKPbe')
);