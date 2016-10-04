@extends('layouts.master-admin')

@section('title-view')

    @endsection
@section('content')
    <!--page level css -->
    <link href="{{ asset('/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="{{ asset('/css/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
    <section class="content-header">
        <h1>Add New User</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('userCrud') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Users</li>
            <li class="active">Add New User</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <!--row end-->
    </section>
    @endsection