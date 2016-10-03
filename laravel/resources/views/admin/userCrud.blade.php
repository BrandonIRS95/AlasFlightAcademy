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
                        <!-- errors -->
                        <div class="has-error">
                            {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('group', '<span class="help-block">:message</span>') !!}
                            {!! $errors->first('country', '<span class="help-block">:message</span>') !!}
                        </div>
                        <!--main content-->
                        <form id="commentForm"  action="{{url('producto/crearnuevo')}}" method="POST" role="form"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token"  />
                            <div id="rootwizard">
                                <ul>
                                    <li><a href="#tab1" data-toggle="tab">User Profile</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Bio</a></li>
                                    <li><a href="#tab3" data-toggle="tab">Address</a></li>
                                    <li><a href="#tab4" data-toggle="tab">User Group</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group">
                                            <label for="first_name" class="col-sm-2 control-label">First Name *</label>
                                            <div class="col-sm-10">
                                                <input id="first_name" name="first_name" type="text"
                                                       placeholder="First Name" class="form-control required"
                                                       value="{!! old('first_name') !!}"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name" class="col-sm-2 control-label">Last Name *</label>
                                            <div class="col-sm-10">
                                                <input id="last_name" name="last_name" type="text" placeholder="Last Name"
                                                       class="form-control required" value="{!! old('last_name') !!}"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Email *</label>
                                            <div class="col-sm-10">
                                                <input id="email" name="email" placeholder="E-Mail" type="text"
                                                       class="form-control required email" value="{!! old('email') !!}"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="col-sm-2 control-label">Password *</label>
                                            <div class="col-sm-10">
                                                <input id="password" name="password" type="password" placeholder="Password"
                                                       class="form-control required" value="{!! old('password') !!}"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirm" class="col-sm-2 control-label">Confirm Password *</label>
                                            <div class="col-sm-10">
                                                <input id="password_confirm" name="password_confirm" type="password"
                                                       placeholder="Confirm Password " class="form-control required"
                                                       value="{!! old('password_confirm') !!}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2" disabled="disabled">
                                        <h2 class="hidden">&nbsp;</h2> <div class="form-group required">
                                            <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                                            <div class="col-sm-10">
                                                <input id="dob" name="dob" type="text" class="form-control"
                                                       data-mask="9999-99-99" value="{!! old('dob') !!}"
                                                       placeholder="yyyy-mm-dd"/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('dob', ':message') }}</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="pic" class="col-sm-2 control-label">Profile picture</label>
                                            <div class="col-sm-10">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                        <img src="http://placehold.it/200x200" alt="profile pic">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                    <div>
                                <span class="btn btn-default btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input id="pic" name="pic_file" type="file" class="form-control"/>
                                </span>
                                                        <a href="#" class="btn btn-danger fileinput-exists"
                                                           data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group required">
                                            <label for="bio" class="col-sm-2 control-label">Bio <small>(brief intro)</small></label>
                                            <div class="col-sm-10">
                        <textarea name="bio" id="bio" class="form-control"
                                  rows="4">{!! old('bio') !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3" disabled="disabled">
                                        <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                                            <label for="email" class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" title="Select Gender..." name="gender">
                                                    <option value="">Select</option>
                                                    <option value="male"
                                                            @if(old('gender') === 'male') selected="selected" @endif >MALE
                                                    </option>
                                                    <option value="female"
                                                            @if(old('gender') === 'female') selected="selected" @endif >
                                                        FEMALE
                                                    </option>
                                                    <option value="other"
                                                            @if(old('gender') === 'other') selected="selected" @endif >OTHER
                                                    </option>

                                                </select>
                                            </div>
                                            <span class="help-block">{{ $errors->first('gender', ':message') }}</span>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab4" disabled="disabled">
                                        <p class="text-danger"><strong>Be careful with group selection, if you give admin access.. they can access admin section</strong></p>

                                        <div class="form-group required">
                                            <label for="group" class="col-sm-2 control-label">Group *</label>
                                            <div class="col-sm-10">
                                                <select class="form-control required" title="Select group..." name="group"
                                                        id="group">
                                                    <option value="">Select</option>
                                                    <option value="Instructor">Instructor</option>
                                                    <option value="Addmin">Admin</option>
                                                </select>
                                            </div>
                                            <span class="help-block">{{ $errors->first('group', ':message') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="activate" class="col-sm-2 control-label"> Activate User</label>
                                            <div class="col-sm-10">
                                                <input id="activate" name="activate" type="checkbox"
                                                       class="pos-rel p-l-30"
                                                       value="1" @if(old('activate')) checked="checked" @endif >
                                                <span>If user is not activated, mail will be sent to user with activation link</span></div>
                                        </div>
                                    </div>
                                    <ul class="pager wizard">
                                        <li class="previous"><a href="#">Previous</a></li>
                                        <li class="next"><a href="#">Next</a></li>
                                        <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                                    </ul>
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
{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('/js/moment.min.js') }}" ></script>
    <script src="{{ asset('/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/adduser.js') }}"></script>
@stop