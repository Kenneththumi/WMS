<nav class="navigation">
    <ul class="mainmenu">
        @auth
        @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
        <li  class="hav-sub"><a href="{{ route('writers') }}"><i class="fa fa-users" aria-hidden="true"></i>
                Writers</a>
            <ul class="submenu">
                <li><a href="{{route('newWriters')}}">New Writers</a></li>
                <li><a href="{{route('blocked')}}">Blocked Writers</a></li>
            </ul>
        </li>
        @endif
        <li class="hav-sub"><a href="{{route('orders')}}"><i class="fa fa-files-o" aria-hidden="true"></i>
                Orders</a>
            <ul class="submenu">
                @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <li><a href="{{route('availableOrders')}}">Available</a></li>
                @endif
                <li><a href="{{route('currentOrders')}}">Current</a></li>
                <li><a href="{{route('a_feedback')}}">Awaiting Feedback</a></li>
                <li><a href="{{route('cancelledOrders')}}">Cancelled</a></li>
                <li><a href="{{route('revisionOrders')}}">Revision</a></li>
                <li><a href="{{route('acceptedOrders')}}">Completed</a></li>
            </ul>
        </li>
        <li><a href="{{route('feedback')}}"><i class="fa fa-comments-o" aria-hidden="true"></i>
                Feedback</a></li>
            @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
        <li><a href=""><i class="fa fa-bar-chart-o" aria-hidden="true"></i>


                Reports</a></li>
        <li><a href=""><i class="fa fa-cogs" aria-hidden="true"></i>
                Configurations</a></li>
        @endif
            <li  class="hav-sub"><a href="#"><i class="fa fa-link" aria-hidden="true"></i>
                    Quicklinks</a>
                <ul class="submenu">
                    <li><a target="_blank" href="https://www.gmail.com">Gmail</a></li>
                    <li><a target="_blank" href="https://www.grammarly.com">Grammarly</a></li>
                    <li><a target="_blank" href="https://www.citefast.com">Citefast</a></li>
                    <li><a target="_blank" href="https://www.citethisforme.com">Citethisforme</a></li>
                    <li><a target="_blank" href="https://www.turnitin.com">Turnitin</a></li>
                    <li><a target="_blank" href="https://www.coursehero.com">Coursehero</a></li>
                    <li><a target="_blank" href="https://www.cheng.com">Cheng</a></li>
                    {{--<li><a target="_blank" href="https://www."></a></li>--}}
                </ul>
            </li>
            @endauth
    </ul>
</nav>