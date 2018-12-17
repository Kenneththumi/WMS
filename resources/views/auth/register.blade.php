<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register | WMS</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
        <style>

        </style>
    </head>
    <body>

    <div id="register">
        @include('partials._navtop')
           <div >
            <div class="container">
                <div class="panel panel-success">
                            <div class="panel-heading">Register as a Writer</div>

                            @if($errors->count())
                                <div class="alert alert-danger alert-dismissible fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li><strong>Error!</strong>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="panel-body" >
                                <form id="radio-gp-1" class="form-horizontal" method="POST" action="{{ route('addWriter') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-4 pd-form">
                                            <div class="form-group {{ $errors->has('fname') ? ' has-error' : '' }}">
                                                <label>First Name</label>
                                                <input class="form-control input-sm" type="text" name="fname" placeholder="firstname" value="{{ old('fname') }}" required=""/>
                                                @if ($errors->has('fname'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('fname') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 pd-form" >

                                            <div class="form-group  {{ $errors->has('lname') ? ' has-error' : '' }}">
                                                <label>Last Name</label>
                                                <input class="form-control input-sm" type="text" name="lname" placeholder="Last Name"  value="{{ old('lname') }}"  required=""/>
                                                @if ($errors->has('lname'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('lname') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 pd-form">
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
{{--end row 1--}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pd-form">
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
                                        <div class="col-md-4 pd-form">
                                            <div class="form-group {{ $errors->has('tel2') ? ' has-error' : '' }}">
                                                <label>Alternative Mobile No.</label>
                                                <input class="form-control input-sm" type="text" name="tel2" placeholder="mobile"  value="{{ old('tel2') }}" />
                                                @if ($errors->has('tel2'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('tel2') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 pd-form" >
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
                                        {{--end row 2--}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pd-form" >
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
                                        <div class="col-md-4 pd-form">
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
                                        <div class="col-md-4 pd-form" >
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="Password" name="password_confirmation" class="form-control input-sm" required=""/>
                                            </div>
                                        </div>
                                        {{--end row 3--}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pd-form">
                                            <div class="form-group  {{ $errors->has('city') ? ' has-error' : '' }}">
                                                <label>City</label>
                                                <input type="text" name="city" class="form-control input-sm"  required="" placeholder="e.g. Nairobi "/>
                                                @if ($errors->has('city'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 pd-form">
                                            <div  class="form-group  {{ $errors->has('previous_work') ? ' has-error' : '' }}">
                                                <label>Ever worked for any other online academic assistance company?</label>
                                                <div class="radio pull-left" style="margin-right: 10px">
                                                    <label><input id="click-me" type="radio" name="previous_work" value="Yes">Yes</label>
                                                </div>
                                                <div class="radio pull-left">
                                                    <label><input type="radio" name="previous_work" value="No">No</label>
                                                </div>
                                                @if ($errors->has('previous_work'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('previous_work') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 pd-form">
                                            <div id="timeline"  class="hidden form-group  {{ $errors->has('previous_work_timeline') ? ' has-error' : '' }}">
                                                <label>If yes how long? (can explain)</label>
                                                <input type="text" name="previous_work_timeline" class="form-control input-sm"   maxlength="100" placeholder="e.g. 1yr, Part time/ Full Time"/>
                                                @if ($errors->has('previous_work_timeline'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('previous_work_timeline') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        {{--end row 4--}}
                                    </div>
                                    <div class="row">
                                        <hr>
                                        <div class="col-md-4 pd-form">
                                            <div  class="form-group  {{ $errors->has('availability') ? ' has-error' : '' }}">
                                                <label class="pull-left">Are you available 24/7?</label><br>
                                                <div class="radio pull-left" style="margin-right: 10px">
                                                    <label><input id="click-me-1" type="radio" name="availability" value="Yes">Yes</label>
                                                </div>
                                                <div class="radio pull-left">
                                                    <label><input type="radio" name="availability" value="No">No</label>
                                                </div>
                                                @if ($errors->has('availability'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('availability') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4  pd-form">
                                            <div id="urgent-work"  class="hidden-1 form-group  {{ $errors->has('urgent_work') ? ' has-error' : '' }}">

                                                <label>Are you ready to take urgent orders at night? There might be night calls.</label>
                                                <div class="radio pull-left" style="margin-right: 10px">
                                                    <label><input id="click-me-2" type="radio" name="urgent_work" value="Yes">Yes</label>
                                                </div>
                                                <div class="radio pull-left">
                                                    <label><input type="radio" name="urgent_work" value="No">No</label>
                                                </div>
                                                @if ($errors->has('urgent_work'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('urgent_work') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4  pd-form-1">
                                            <div class="form-group  {{ $errors->has('citations') ? ' has-error' : '' }}">
                                                <label>Which citation styles are you familiar with?</label><br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="citations[]" value="MLA" > MLA
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox"   name="citations[]" value="APA"  > APA
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="citations[]" value="Chicago"  > Chicago
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox"  name="citations[]"  value="Havard"> Havard
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox"  name="citations[]"  value="Other" > Other
                                                </label>
                                                @if ($errors->has('citations'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('citations') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        {{--End row 5--}}
                                    </div>

                                    <div class="row">
                                        <hr>
                                        <div class="col-md-4 pd-form">
                                            <div class="form-group  {{ $errors->has('highest_qualification') ? ' has-error' : '' }}">
                                                <label>
                                                    What is your highest verifiable academic qualification?
                                                </label>
                                                <select class="form-control input-sm" name="highest_qualification"  required="">
                                                    <option value=""> - select - </option>
                                                    <option  value="High School"> High School</option>
                                                    <option value="Associate">Associate</option>
                                                    <option value="Bachelors">Bachelors</option>
                                                    <option value="Masters">Masters</option>
                                                    <option value="Ph.D">Ph.D</option>
                                                </select>
                                                @if ($errors->has('highest_qualification'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('highest_qualification') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8   ">
                                            <label for="">What disciplines are you proficient in?</label>
                                            <div class="panel-group">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title {{ $errors->has('proficiencies') ? ' has-error' : '' }}">
                                                            <a data-toggle="collapse" href="#collapse1">Click</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse1" class="panel-collapse collapse">
                                                        <div class="panel-body ">
                                                            @foreach($user->proficiencies as $proficiency)
                                                                <label class="checkbox-inline">
                                                                {{ Form::checkbox('proficiencies[]',$proficiency,null,['class'=>'input-sm']) }}
                                                                    {{ucwords($proficiency)}}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('proficiencies'))
                                                        <span class="help-block" style="color: red">
                                                <strong>{{ $errors->first('proficiencies') }}</strong>
                                            </span>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    {{--end row 6--}}
                                    <div class="row">
                                        <hr>
                                        <div class="col-md-8 pd-form">

                                            <div  class="form-group  {{ $errors->has('relevant_info') ? ' has-error' : '' }}">
                                                <label for="">Relevant information yourself?</label><br>
                                                <textarea name="relevant_info"   class="form-control" rows="5"></textarea>
                                                @if ($errors->has('relevant_info'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('relevant_info') }}</strong>
                                            </span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                      {{--end row 7--}}
                                        <div class="row">
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
    </body>
<script src="{{asset('js/jquery-1.10.2.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>

        // Listen for any radio buttons at the form-check
        //  level being clicked.
        $(".form-horizontal input[type='radio']").on("change", function() {
            // Regardless of WHICH radio was clicked, is the
            //  showSelect radio active?
            if ($("#click-me").is(':checked')) {

                $('#timeline').removeClass("hidden");
            } else {
                $('#timeline').addClass("hidden");
            }

            if ($("#click-me-1").is(':checked')) {

                $('#urgent-work').removeClass("hidden-1");
            } else {
                $('#urgent-work').addClass("hidden-1");
            }
        })


    </script>
</html>
