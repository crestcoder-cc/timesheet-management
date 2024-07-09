<div class="sidebar">
    <div class="logo" style="background-color: black">
        <a href="{{route('admin.dashboard')}}"><img src="{{asset($logo)}}" alt="logo"></a>
    </div>
    <ul>
        <li>
            <a href="{{route('admin.dashboard')}}" class="active"><img src="{{asset('assets/admin/images/home.png')}}" alt="home">Home</a>
        </li>
        <li>
            <a href="{{route('admin.company.index')}}"><img src="{{asset('assets/admin/images/drivers.png')}}" alt="drivers">Total Companies</a>
            <ul>
                <li><a href="{{route('admin.company.index')}}"><img src="{{asset('assets/admin/images/arrow-left.png')}}" alt="arrow-left">List of Companies</a></li>
            </ul>
        </li>
        <li>
            <a href="{{route('admin.setting.index')}}"><img src="{{asset('assets/admin/images/settings.png')}}" alt="Settings">Settings</a>
        </li>
        <li>
            <a href="{{route('admin.my-profile')}}"><img src="{{asset('assets/admin/images/profile.png')}}" alt="Profile">Profile</a>
        </li>
        <li>
            <a href="{{route('admin.logout')}}" class="logout"><img src="{{asset('assets/admin/images/logout.png')}}" alt="Logout">Logout</a>
        </li>
    </ul>
</div>
