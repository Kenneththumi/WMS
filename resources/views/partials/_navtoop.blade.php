<!-- Right Side Of Navbar -->
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guest())
        {{--<li><a class="btn btn-success" href="{{ url('/login') }}">Sign in!</a></li>--}}

    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding-top: 5px; padding-bottom: 0px">
                <div style="height: 55px">
                    <div style="width: 50px; margin: auto; float:left; margin-right: 3.5px">

                        <img src="{{URL::to($img_profile != null?'/uploads/users/'.$img_profile->user_img:'/uploads/users/user_place_holder.png')}}" width="50" height="50" class="img-circle">
                    </div>
                    <div style="float: left; margin-top: 15px;">
                        {{ ucwords(Auth::user()->username) }}<span class="caret"></span><br>

                        <?php echo !empty($notifications)?'<span class="badge"><small>'.$notifications.'</small></span>':''; ?>
                    </div>

                </div>
            </a>

            <ul class="dropdown-menu" role="menu">

                <li><a href="/profile"><small><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>View Profile</small></a></li>
                <li  >
                    <a>
                        <small>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            Roles: {{$role_names}}

                        </small>
                    </a>
                </li>

                <li><a href="{{ url('/logout') }}"><small><i class="fa fa-btn fa-sign-out"></i>Logout</small></a></li>
            </ul>
        </li>
    @endif
</ul>
