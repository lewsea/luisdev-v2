@php
    $title ??= __('Nothing found', 'sage');
    $message ??= __('We couldn’t find any content matching your request. Try searching for something else.', 'sage');
    $showSearch = $showSearch ?? true;
@endphp

<div
    class="flex flex-col items-center gap-6 rounded-2xl border border-dashed border-cream-300 bg-cream-50/50 px-6 py-16 text-center dark:border-neutral-800 dark:bg-neutral-900/50">
    <span
        class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-neon-400/15 text-neon-600 dark:text-neon-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.75 9.75l4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </span>

    <div class="flex flex-col gap-2">
        <h2 class="text-xl font-bold text-neutral-900 dark:text-neutral-100">
            {{ $title }}
        </h2>
        <p class="max-w-md text-sm leading-relaxed text-neutral-600 dark:text-neutral-400">
            {{ $message }}
        </p>
    </div>

    @if ($showSearch)
        <x-search-form class="max-w-md" />
    @endif
</div>
