<header class="d-flex justify-content-between align-items-center header">
    <img class="logo" src="{{$logo}}" alt="LuxFiat Logo">
    <div class="dropdown" style="padding-right: 10px">
        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <img
                src="https://img.freepik.com/premium-photo/cartoonish-3d-animation-boy-glasses-with-blue-hoodie-orange-shirt_899449-25777.jpg"
                alt="Avatar" class="avatar">
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-center">
            <li><img
                    src="https://img.freepik.com/premium-photo/cartoonish-3d-animation-boy-glasses-with-blue-hoodie-orange-shirt_899449-25777.jpg"
                    alt="Avatar" class="avatar"></li>
            <li class="dropdown-header">{{Auth::guard('web')->user()->first_name .' '. Auth::guard('web')->user()->last_name}}</li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{route('profile')}}"><i class="fa-solid fa-user"></i> View Profile</a></li>
            <li><a class="dropdown-item" href="{{route('resubmit')}}"><i class="fa-solid fa-file"></i> Resubmit Timesheets</a></li>
            <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </li>
        </ul>
    </div>
</header>
