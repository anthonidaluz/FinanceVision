@props([
    'icon' => 'fa-solid fa-lightbulb',
    'theme' => 'primary'
])
@php
    $themeClasses = [
        'primary' => 'bg-blue-50 border-blue-200',
        'success' => 'bg-green-50 border-green-200',
        'warning' => 'bg-yellow-50 border-yellow-200',
        'danger' => 'bg-red-50 border-red-200',
        'info' => 'bg-indigo-50 border-indigo-200',
    ];
@endphp

<article class="{{ $themeClasses[$theme] }} rounded-xl shadow-sm p-6 space-y-4 h-full flex flex-col">
    <div class="flex-grow">
    {{ $slot }}
</div>
@isset($cta)
    <div class="pt-2 mt-auto">
        {{ $cta }}
    </div>
@endisset
</article>