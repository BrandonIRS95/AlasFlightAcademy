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
            <b>E-mail:</b> garysol@gmail.com
        </li>
        <li class="list-group-item">
            <b>Payment id:</b> PAY-546654
        </li>
        <li class="list-group-item">
            <b>Payer id:</b> 6NC564S
        </li>
        <li class="list-group-item">
            <b>Date:</b> 2016-05-02 10:30:20
        </li>
    </ul>
@endsection