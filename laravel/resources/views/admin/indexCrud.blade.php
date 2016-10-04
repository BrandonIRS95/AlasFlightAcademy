@extends('layouts.master-admin')
{{-- Page title --}}
@section('title')
    Users List
    @parent
@stop
@section('title-view')

    @endsection
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('content')

    <section class="content-header">
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('userCrud') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="{{ route('indexCrud') }}">Users</a></li>
            <li class="active">Add New User</li>
        </ol>
    </section>
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Users List
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User E-mail</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{!! $user->id !!}</td>
                                <td>{!! $user->first_name !!}</td>
                                <td>{!! $user->last_name !!}</td>
                                <td>{!! $user->email !!}</td>
                                <td>
                                    @if($activation = Activation::completed($user))
                                        Activated
                                    @else
                                        Pending
                                    @endif
                                </td>

                                <td>
                                    <a ><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>

                                    <a ><i class="livicon" data-name="edit"
                                                                                            data-size="18" data-loop="true"
                                                                                            data-c="#428BCA"
                                                                                            data-hc="#428BCA"
                                                                                            title="update user"></i></a>

                                    @if ((Sentinel::getUser()->id != $user->id) && ($user->id != 1))
                                        <a href="{{ route('confirm-delete/user', $user->id) }}" data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>
                                    @endif


                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>    <!-- row-->
    </section>
        <!--row end-->
    </section>
    @endsection