@extends('../layouts.app')

@section('content')
    <div class="panel panel-danger panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <div class="panel-title">Cancelled Orders</div>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
&nbsp;
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('delOrders')}}" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
                <table class="table table-hover table-striped table-list">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Order</th>
                        <th>Due Date</th>
                        <th>Topic</th>
                        <th>Discipline</th>
                        <th>Style</th>
                        <th>Pages</th>
                        <th>Compensation(<i class="fa fa-usd" aria-hidden="true"></i>)</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><input type="checkbox" name="chk[]" value="{{$order->id}}" /> &nbsp;</td>
                            <td><a class="btn btn-sm btn-success" href="{{route('getOrder',$order->id)}}">{{$order->order_id}}</a></td>

                            <td>{{date('d-M-y',$order->due_date)}}</td>
                            <td>{{str_limit( $order->topic,16)}}</td>
                            <td>{{str_limit( $order->discipline,16)}}</td>
                            <td>{{ucwords($order->style)}}</td>
                            <td>{{$order->pages}}</td>
                            <td>{{$order->amount}}</td>
                            <td><a href="/allocate/{{$order->id}}" class="btn btn-sm  bw btn-{{$order->status}}">{{$order->status}} | {{$order->user()->exists()?$order->user()->first()->fname.' '.$order->user()->first()->lname:'allocate'}}</a></td>

                            <td>
                               &nbsp;
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>





            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        {{ $orders->links() }}

                        <div class="pull-right">
                            <button id="delete" class="btn btn-sm btn-danger delete" type="submit">
                                <em class="fa fa-trash"></em>
                            </button>
                        </div>
                    </div>


                </div>


            </div>
        </form>
    </div>

@endsection