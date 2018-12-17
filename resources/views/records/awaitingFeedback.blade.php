@extends('../layouts.app')

@section('content')
    <div class="panel panel-warning panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <div class="panel-title">Orders Awaiting Feedback</div>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
&nbsp;

                    </div>
                </div>
            </div>
        </div>
        <form action="#" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
                <table class="table table-hover table-striped table-list">
                    <thead>
                    <tr>

                        <th>Order</th>
                        <th>Due Date</th>
                        <th>Topic</th>
                        <th>Discipline</th>
                        <th>Allocation</th>
                        <th>T.O.U</th>

                        <th>Download</th>
                        <th>More..</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>

                            <td><a class="btn btn-sm btn-success" href="{{route('getOrder',$order->id)}}">{{$order->order_id}}</a></td>

                            <td>{{date('d-M-y',$order->due_date)}}</td>
                            <td>{{str_limit( $order->topic,16)}}</td>
                            <td>{{str_limit( $order->discipline,16)}}</td>
                            <td>{{$order->user()->first()->fname.' '.$order->user()->first()->lname}}</td>
                           <td>{{$order->filewriter()->first()->updated_at->format('d-M-y - H:i')}} hrs</td>
                            <td><a  href="{{asset('uploads/writers/'.$order->filewriter()->first()->file_path)}}" target="_blank" class="btn btn-sm  bw btn-{{$order->status}}">Download</a></td>
                            <td><a  href="{{route('moreFeedback',$order->id)}}" class="btn btn-sm btn-warning" >
                                    <em class="fa fa-pencil"></em>
                                </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>





            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        {{ $orders->links() }}
&nbsp;
                    </div>


                </div>


            </div>
        </form>
    </div>

@endsection