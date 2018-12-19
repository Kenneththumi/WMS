@extends('layouts.app')

@section('content')
<div class="profile">

        <div class="panel panel-success">
            <div class="panel-heading">Writer
                <div class="pull-right">
                    @if( auth()->user()->isSuperAdmin() && $user->role == '0')

                        <a  href="#" class="btn btn-sm btn-success"
                            onclick="event.preventDefault();
                                                     document.getElementById('activate-form').submit();">
                            Activate
                        </a>
                        <form id="activate-form" action="{{ route('activate',$user->id) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @else
                        <a  href="#" class="btn btn-sm btn-warning"
                            onclick="event.preventDefault();
                                                     document.getElementById('deactivate-form').submit();">
                            Deactivate
                        </a>
                        <form id="deactivate-form" action="{{ route('deactivate',$user->id) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                    {{--delete--}}
                    @if(auth()->user()->isSuperAdmin())
                    <a  href="/delWriter/{{$user->id}}" class="btn btn-sm btn-danger delete" >
                        <em class="fa fa-trash"></em>
                    </a>
                        @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                       <div class="item-profile">
                           <div><strong>Name:&nbsp;</strong>{{ucwords($user->fname.' '.$user->lname)}}</div>
                           <br>
                           <div><strong>ID No./Passport:&nbsp;</strong>{{$user->passport}}</div>
                           <br>
                           <div><strong>Tel:&nbsp;</strong>{{$user->tel}}{{ !empty($user->moreinfo['tel2'])?' / '.$user->moreinfo['tel2']:'' }}</div>
                           <br>
                           <div><strong>Email:&nbsp;</strong>{{$user->email}}</div>
                                                     <br>
                           <div><strong>Highest Academic Qualification:&nbsp;</strong>{{$user->moreinfo['highest_qualification']}}</div>
                           <br>
                           <div><strong>24Hr Availability:&nbsp;</strong>{{$user->moreinfo['availability']}}</div>
                           <br>
                           <div><strong>Role:&nbsp;</strong>{{$user->role}}</div>
                           <br>
                           <div><strong>City:&nbsp;</strong>{{$user->moreinfo['city']}}</div>
                           <br>
                           <div><strong>Worked Previous:&nbsp;</strong>{{$user->moreinfo['previous_work'].', '.$user->moreinfo['previous_work_timeline']}}</div>
                           <br>
                           <div><strong>Familiar Citations:&nbsp;</strong>{{$user->moreinfo['citations']}}</div>
                           <br>
                           <div><strong>Proficiencies:&nbsp;</strong>{{$user->moreinfo['proficiencies']}}</div>
                           <br>
                           <div>
                               <hr><strong>Relevant Details:&nbsp;</strong>{{$user->moreinfo['relevant_info']}}</div>
                           <br>
                           <hr>
                       </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{asset('profileImgs/'.$user->image_path)}}" class="img-responsive img-circle" />
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-4">
                        <div class="pull-left"><strong>Rating(%):</strong>
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
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="pull-left"><strong>Conversion(%):</strong>{{ $user->rating()->exists()?($user->rating['completed']/$user->rating['total'])*100 :''}}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="pull-left"><strong>Jobs:</strong>{{$user->rating['total'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer"></div>
        </div>

</div>
    @endsection