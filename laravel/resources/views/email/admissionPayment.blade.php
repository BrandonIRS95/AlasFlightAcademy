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

    <ul class="list-group">
        <li class="list-group-item list-group-item-info" >
            Payment information
        </li>
        <li class="list-group-item">
            <b>Product:</b> Alas Flight Academy Admission
        </li>
        <li class="list-group-item">
            <b>Cost (USD):</b> $150
        </li>
        <li class="list-group-item">
            <b>E-mail:</b> {{$email}}
        </li>
        <li class="list-group-item">
            <b>Payment id:</b> {{$payment_id}}
        </li>
        <li class="list-group-item">
            <b>Payer id:</b> {{$payer_id}}
        </li>
        <li class="list-group-item">
            <b>Date:</b> {{$date}}
        </li>
    </ul>
@endsection