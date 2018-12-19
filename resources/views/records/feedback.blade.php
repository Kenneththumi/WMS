@extends('../layouts.app')

@section('content')
    <div class="panel panel-info panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <div class="panel-title">Orders Feedback</div>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                    </div>
                </div>
            </div>
        </div>
        <form action="{{route('delFeedback')}}" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
                <table class="table table-hover table-striped table-list  table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 15px">&nbsp;</th>
                        <th  style="width: 50px">Order</th>
                        <th  style="width: 75px">Assigned</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                        <tr>
                            <td ><input type="checkbox" name="chk[]" value="{{$message->id}}" /> &nbsp;</td>
                            <td><a href="{{ route('getOrder',$message->order_id) }}" class="btn btn-{{$message->order()->first()->status}} btn-sm">{{$message->order()->first()->order_id}}</a></td>
                            <td>
                                <a href="{{ route('getWriter',$message->order()->first()->user_id) }}" class="btn btn-info btn-sm">
                                    {{ucwords($message->order()->first()->user()->first()->fname)}}{{' '}}
                                    {{ucwords($message->order()->first()->user()->first()->lname)}}
                                </a>
                            </td>
                            <td>{!! $message->message !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>





            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        @if(!empty($message))
                            {{ $messages->links() }}
                        @endif
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