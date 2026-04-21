@props(['active'])

@php
$classes = ($active ?? false)
            // === MENU AKTIF ===
            ? 'inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 text-sm font-bold rounded-full transition duration-200 ease-in-out focus:outline-none'
            
            // === MENU TIDAK AKTIF ===
            : 'inline-flex items-center px-4 py-2 text-gray-500 text-sm font-medium rounded-full hover:text-gray-900 hover:bg-gray-50 transition duration-200 ease-in-out focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>