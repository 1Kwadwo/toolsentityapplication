@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-4 pe-4 py-3 border-l-4 border-blue-500 text-start text-base font-semibold text-blue-700 bg-gradient-to-r from-blue-50 to-purple-50 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-600 transition-all duration-200 ease-in-out rounded-r-lg'
            : 'block w-full ps-4 pe-4 py-3 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-white/50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition-all duration-200 ease-in-out rounded-r-lg';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
