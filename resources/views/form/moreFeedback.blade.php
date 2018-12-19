@extends('layouts.app')

@section('content')
    <div class="register-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">Feedback : <button class="btn btn-sm btn-success">{{$order->order_id}}</button></div>

                    <div class="panel-body" >


                        <form class="form-horizontal" method="POST" action="{{route('addFeedback',$order->id)}}" >
                            {{ csrf_field() }}
                            {{--<div class="row"> <div style="text-align: center; font-size: 23px">State</div>--}}
                                <hr>
                                {{--state--}}
                                <div class="col-md-4 pd-form">
                                        <label>Completed</label>
                                        <input type="radio" name="state" value="completed"/>
                                </div>
                                <div class="col-md-4 pd-form">
                                    <label>Revision</label>
                                    <input type="radio" name="state" value="revision"/>
                                </div>
                                <div class="col-md-4 pd-form">
                                    <label>Cancelled</label>
                                    <input type="radio" name="state" value="cancelled"/>
                                </div>
                                {{--clients feedback--}}
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-group">
                                        <label for="txtarea">Clients' Feedback (if any)</label>
                                        <textarea class="form-control" name="message" id="txtarea" ></textarea>
                                    </div>
                                    <hr>
                                </div>

                            <div class="col-md-12"   style="padding: 5px 60px;">
                                <input class="btn btn-sm btn-success pull-right" type="submit" value="submit"/>
                            </div>

                        </form>
                    </div>
                    <div class="panel-footer">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
@endsection
