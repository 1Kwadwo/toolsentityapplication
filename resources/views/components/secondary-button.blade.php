<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-6 py-3 bg-white/80 backdrop-blur-sm border border-gray-300 rounded-xl font-semibold text-sm text-gray-700 uppercase tracking-wider shadow-lg hover:bg-white hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transform hover:scale-105 transition-all duration-200']) }}>
    {{ $slot }}
</button>
