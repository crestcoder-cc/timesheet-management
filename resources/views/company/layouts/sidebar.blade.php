<div class="sidebar">
    <div class="logo" style="background-color: black">
        <a href="{{route('company.dashboard')}}"><img src="{{asset($logo)}}" alt="logo"></a>
    </div>
    <ul>
        <li>
            <a href="{{route('company.dashboard')}}" class="active"><img src="{{asset('assets/admin/images/home.png')}}" alt="home">Home</a>
        </li>
        <li>
            <a href="{{route('company.employee.index')}}"><img src="{{asset('assets/admin/images/drivers.png')}}" alt="drivers">Total Employees</a>
            <ul>
                <li><a href="{{route('company.employee.index')}}"><img src="{{asset('assets/admin/images/arrow-left.png')}}" alt="arrow-left">List of Employees</a></li>
            </ul>
        </li>
        <li>
            <a href="{{route('company.my-profile')}}"><img src="{{asset('assets/admin/images/profile.png')}}" alt="Profile">Profile</a>
        </li>
        <li>
            <a href="{{route('company.logout')}}" class="logout"><img src="{{asset('assets/admin/images/logout.png')}}" alt="Logout">Logout</a>
        </li>
    </ul>
</div>
