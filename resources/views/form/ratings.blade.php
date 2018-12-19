@extends('layouts.app')

@section('content')
    <div class="register-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">Ratings : <button class="btn btn-sm btn-success">{{$order->order_id .' | '.$order->user()->first()->fname.' '.$order->user()->first()->lname}}</button></div>

                    <div class="panel-body" >


                        <form class="form-horizontal" method="POST" action="{{route('ratings',$order->id)}}" >
                            {{ csrf_field() }}
                            {{--<div class="row"> <div style="text-align: center; font-size: 23px">State</div>--}}
                                <hr>

                                {{--rating--}}

                            <div class="col-md-12"><label>Ratings(%)</label></div>
                                <div class="col-md-4">
                                    <div class="form-group mf-form">
                                        <label>Grammar</label>
                                        <input class="form-control input-sm" type="number" name="grammar" placeholder="Grammar Rating (%)"  required/>
                                    </div>
                                </div>
                            <div class="col-md-4">
                                <div class="form-group mf-form">
                                    <label>Instructions</label>
                                    <input class="form-control input-sm" type="number" name="instructions" placeholder="Instruction Rating (%)"  required/>
                                </div>
                            </div>
                            <div class="col-md-4 mf-form">
                                <div class="form-group">
                                    <label>Speed</label>
                                    <input class="form-control input-sm" type="number" name="speed" placeholder="Speed Rating (%)"  required/>
                                </div>
                            </div>
                            <div class="col-md-4 mf-form">
                                <div class="form-group">
                                    <label>Originality</label>
                                    <input class="form-control input-sm" type="number" name="originality" placeholder="Originality Rating (%)"  required/>
                                </div>
                            </div>
                            {{--end rating--}}
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
