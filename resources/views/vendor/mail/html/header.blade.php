<tr>
    <td class="header" style="padding: 25px 0; text-align: center; background-color: #362F2E;">
        <a href="{{ config('app.url') }}" style="display: inline-block; color: #ffffff; font-size: 19px; font-weight: bold; text-decoration: none;">
            @if(get_setting('logo_kiri'))
                <img src="{{ asset(Storage::url(get_setting('logo_kiri'))) }}" class="logo" alt="Logo" style="width: 75px; max-width: 100%; border: none; -ms-interpolation-mode: bicubic;">
            @else
                {{ get_setting('app_name') ?? config('app.name', 'Laravel') }}
            @endif
        </a>
    </td>
</tr>