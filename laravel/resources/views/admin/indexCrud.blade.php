@extends('layouts.master-admin')
{{-- Page title --}}
@section('title')
    Users List
    @parent
@stop
@section('individual-styles')
    <style>
        .pagination{margin-left: 43%;}
    </style>

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
                    <table class="table table-hover" id="table">
                        <thead>
                        <tr class="filters">
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User E-mail</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr class="post"  data-id="{{$post->id}}">
                                <td class="people">{{$post->Person->first_name}}</td>
                                <td class="people">{{$post->Person->last_name}}</td>
                                <td class="people" >{{$post->email}}</td>
                                @if($post->status == 0)
                                    <td>
                                    <div class="dropdown">
                                        <button id="{{$post->id}}" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">active
                                            </button>
                                        <ul class="dropdown-menu">
                                            <li><a onclick="changeStatus({{$post->id}})">inactive</a></li>
                                        </ul>
                                    </div>
                                    </td>
                                @else
                                    <td>
                                        <div class="dropdown">
                                            <button id="{{$post->id}}" class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">inactive
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a onclick="changeStatus({{$post->id}})">active</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                @endif
                                <td class="people">{{$post->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $posts->render() !!}
                </div>

            </div>
        </div>    <!-- row-->
    </section>
        <!--row end-->
    @endsection
@section('javascript')
  <script>
      function changeStatus(id)
      {
         var a = document.getElementById(id).innerHTML;
          if(a != "active")
          {
              document.getElementById(id).innerHTML = "inactive";
          }
          else
          {
              alert("entro");
              document.getElementById(id).innerHTML = "active";
          }
      }
  </script>
@endsection