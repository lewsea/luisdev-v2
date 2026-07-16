@props([
    'autofocus' => false,
])

@php($inputId = 'search-' . uniqid())

{{-- Native WordPress site-search form (GET to home with the `s` query var). --}}
<form role="search" method="get" action="{{ home_url('/') }}"
    {{ $attributes->class(['relative flex w-full items-center']) }}>
    <label for="{{ $inputId }}" class="sr-only">{{ __('Search for:', 'sage') }}</label>

    <svg xmlns="http://www.w3.org/2000/svg"
        class="pointer-events-none absolute left-4 h-5 w-5 text-neutral-400 dark:text-neutral-500" fill="none"
        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
    </svg>

    <input type="search" id="{{ $inputId }}" name="s" value="{{ get_search_query() }}"
        placeholder="{{ __('Search articles…', 'sage') }}" @if ($autofocus) autofocus @endif
        class="h-12 w-full rounded-xl border border-cream-300/60 bg-cream-50 pl-11 pr-28 text-sm text-neutral-900 shadow-sm outline-none transition placeholder:text-neutral-400 focus:border-neon-400 focus:ring-2 focus:ring-neon-400/40 dark:border-neutral-800 dark:bg-neutral-900 dark:text-neutral-100 dark:placeholder:text-neutral-500">

    <button type="submit"
        class="absolute right-1.5 inline-flex h-9 items-center rounded-lg bg-neon-400 px-4 text-sm font-semibold text-neutral-900 transition hover:shadow-[0_0_20px_-4px_var(--color-neon-400)]">
        {{ __('Search', 'sage') }}
    </button>
</form>
