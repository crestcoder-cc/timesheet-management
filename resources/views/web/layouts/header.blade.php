<header class="d-flex justify-content-between align-items-center header">
    <a href="{{route('/')}}">
        <img class="logo" src="{{$logo}}" alt="LuxFiat Logo">
    </a>
    <div class="dropdown" style="padding-right: 10px">
        <a href="{{route('/')}}" data-bs-toggle="dropdown" aria-expanded="false">
            <img
                src="{{Auth::user()->image}}"
                alt="Avatar" class="avatar">
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-center">
            <li><img
                    src="{{Auth::user()->image}}"
                    alt="Avatar" class="avatar"></li>
            <li class="dropdown-header">{{Auth::guard('web')->user()->first_name .' '. Auth::guard('web')->user()->last_name}}</li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{route('profile')}}"><i class="fa-solid fa-user"></i> View Profile</a>
            </li>
            <li><a class="dropdown-item" href="{{route('resubmit')}}"><i class="fa-solid fa-file"></i> Resubmit
                    Timesheets</a></li>
            <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout</a>
            </li>
        </ul>
    </div>
</header>
