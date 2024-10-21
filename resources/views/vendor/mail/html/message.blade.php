@component('mail::layout')

    @slot('header')
        @php
            $logo = DB::table('settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
        @endphp
        @component('mail::header', ['url' => 'https://afotracx.luxfiat.co.za/'])
            <img src="{{asset($logo)}}" style="width: auto;height:70px;background-color: black">
        @endcomponent
    @endslot

    {{ $slot }}

    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
