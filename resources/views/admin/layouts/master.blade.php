<!DOCTYPE html>
{{--<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-layout-mode="dark">--}}
<html style="background-color: #DDE0EB" lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">

<head>
    <base href="">
    @php
        $title = DB::table('settings')->where('setting_key','SITE_TITLE')->first()->setting_value;
        $logo = DB::table('settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
        $favicon = DB::table('settings')->where('setting_key','FAVICON_IMG')->first()->setting_value;
    @endphp
    <title>{{ $title }} | @yield('title')</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="{{ asset($favicon)}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{  asset($favicon)}}"
          type="image/x-icon">
    @include('admin.layouts.css')
    @yield('style')
</head>

<body>
<!-- Begin page -->
<div id="layout-wrapper">

    @include('admin.layouts.head')

    @include('admin.layouts.sidebar')
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>
    <div class="main-content" style="background: #DDE0EB;">
        <div class="page-content" >
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
{{--    @include('admin.layouts.footer')--}}
    @include('admin.layouts.footer')
</div>
<!-- END layout-wrapper -->
<!-- Modal start -->
<div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true" id="detailsModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="details_modal_body">

            </div>
            <div class="modal-footer" id="details_modal_footer">
                <button type="button" class="btn btn-primary " data-bs-dismiss="modal"
                        aria-label="Close">{{trans('messages.modal_close_btn')}}</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
@include('admin.layouts.script')
@yield('custom-script')
</body>
</html>
