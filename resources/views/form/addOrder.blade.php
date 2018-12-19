@extends('layouts.app')

@section('content')
    <div class="register-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">New Order: <i style="color:#000">{{$order_id}}</i>
                        @if ($errors->has('order'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="panel-body" >
                        <form class="form-horizontal" method="POST" action="{{ route('saveOrder') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4 pd-form" >
                                    <div class="form-group  {{ $errors->has('topic') ? ' has-error' : '' }}">
                                        <label>Topic</label>
                                        <input class="form-control input-sm" type="text" name="topic" placeholder="Topic"  value="{{ old('topic') }}"  required=""/>
                                        @if ($errors->has('topic'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('topic') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 pd-form">
                                    <div class="form-group  {{ $errors->has('discipline') ? ' has-error' : '' }}">
                                        <label>Discipline</label>
                                        {{ Form::select('discipline',$proficiencies
                                        , $order->discipline, ['class' => 'form-control  input-sm','required'=>'']) }}
                                        @if ($errors->has('discipline'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('discipline') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 pd-form">
                                    <div class="form-group  {{ $errors->has('style') ? ' has-error' : '' }}">
                                        <label>Style</label>
                                        <select class="form-control input-sm" name="style"  required="">
                                            <option value=""> - select - </option>
                                            <option  value="apa"> APA</option>
                                            <option value="chicago">Chicago</option>
                                            <option value="havard">Havard</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @if ($errors->has('style'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('style') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4 pd-form">
                                    <div class="form-group {{ $errors->has('sources') ? ' has-error' : '' }}">
                                        <label>Sources</label>
                                        <input class="form-control input-sm" type="number" name="sources" placeholder="no. of sources" required=""/>
                                        @if ($errors->has('sources'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('sources') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                {{--<div class="col-md-4 pd-form">
                                    <div class="form-group {{ $errors->has('words') ? ' has-error' : '' }}">
                                        <label>Words</label>
                                        <input class="form-control input-sm" type="number" name="words" placeholder="no of words" required=""/>
                                        @if ($errors->has('words'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('words') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>--}}

                                <div class="col-md-4 pd-form">
                                    <div class="form-group {{ $errors->has('pages') ? ' has-error' : '' }}">
                                        <label>Pages</label>
                                        <input class="form-control input-sm" type="number" name="pages" placeholder="no of pages"  value="{{ old('pages') }}" required=""/>
                                        @if ($errors->has('pages'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('pages') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>

                                {{--<div class="col-md-4 pd-form">
                                    <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">
                                        <label>Amount (Ksh)</label>
                                        <input class="form-control input-sm" type="number" name="amount" placeholder="amount ksh"  value="{{ old('amount') }}" required=""/>
                                        @if ($errors->has('amount'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>--}}

                                <div class="col-md-4 pd-form" >
                                    <div class="form-group  {{ $errors->has('paper_type') ? ' has-error' : '' }}">
                                        <label>Type of Paper</label>
                                        {{Form::select('paper_type',$order->paperType,null,['class'=>'form-control input-sm','required'=>''])}}

                                        @if ($errors->has('paper_type'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('paper_type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 pd-form" >
                                    <div class="form-group  {{ $errors->has('writing_type') ? ' has-error' : '' }}">
                                        <label>Type of Writing</label>
                                        <select class="form-control input-sm" name="writing_type"  required="">
                                            <option value=""> - select - </option>
                                            <option  value="from scratch"> From Scratch</option>
                                            <option value="editing">Editing</option>
                                            <option value="paraphrasing">Paraphrasing</option>
                                            <option value="unspecified">unspecified</option>
                                        </select>
                                        @if ($errors->has('writing_type'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('writing_type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 pd-form" >
                                    <div class="form-group  {{ $errors->has('level') ? ' has-error' : '' }}">
                                        <label>Academic level</label>
                                        <select class="form-control input-sm" name="level"  required="">
                                            <option value=""> - select - </option>
                                            <option  value="high school"> High School</option>
                                            <option value="college">College</option>
                                            <option value="university">University</option>
                                            <option value="masters">Masters</option>
                                            <option value="PhD">PhD</option>
                                            <option value="unspecified">unspecified</option>
                                        </select>
                                        @if ($errors->has('level'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-4 pd-form" >
                                    <div class="form-group {{ $errors->has('due_date') ? ' has-error' : '' }}">
                                        <label>Due Date</label>
                                        {{Form::text('due_date', '', array('class'=>'timepicker form-control','required'=>'required'))}}
                                        @if ($errors->has('due_date'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 pd-form" >
                                    <div class="form-group">
                                        <label for="txtarea">Instructions</label>
                                        <textarea class="form-control" name="instructions" id="txtarea"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 pd-form">
                                    <div class="form-group  {{ $errors->has('file') ? ' has-error' : '' }}">
                                        <label>File</label>
                                        <input type="file" name="file" class="form-control input-sm"/>
                                        @if ($errors->has('file'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 pd-form">
                                    <div class="form-group  {{ $errors->has('link') ? ' has-error' : '' }}">
                                        <label>File to Cloud Storage</label>
                                        <input type="text" name="link" class="form-control input-sm" placeholder="Google drive, Dropbox"/>
                                        @if ($errors->has('link'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="order" value="{{$order_id}}"/>
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
