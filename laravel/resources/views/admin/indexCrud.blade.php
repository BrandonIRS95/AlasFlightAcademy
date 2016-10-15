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
            <li>Users</li>
            <li class="active">
                <a href="{{ route('userCrud') }}">
                    Add New User
                </a>
            </li>
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
                        @foreach($posts as $post)
                            <tr class="post" data-id="{{$post-> id}}">
                                <td class="people">{{$post->email}}</td>
                                <td class="people">{{$post->status}}</td>
                                <td class="people">{{$post->created_at}}</td>
                            </tr>
                        @endforeach
                    {!! $posts->render() !!}
                    </table>
                </div>
            </div>
        </div>    <!-- row-->
    </section>
        <!--row end-->
    </section>
    @endsection
@section('javascript')

@endsection