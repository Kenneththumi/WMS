@extends('../layouts.app')

@section('content')
    <div class="panel panel-info panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <div class="panel-title">Orders Available For Bidding</div>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                    </div>
                </div>
            </div>
        </div>

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
                        <th>Apply</th>
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
                            <td><a href="/apply/{{$order->id}}" class="btn btn-sm  bw btn-{{$order->status}}">
                                    @if($order->applications()->where('user_id',auth()->user()->id)->exists())
                                        Applied
                                    @else
                                        Apply
                                    @endif

                                </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
            </div>
    </div>

@endsection