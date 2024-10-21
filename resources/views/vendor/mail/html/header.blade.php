<tr>
    <td class="header">
        @php
            $logo = DB::table('settings')->where('setting_key','LOGO_IMG')->first()->setting_value;
        @endphp
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'header')
                <img src="{{ asset($logo) }}" style="width: auto;height:70px;background-color: black">
            @else
                <img src="{{ asset($logo) }}" style="width: auto;height:70px;background-color: black">
            @endif
        </a>
    </td>
</tr>
