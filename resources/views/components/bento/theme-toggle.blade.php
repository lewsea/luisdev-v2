<button
    type="button"
    data-theme-toggle
    aria-label="{{ __('Toggle dark mode', 'sage') }}"
    {{ $attributes->class(['inline-flex h-10 w-10 cursor-pointer items-center justify-center rounded-xl border border-cream-300/60 bg-cream-50 text-neutral-700 shadow-sm transition hover:bg-cream-200 dark:border-neutral-800 dark:bg-neutral-900 dark:text-neutral-200 dark:hover:bg-neutral-800']) }}
>
    {{-- Sun (visible in dark mode) --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="hidden h-5 w-5 dark:block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1.5m0 15V21m8.485-8.485H21M3 12h1.515m12.02-6.02 1.06-1.06M5.405 18.595l1.06-1.06m0-12.07-1.06-1.06m13.19 13.19-1.06-1.06M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z"/>
    </svg>
    {{-- Moon (visible in light mode) --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="block h-5 w-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
    </svg>
</button>
