@props(['active', 'role' => true])

@if ($active)
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endif
<a
    {{ $attributes->merge(['class' => 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800', 'href' => $role ? $attributes->get('href', '#') : '#', 'onclick' => $role ? $attributes->get('onclick', '') : 'event.preventDefault();']) }}>
    {{ $icon ?? '' }}
    <span class="ml-4">{{ $slot }}</span>
</a>
