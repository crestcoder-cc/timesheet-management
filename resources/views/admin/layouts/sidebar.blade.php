<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        @if(!empty($logo))
            <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset($logo)}}" alt="" height="50">
                    </span>
                <span class="logo-lg">
                          <span
                              class="logo-lg text-white text-center fs-2"><img src="{{asset($logo)}}"
                                                                               alt="" height="50"></span>
                    </span>
            </a>
            <a href="#" class="logo logo-light">
        <span class="logo-sm">
            <img src="{{asset('assets/images/branding/driver.jpg')}}" alt="" height="22">
        </span>
                <span class="logo-lg">
              <span
                  class="logo-lg text-white text-center fs-2"><img src="{{asset($logo)}}" alt=""
                                                                   height="50"></span>
        </span>
            </a>
        @else
            <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/logo/logo.jpeg')}}" alt="" height="50">
                    </span>
                <span class="logo-lg">
                          <span
                              class="logo-lg text-white text-center fs-2"><img src="{{asset('assets/logo/logo.jpeg')}}"
                                                                               alt="" height="50"></span>
                    </span>
            </a>
            <a href="#" class="logo logo-light">
        <span class="logo-sm">
            <img src="{{asset('assets/images/branding/driver.jpg')}}" alt="" height="22">
        </span>
                <span class="logo-lg">
              <span
                  class="logo-lg text-white text-center fs-2"><img src="{{asset('assets/logo/logo.jpeg')}}" alt=""
                                                                   height="50"></span>
        </span>
            </a>
        @endif



        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) === 'dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}" role="button">
                        <i class="ri-dashboard-2-line"></i> <span
                            data-key="t-dashboards">{{trans('messages.sidebar_dashboard')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) === 'company') ? 'active' : '' }}"
                       href="{{ route('admin.company.index') }}" role="button">
                        <i class="ri-bank-fill"></i><span
                            data-key="t-dashboards">Companies</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->segment(2) === 'setting') ? 'active' : '' }}"
                       href="{{ route('admin.setting.index') }}" role="button">
                        <i class="ri-settings-2-line"></i><span
                            data-key="t-dashboards">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
