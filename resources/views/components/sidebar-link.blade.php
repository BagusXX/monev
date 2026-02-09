@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-sm font-medium text-white bg-primary-600 rounded-lg shadow-md'
            : 'flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:text-primary-\ hover:bg-primary-50 rounded-lg transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} @click="if (window.innerWidth < 1024) { $dispatch('sidebar-close') }">
    {{ $slot }}
</a>
