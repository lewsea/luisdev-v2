<footer class="mt-auto border-t border-cream-300/60 bg-cream-100/60 dark:border-neutral-800 dark:bg-neutral-950/60">
    <div
        class="mx-auto flex w-full max-w-5xl flex-col items-center justify-between gap-3 px-4 py-6 text-sm text-neutral-500 sm:flex-row sm:px-6 lg:px-8 dark:text-neutral-400">
        <p>
            &copy; {{ date('Y') }} {!! $siteName !!}. {{ __('All rights reserved.', 'sage') }}
        </p>

        <a href="#app"
            class="inline-flex items-center gap-1.5 rounded-lg px-2 py-1 font-medium transition hover:text-neon-600 dark:hover:text-neon-300">
            {{ __('Back to top', 'sage') }}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
            </svg>
        </a>
    </div>
</footer>
