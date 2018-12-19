@extends('../layouts.app')

@section('content')
    <div class="panel panel-info panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <div class="panel-title">Orders Ratings</div>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">

                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('delOrderRatings')}}" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
                <table class="table table-hover table-striped table-list">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th style="width: 15px">Order</th>
                        <th>Grammar(%)</th>
                        <th>Instructions(%)</th>
                        <th>Originality(%)</th>
                        <th>Speed(%)</th>
                        <th>Overall(%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><input type="checkbox" name="chk[]" value="{{$order->id}}" /> &nbsp;</td>
                            <td><a class="btn btn-sm btn-success" href="{{route('getOrder',$order->id)}}">{{$order->order_id}}</a></td>
                            <td>{{$order->orderratings['grammar']}}</td>
                            <td>{{$order->orderratings['instructions']}}</td>
                            <td>{{$order->orderratings['originality']}}</td>
                            <td>{{$order->orderratings['speed']}}</td>
                            <td>
                                {{

                                $rating = ($order->orderratings['grammar'] + $order->orderratings['instructions'] + $order->orderratings['originality']+$order->orderratings['speed'])/4

                                }}
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