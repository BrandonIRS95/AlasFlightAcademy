@extends('layouts.master-admin')

@section('title-view')
@endsection
{{-- page level scripts --}}
@section('content')
    <!--page level css -->
    <link href="{{ asset('/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="{{ asset('/css/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
    <script src="{{ asset('/js/jquery-ui.min.js') }}" ></script>
    <script src="{{ asset('/js/moment.min.js') }}" ></script>
    <script src="{{ asset('/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('/js/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.9/js/bootstrap.min.js"></script>
    <section class="content-header">
        <h1>Add New User</h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                <a href="{{ route('indexCrud') }}">Users</a>
            </li>
            <li >Add New User</li>
        </ol>
    </section>
    <section class="content" style="width:95%;margin-left: 2.5%;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Add New User
                        </h3>
                        <span class="pull-right clickable">
                                    <i class="uptop glyphicon glyphicon-chevron-up"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <form id="commentForm"   method="POST" role="form"
                              enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input  type="hidden" name="_token" value="{{ Session::token() }}">
                            <div id="rootwizard">
                            <h3><a href="#tab1"  selected data-toggle="tab">User Profile</a></h3>
                                <div class="tab-content" id="btn">
                                    <div class="tab-pane" id="tab1">
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
                                        <button id="btnSubmit"  disabled class="btn pull-right">Submit</button>
                                        <!-- Modal -->
                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
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
                                        </div>

                                    </div>
                                    <script>
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
                                        $("#datepicker").datepicker({
                                            dateFormat: 'yy-mm-dd'
                                        });
                                        $("#datepicker").on('changeDate', function (ev) {
                                            $(this).datepicker('hide');
                                        });
                                    </script>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
    @endsection
@section('footer_scripts')

@stop
