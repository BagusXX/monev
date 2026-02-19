@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-primary-600 to-primary-700 rounded-lg shadow-md active:shadow-lg transition-all duration-200'
            : 'flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:text-primary-700 hover:bg-primary-50 active:bg-primary-100 rounded-lg transition-all duration-200 ease-in-out active:scale-95';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} 
   @click="if (window.innerWidth < 1024) { $dispatch('sidebar-close') }" 
   role="menuitem">
    {{ $slot }}
</a>

