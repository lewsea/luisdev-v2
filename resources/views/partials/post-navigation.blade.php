@php
    $previous = get_previous_post();
    $next = get_next_post();
@endphp

@if ($previous || $next)
    <nav class="mt-12 grid grid-cols-1 gap-4 border-t border-cream-300/60 pt-8 sm:grid-cols-2 dark:border-neutral-800"
        aria-label="{{ __('Post navigation', 'sage') }}">
        @if ($previous)
            <a href="{{ get_permalink($previous) }}"
                class="group flex flex-col gap-1 rounded-2xl border border-cream-300/60 bg-cream-50 p-5 transition hover:-translate-y-0.5 hover:border-neon-400 hover:shadow-md dark:border-neutral-800 dark:bg-neutral-900">
                <span class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                    &larr; {{ __('Previous', 'sage') }}
                </span>
                <span
                    class="line-clamp-2 text-sm font-semibold text-neutral-900 transition group-hover:text-neon-600 dark:text-neutral-100 dark:group-hover:text-neon-300">
                    {{ get_the_title($previous) }}
                </span>
            </a>
        @else
            <span class="hidden sm:block"></span>
        @endif

        @if ($next)
            <a href="{{ get_permalink($next) }}"
                class="group flex flex-col items-end gap-1 rounded-2xl border border-cream-300/60 bg-cream-50 p-5 text-right transition hover:-translate-y-0.5 hover:border-neon-400 hover:shadow-md dark:border-neutral-800 dark:bg-neutral-900">
                <span class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">
                    {{ __('Next', 'sage') }} &rarr;
                </span>
                <span
                    class="line-clamp-2 text-sm font-semibold text-neutral-900 transition group-hover:text-neon-600 dark:text-neutral-100 dark:group-hover:text-neon-300">
                    {{ get_the_title($next) }}
                </span>
            </a>
        @endif
    </nav>
@endif
