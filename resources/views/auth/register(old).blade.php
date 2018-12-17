@extends('layouts.app')

@section('content')
<div class="register-body">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Register Writer</div>

                <div class="panel-body" >
                    <form class="form-horizontal" method="POST" action="{{ route('addWriter') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 pd-form">

                                <div class="form-group {{ $errors->has('fname') ? ' has-error' : '' }}">
                                    <label>Firstname</label>
                                    <input class="form-control input-sm" type="text" name="fname" placeholder="firstname" value="{{ old('fname') }}" required=""/>
                                    @if ($errors->has('fname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6 pd-form" >

                                <div class="form-group  {{ $errors->has('lname') ? ' has-error' : '' }}">
                                    <label>Lastname</label>
                                    <input class="form-control input-sm" type="text" name="lname" placeholder="Last Name"  value="{{ old('lname') }}"  required=""/>
                                    @if ($errors->has('lname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 pd-form">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email</label>
                                    <input class="form-control input-sm" type="email" name="email" placeholder="email"  value="{{ old('email') }}" required=""/>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 pd-form">
                                <div class="form-group  {{ $errors->has('role') ? ' has-error' : '' }}">
                                    <label>Role</label>
                                     <select class="form-control input-sm" name="role"  required="">
                                        <option value=""> - select - </option>
                                        <option  value="1"> normal user </option>
                                        <option value="2">Administrator </option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 pd-form">
                                <div class="form-group {{ $errors->has('tel') ? ' has-error' : '' }}">
                                    <label>Mobile No.</label>
                                    <input class="form-control input-sm" type="text" name="tel" placeholder="mobile"  value="{{ old('tel') }}" required=""/>
                                    @if ($errors->has('tel'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="col-md-6 pd-form" >
                                <div class="form-group {{ $errors->has('yob') ? ' has-error' : '' }}">
                                    <label>Year of Birth</label>
                                    <input class="form-control input-sm" type="text" name="yob" placeholder="Year of Birth"  value="{{ old('yob') }}" required=""/>
                                    @if ($errors->has('yob'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('yob') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 pd-form" >
                                <div class="form-group {{ $errors->has('passport') ? ' has-error' : '' }}">
                                    <label>ID/ Passport</label>
                                    <input class="form-control input-sm" type="number" name="passport" placeholder="ID/ Password No."  value="{{ old('passport') }}" required=""/>
                                    @if ($errors->has('passport'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('passport') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 pd-form" >
                                <div class="form-group  {{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label>Profile Image</label>
                                    <input type="file" name="image" class="form-control input-sm"/>
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-6 pd-form">
                                <div class="form-group  {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>Password</label>
                                    <input type="Password" name="password" class="form-control input-sm"  required=""/>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 pd-form" >
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="Password" name="password_confirmation" class="form-control input-sm" required=""/>
                                </div>
                            </div>

                            <div class="col-md-12"   style="padding: 5px 60px;">
                                <input class="btn btn-sm btn-success pull-right" type="submit" value="submit"/> 
                            </div>
                           
                        </div>
                    </form>
                </div>
                <div class="panel-footer"></div>

            </div>
        </div>
    </div>
</div>
@endsection
