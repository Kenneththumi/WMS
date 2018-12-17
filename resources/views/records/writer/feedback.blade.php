@extends('../layouts.app')

@section('content')
    <div class="panel panel-info panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <div class="panel-title">My Orders Feedback</div>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                    </div>
                </div>
            </div>
        </div>
            <div class="panel-body">
                <table class="table table-hover table-striped table-list table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 50px">Order</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <td><a href="{{ route('getOrder',$message->order_id) }}" class="btn btn-{{$message->order()->first()->status}} btn-sm">{{$message->order()->first()->order_id}}</a></td>
                            <td>{!! $message->message !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>





            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        @if(!empty($messages))
                            {{ $messages->links() }}

                        <div class="pull-right">
                        @endif                            </div>
                    </div>


                </div>


            </div>

    </div>

@endsection