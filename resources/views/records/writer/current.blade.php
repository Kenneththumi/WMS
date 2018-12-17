@extends('../layouts.app')

@section('content')
    <div class="panel panel-info panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <div class="panel-title">Current(On-Going) Orders</div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
        {{--<form action="{{route('uploadWork')}}"  enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}--}}
            <div class="panel-body">
                <table class="table table-hover table-striped table-list">
                    <thead>
                    <tr>
                        <th>Order</th>
                        <th>Due Date</th>
                        <th>Topic</th>
                        <th>Discipline</th>
                        <th>Style</th>
                        <th>Pages</th>
                        <th>Compensation(<i class="fa fa-usd" aria-hidden="true"></i>)</th>
                        <th>Upload</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><a class="btn btn-sm btn-success" href="{{route('getOrder',$order->id)}}">{{$order->order_id}}</a></td>

                            <td>{{date('d-M-y',$order->due_date)}}</td>
                            <td>{{str_limit( $order->topic,16)}}</td>
                            <td>{{str_limit( $order->discipline,16)}}</td>
                            <td>{{ucwords($order->style)}}</td>
                            <td>{{$order->pages}}</td>
                            <td>{{$order->amount}}</td>
                            <td><a href="{{route('upload',$order->id)}}" class="btn open-AddBookDialog btn-sm bw btn-{{$order->status}}"  data-toggle="moda" data-id="{{$order->id}}" data-target="#{{$order->id}}">

                                    Upload

                                </a></td>
                        </tr>

                        <!-- Modal -->

                        <div id="{{$order->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        Upload work :<a href="{{route('getOrder',$order->id)}}" class="btn btn-success btn-sm">{{$order->order_id}}</a>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            {{--<form action="{{route('uploadWork',$order->id)}}" enctype="multipart/form-data" method="POST">
                                                {{csrf_field()}}--}}
                                            Upload File:<input type="file" id="orderfile" name=""/>
                                            <input type="hidden" name="id"  id="orderId" value=""/><br>
                                            <input type="submit"  class="btn btn-sm btn-success"/>
                                            {{--</form>--}}
                                        </p>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        {{ $orders->links() }}

                    </div>


                </div>


            </div>
        {{--</form>--}}
    </div>







@endsection