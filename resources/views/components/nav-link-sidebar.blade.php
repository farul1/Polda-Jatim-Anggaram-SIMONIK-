@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full text-left px-4 py-2 text-sm leading-5 text-white bg-kuning-polisi/20 focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full text-left px-4 py-2 text-sm leading-5 text-gray-300 hover:text-white hover:bg-kuning-polisi/10 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
