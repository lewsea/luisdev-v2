@props([
    'tone' => 'cream',
    'padded' => true,
])

@php
    $tones = [
        'cream' => 'border border-cream-300/60 bg-cream-50 dark:border-neutral-800 dark:bg-neutral-900',
        'dark' => 'border border-neutral-900 bg-neutral-900 text-neutral-50 dark:border-neutral-700',
        'invert' => 'border border-neutral-900 bg-neutral-900 text-neutral-50 dark:border-neon-400 dark:bg-neon-400 dark:text-neutral-900',
    ];

    $base = 'group relative overflow-hidden rounded-2xl shadow-sm transition hover:shadow-md';
    $toneClass = $tones[$tone] ?? $tones['cream'];
    $padding = $padded ? 'p-6' : '';
@endphp

<section data-bento-card {{ $attributes->class([$base, $toneClass, $padding]) }}>
    {{ $slot }}
</section>
