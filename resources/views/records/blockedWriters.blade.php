@extends('../layouts.app')

@section('content')
        <div class="panel panel-danger panel-table">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel-title">Blocked Writers</div>
                    </div>
                    <div class="col-md-4">
                        {{Form::open(array('url'=>'/searchblockedwriters','method'=>'post'))}}
                        {{csrf_field()}}
                        {{Form::text('search',null,['class'=>'form-control','placeholder'=>'search first name','required'=>''])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
            <form action="{{route('del')}}" method="post">
                {{ csrf_field() }}
            <div class="panel-body">
                <table class="table table-hover table-striped table-list">
                    <thead>
                       <tr>
                           <th>&nbsp;</th>
                           <th>Name</th>

                           <th>Phone No.</th>
                           <th>Qualification</th>
                           <th>Current Orders</th>
                           <th>24Hrs Availability</th>
                           <th>Rating(%)</th>
                           <th>Completed</th>
                           <th>Citations</th>
                           <th>Proficiencies</th>
                       </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><input type="checkbox" name="chk[]" value="{{$user->id}}" /> &nbsp;</td>
                                <td><a class="btn btn-sm btn-success" href="{{route('getWriter',$user->id)}}">{{$user->fname.' '.$user->lname}}</a></td>
                                <td>{{ $user->tel }}</td>
                                <td>{{ $user->moreinfo['highest_qualification']}}</td>
                                <td>{{$user->orders()->where('status','current')->count()}}</td>
                                <td>{{$user->moreinfo['availability']}}</td>
                                <td>
                                    <?php
                                    if( $user->rating()->exists() ){
                                        $rating = ( (($user->rating['completed']/$user->rating['total'])*100)
                                                + $user->rating['grammar']
                                                + $user->rating['speed']
                                                + $user->rating['instructions'])/4;

                                        echo $rating;
                                    }else{
                                        echo 'Not Rated';
                                    }

                                    ?>

                                     </td>
                                <td>{{$user->rating['completed']}}</td>
                                <td>{{str_limit( $user->moreinfo['citations'],16)}}</td>
                                <td>{{str_limit( $user->moreinfo['proficiencies'],16)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>





            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        {{ $users->links()}}

                        <div class="pull-right">
                            <button id="del" class="btn btn-sm btn-danger delete" type="submit">
                                <em class="fa fa-trash"></em>
                            </button>
                        </div>
                    </div>


                </div>


            </div>
            </form>
        </div>

@endsection