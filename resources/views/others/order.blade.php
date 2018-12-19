@extends('layouts.app')

@section('content')
    <div class="order-page">

        <div class="panel panel-info">
            <div class="panel-heading">Order
                @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <div class="pull-right">
                    @if($order->status =='current'  || $order->status =='available' || $order->status =='revision')
                    <a  href="{{route('editOrder',$order->id)}}" class="btn btn-sm btn-warning" >
                        <em class="fa fa-pencil"></em>
                    </a>
                    {{--<a  href="{{route('delOrder',$order->id)}}" class="btn btn-sm btn-danger delete" >
                        <em class="fa fa-trash"></em>
                    </a>--}}
                    @endif
                </div>
                    @endif
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="item-profile">
                            <div class="col-md-3">
                                <div><strong>Order:&nbsp;</strong>{{ucwords($order->order_id)}}</div>
                                <br>
                                <div><strong>Due Date:&nbsp;</strong>{{date('d-M-y',$order->due_date)}}</div>
                                <br>
                                <div><strong>Topic:&nbsp;</strong>{{$order->topic}}</div>
                                <br>
                                <br>
                                <div><strong>Words:&nbsp;</strong>{{$order->words}}</div>
                            </div>
                            <div class="col-md-3">
                                <div><strong>Discipline:&nbsp;</strong>{{$order->discipline}}</div>
                                <br>
                                <div><strong>Style:&nbsp;</strong>{{$order->style}}</div>
                                <br>
                                <div><strong>Pages:&nbsp;</strong>{{$order->pages}}</div>

                            </div>
                            <div class="col-md-3">
                                <div><strong>Compensation(<i class="fa fa-usd" aria-hidden="true"></i>):&nbsp;</strong>{{$order->amount}}</div>
                                <br>
                                <div><strong>Status:&nbsp;</strong>{{$order->status}}</div>
                                <br>
                                <div><strong>Allocated:&nbsp;</strong> {{$order->user()->exists()?$order->user()->first()->fname.' '.$order->user()->first()->lname:'allocate'}}</div>
                            </div>
                            <div class="col-md-3">
                                <div><strong>Type of Paper:&nbsp;</strong>{{ucwords($order->paper_type)}}</div>
                                <br>
                                <div><strong>Type of Writing:&nbsp;</strong>{{ucwords($order->writing_type)}}</div>
                                <br>
                                <div><strong>Academic Level:&nbsp;</strong> {{ucwords($order->level)}}</div>
                            </div>

                            <div class="col-md-12"><hr class="separator"><strong>Instructions</strong><br>{!! $order->instructions!!}</div>


                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-12">
                            <hr class="separator">
                            <div class="col-md-4">
                            <div class="pull-left"><strong>File:</strong>&nbsp;
                                <a href="{{asset($file_path)}}" class="btn btn-sm btn-success" target="{{$file_path!='#'?'_blank':'_self'}}" >Download</a>
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pull-left"><strong>Cloud Link:</strong>&nbsp;
                                    <a href="{{asset($link)}}"  class="btn btn-sm btn-success"  target="{{$link!='#'?'_blank':'_self'}}">External Link</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if(auth()->user()->isWriter() && $order->isOrderAvailable())
                                <div class="pull-left"><strong>Apply:</strong>&nbsp;
                                    <a href="/apply/{{$order->id}}" class="btn btn-sm  bw btn-{{$order->status}}">
                                        @if($order->applications()->where('user_id',auth()->user()->id)->exists())
                                            Applied
                                        @else
                                            Apply
                                        @endif
                                    </a>
                                </div>
                                    @endif
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="panel-footer"></div>
        </div>

    </div>
@endsection