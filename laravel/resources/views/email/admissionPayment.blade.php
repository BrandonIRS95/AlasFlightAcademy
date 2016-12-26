@extends('layouts.mail')

@section('subtitle')
    Admission Payment
@endsection

@section('content')
    <div class="alert alert-success" style="
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
        box-sizing: border-box;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    ">
        Congratulations! Your admission payment was made successfully.
    </div>

    <ul class="list-group" style="
        padding-left: 0;
        margin-bottom: 20px;
        margin-top: 0;
        box-sizing: border-box;
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    ">
        @include('includes.list-group-item-info', ["title" => 'Payment information'])
        @include('includes.list-group-item', ["info" => '<b>Product:</b> Alas Flight Academy Admission'])
        @include('includes.list-group-item', ["info" => '<b>Cost (USD):</b> $150'])
        @include('includes.list-group-item', ["info" => '<b>E-mail:</b> '.$email])
        @include('includes.list-group-item', ["info" => '<b>Payment id:</b> '.$payment_id])
        @include('includes.list-group-item', ["info" => '<b>Payer id:</b> '.$payer_id])
        @include('includes.list-group-item', ["info" => '<b>Date:</b> '.$date])
    </ul>
@endsection