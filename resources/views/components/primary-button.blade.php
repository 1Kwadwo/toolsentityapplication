<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all duration-200 shadow-lg']) }}>
    {{ $slot }}
</button>
