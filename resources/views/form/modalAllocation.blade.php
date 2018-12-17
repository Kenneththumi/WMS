@extends('layouts.app')

@section('content')
    <div class="profile">

        <div class="panel panel-success">
            <div class="panel-heading">Allocate :
                <button class="btn btn-info btn-sm">{{$ordr->order_id}}</button>
            </div>
            <div class="panel-body">
                <form method="post" action="{{route('allocateOrder',$ordr->id)}}">
                    {{ csrf_field() }}
                    @foreach($orders as $order)
                        <div class="radio">
                            <label>
                                <input type="radio" name="writer" value="{{$order->user_id}}">
                                <a href="{{route('getWriter',$order->user_id)}}">
                                {{$user->findOrFail($order->user_id)->fname.' '.$user->findOrFail($order->user_id)->lname}}

                                </a>
                            </label>
                        </div>
                    @endforeach


                    <button class="btn btn-sm btn-success" type="submit">Allocate</button>
                </form>
            </div>
            <div class="panel-footer"></div>
        </div>

    </div>
@endsection