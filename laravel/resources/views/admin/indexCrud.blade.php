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
        </ol>
    </section>
    <section class="content paddingleft_right15" style="width:95%;margin-left: 2.5%;">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Users List
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    <form id="commentForm" class="form-horizontal">
                        <!-- CSRF Token -->
                        <input  type="hidden" name="_token" value="{{ Session::token() }}">
                            <h3><a class="btn btn-info" href="#tab1"  id="a" selected data-toggle="tab">Add New User</a></h3>
                            <div id="DivNewUser">
                                <div  id="tab1">
                                    <h2 class="hidden">&nbsp;</h2>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email *</label>
                                        <div class="col-sm-10">
                                            <input id="email" onchange="avilitarSubmit()" name="email" placeholder="E-Mail" type="text"
                                                   class="form-control required email" value="{!! old('email') !!}"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Password *</label>
                                        <div class="col-sm-10">
                                            <input id="password" onchange="avilitarSubmit()" name="password" type="password" placeholder="Password"
                                                   class="form-control required" value="{!! old('password') !!}"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirm" class="col-sm-2 control-label">Confirm Password *</label>
                                        <div class="col-sm-10">
                                            <input id="password_confirm" onchange="avilitarSubmit()" name="password_confirm" type="password"
                                                   placeholder="Confirm Password " class="form-control required"
                                                   value="{!! old('password_confirm') !!}"/>
                                        </div>
                                    </div>
                                    <p class="text-danger"><strong>Be careful with group selection, if you give admin access.. they can access admin section</strong></p>
                                    <button id="btnSubmit"  disabled class="btn pull-right btn-primary">Submit</button>
                                    <div type="button" id="btnCancel" class="pull-right btn btn-danger" style="margin-right:15px;">Cancel</div>
                                    <!-- Modal -->
                                    <!--<div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body" style="text-align: center;">
                                                    <h2> <i class="glyphicon glyphicon-check" style="font-size: 40px;top:5px;margin-right: 30px;"></i>User has been added !!</h2>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" >Accept</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>-->

                                </div>
                            </div>
                    </form>
                    <table class="table table-hover" id="table">
                        <thead>
                        <tr class="filters">
                            <th>User E-mail</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr class="post"  data-id="{{$post->id}}">
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
                                <td class="people">{{$post->updated_at}}</td>
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
    <script type="text/javascript" src="{{URL::to('js/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{URL::to('js/additional-methods.js')}}"></script>
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
      $(function() {
          $('#DivNewUser').slideUp();
      });
      $('#btnCancel').click(function () {
          $('#DivNewUser').slideUp();
      });

      $('#a').click(function () {
          $("#DivNewUser").slideDown();
      });

      $('#commentForm').validate({
          submitHandler: function (form) {

              var loadAnim = new loadingProcessAnimation();

              loadAnim.show('Adding user');

              var data = $(form).serialize();
              $.ajax({
                  url: window.location.href,
                  method: "POST",
                  data: data
              }).done(function (response) {
                  loadAnim.done('User added succesfully!', function () {
                      $('#email, #password, #password_confirm').val('');
                  });
              });
          }
      });

      function avilitarSubmit() {
          var email = document.getElementById("email").value;
          var password = document.getElementById("password").value;
          var passwordL = document.getElementById("password_confirm").value;

          var btn = document.getElementById("btnSubmit");
          if(email != "" && password != "" && passwordL != "") {
              btn.setAttribute('class','btn btn-info pull-right');
              btn.setAttribute("data-toggle", "modal");
              btn.setAttribute("data-target", "#myModal");
              btn.disabled=false;
          }else{
              btn.disabled=true;
          }
      }
  </script>
@endsection
