@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
                <x-application-logo class="block h-15 w-auto fill-current text-gray-800" />
                {!! $slot !!}
            @endif
        </a>
    </td>
</tr>
