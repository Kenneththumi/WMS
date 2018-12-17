@extends('../layouts.app')

@section('content')
        <div class="panel panel-success panel-table">
            <div class="panel-heading">
                <div class="row">
                    <div class="col col-xs-6">
                        <div class="panel-title">Writers</div>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">

                            <a  href="/register" class="btn btn-sm btn-info" >
                                New
                            </a>
                        </div>
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
                           <th>Full Name</th>

                           <th>Phone No.</th>
                           <th>Email</th>
                           <th>Role</th>
                           <th>Rating </th>
                           <th>Completed Jobs</em></th>
                           <th>#</th>
                       </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><input type="checkbox" name="chk[]" value="{{$user->id}}" /> &nbsp;</td>
                                <td><a class="btn btn-sm btn-success" href="{{route('getWriter',$user->id)}}">{{$user->fname.' '.$user->lname}}</a></td>

                                <td>{{$user->tel}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a  href="/editWriter/{{$user->id}}" class="btn btn-sm btn-warning" >
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
                        {{ $users->links() }}

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