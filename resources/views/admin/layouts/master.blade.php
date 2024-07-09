<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $title = DB::table('settings')->where('setting_key','SITE_TITLE')->first()->setting_value;
        $logo = DB::table('settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
        $favicon = DB::table('settings')->where('setting_key','FAVICON_IMG')->first()->setting_value;
    @endphp
    <title>{{$title}} - @yield('title')</title>
    <link rel="icon" href="{{ asset($favicon)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{  asset($favicon)}}"
          type="image/x-icon">
    @include('admin.layouts.css')
</head>
<body>
<div class="dashboard">
    <div class="main-app">
        @include('admin.layouts.sidebar')
        <div class="content">
            @include('admin.layouts.header')
            @yield('content')
        </div>
    </div>
</div>
@include('admin.layouts.script')
@yield('custom-script')
</body>
</html>
