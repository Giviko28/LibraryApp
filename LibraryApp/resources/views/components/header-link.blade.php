@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'text-indigo-400 inline-flex items-center px-1 pt-1  text-sm font-medium leading-5 text-gray-900 focus:outline-none duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1  text-sm font-medium leading-5 text-gray-900 focus:outline-none duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
