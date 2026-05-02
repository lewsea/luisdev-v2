@props([
    'href' => '#',
    'primary' => __('Probably procrastinating', 'sage'),
    'secondary' => __('Say hi anyway', 'sage'),
])

<div class="pointer-events-none fixed inset-x-0 bottom-0 z-10 flex justify-center px-4 pb-5 md:pb-6">
    <a
        href="{{ $href }}"
        class="pointer-events-auto group/float inline-flex items-center gap-2.5 rounded-full border border-neutral-200/80 bg-cream-50/90 py-2.5 pl-3 pr-4 text-sm font-medium text-neutral-900 no-underline shadow-lg shadow-neutral-900/10 backdrop-blur-xl transition hover:-translate-y-0.5 hover:border-neon-400 hover:bg-cream-50 dark:border-neutral-800 dark:bg-neutral-900/90 dark:text-neutral-100 dark:hover:border-neon-400"
    >
        <span class="relative flex h-2.5 w-2.5 items-center justify-center" aria-hidden="true">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-neon-400 opacity-75"></span>
            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-neon-500"></span>
        </span>
        <span>{{ $primary }}</span>
        <span class="hidden text-neutral-400 dark:text-neutral-500 sm:inline">·</span>
        <span class="hidden text-neutral-600 group-hover/float:text-neutral-900 dark:text-neutral-300 dark:group-hover/float:text-neon-300 sm:inline">{{ $secondary }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" class="transition group-hover/float:translate-x-0.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
        </svg>
    </a>
</div>
