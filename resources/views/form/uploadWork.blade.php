@extends('layouts.app')

@section('content')
    <div class="profile">

        <div class="panel panel-success">
            <div class="panel-heading">Upload work :<a href="{{route('getOrder',$order->id)}}" class="btn btn-success btn-sm">{{$order->order_id}}</a>
            </div>
            <div class="panel-body">
                <p>
                    <form action="{{route('uploadWork')}}" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                    Upload File:<input type="file" name="file"/>
                    <input type="hidden" name="id"  value="{{$order->id}}"/><br>
                    <input type="submit"  class="btn btn-sm btn-success"/>
                    </form>
                </p>

            </div>
            <div class="panel-footer"></div>
        </div>

    </div>
@endsection