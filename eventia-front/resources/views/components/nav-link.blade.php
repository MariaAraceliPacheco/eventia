@props(['active' => false])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-primary border-b-2 border-primary transition duration-150 ease-in-out focus:outline-none focus:border-indigo-700'
            : 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-text-secondary hover:text-primary hover:border-b-2 hover:border-primary transition duration-150 ease-in-out focus:outline-none focus:text-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
