<nav class="navtop">
    <div class="container">
        <div class="row">
        <div class="navbar-header" style="width: 100%">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('images/logo.png')}}" alt=""  width="200" alt="logo" class="img-responsive">
            </a>

            {{--imported--}}
        <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right" style="margin-top: 10px">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a class="btn btn-success btn-sm" href="{{ url('/login') }}">Sign in!</a></li>

                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding-top: 5px; padding-bottom: 0px">
                            <div style="height: 55px">
                                <div style="width: 50px; margin: auto; float:left; margin-right: 3.5px">

                                    <img src="{{URL::to(auth()->user()->image_path != null?'/profileImgs/'.auth()->user()->image_path:'/profileImgs/img_placeholder.png')}}" alt="profile image" width="50" height="50" class="img-circle">
                                </div>
                                <div style="float: left; margin-top: 15px;">
                                    {{ ucwords(auth()->user()->fname .' '.auth()->user()->lname) }}<span class="caret"></span><br>

                                    <?php /*echo !empty($notifications)?'<span class="badge"><small>'.$notifications.'</small></span>':'';*/ ?>
                                </div>

                            </div>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                            <li><a href="/profile"><small><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>View Profile</small></a></li>
                            <li  >
                                <a>
                                    <small>
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                        Roles: {{auth()->user()->getrole()}}

                                    </small>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                   <small><i class="fa fa-btn fa-sign-out"></i>
                                    Logout</small>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    </div>
</nav>