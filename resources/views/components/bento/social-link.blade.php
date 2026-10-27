@props(['href', 'label'])

<a href="{{ $href }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }}" title="{{ $label }}" class="inline-flex min-h-10 items-center justify-center rounded-xl border border-neutral-700 bg-neutral-800/60 px-3 py-2 text-sm font-medium text-neutral-300 no-underline transition hover:-translate-y-0.5 hover:border-neon-400 hover:bg-neutral-800 hover:text-neon-300">
    {{ $label }}
</a>
