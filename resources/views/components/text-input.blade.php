@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-lg bg-white/80 backdrop-blur-sm transition-all duration-200']) }}>
