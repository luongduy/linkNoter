@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="PA">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Update your Profile</div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <a style="position: relative;" class="thumbnail" data-toggle="tooltip" data-placement="bottom" title="Change your avatar">
                                @if ($user['avatar_path'])
                                    <img id="myAvatar" class="img-responsive avatar-holder" src="{{ url($user['avatar_path']) }}?v=1" />
                                @else
                                    <img id="myAvatar" class="img-responsive avatar-holder" src="{{ url('/image/no-avatar.png')}}" />
                                @endif
                            </a>
                            <button type="button" class="btn btn-primary loadModalProfile">Upload new avatar</button>
                        </div>
                        <div class="col-md-9">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#updateProfile" aria-controls="home" role="tab" data-toggle="tab">Update Profile</a></li>
                                <li role="presentation"><a href="#changePassword" aria-controls="profile" role="tab" data-toggle="tab">Change Password</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="updateProfile">
                                    <br/>
                                    <form id="updateProfileForm" role="form" method="POST" action="{{ url('/profile') }}">
                                        {!! csrf_field() !!}
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="">Name</label>
                                            <input value="{{ old('name') ?: $user['name'] }}" name="name" type="text" class="form-control" placeholder="Your full name">
                                            @if ($errors->has('name'))
                                                <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="">Email Address</label>
                                            <input value="{{ old('email') ?: $user['email'] }}" type="email" name="email" class="form-control" placeholder="Email">
                                            @if ($errors->has('email'))
                                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                            @endif
                                        </div>
                                        <button type="button" class="submitUpdateProfile btn btn-primary"><i class="fa fa-btn fa-user"></i>Update</button>
                                    </form>

                                </div>
                                <div role="tabpanel" class="tab-pane" id="changePassword">
                                    <br/>
                                    <form id="changePasswordForm" role="form" method="POST" action="{{ url('/password') }}">
                                        {!! csrf_field() !!}
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="">New password</label>
                                            <input name="password" type="password" class="form-control" placeholder="password...">
                                            @if ($errors->has('password'))
                                                <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <label for="">Confirm password</label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="confirm password...">

                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                            @endif
                                        </div>
                                        <button type="button" class="submitChangePassword btn btn-primary"><i class="fa fa-btn fa-password"></i>Update</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('css')
    <link href="{!! asset('upload/jquery.fileupload.css') !!}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('scripts')
    <meta name="_token" content="{{ csrf_token() }}" />
    <script src="{!! asset('upload/jquery.ui.widget.js') !!}"></script>
    <script src="{!! asset('upload/jquery.fileupload.js') !!}"></script>
    <script src="{!! asset('js/user.js') !!}"></script>
@endsection
