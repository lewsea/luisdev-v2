<header
    class="sticky top-0 z-40 border-b border-cream-300/60 bg-cream-100/80 backdrop-blur-xl transition-colors dark:border-neutral-800 dark:bg-neutral-950/80">
    <div class="mx-auto flex w-full max-w-5xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <a href="{{ home_url('/') }}"
            class="inline-flex items-center gap-2 text-base font-bold tracking-tight text-neutral-900 transition hover:text-neon-600 dark:text-neutral-100 dark:hover:text-neon-300">
            <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-neon-400 text-neutral-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"
                    aria-hidden="true">
                    <path
                        d="M11.47 3.84a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 1-1.06 1.06l-.44-.44v6.6a1.5 1.5 0 0 1-1.5 1.5h-3.75a.75.75 0 0 1-.75-.75V16.5a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75v3.75a.75.75 0 0 1-.75.75H5.78a1.5 1.5 0 0 1-1.5-1.5v-6.6l-.44.44a.75.75 0 0 1-1.06-1.06l8.69-8.69Z" />
                </svg>
            </span>
            {!! $siteName !!}
        </a>

        <nav class="flex items-center gap-2" aria-label="{{ __('Primary', 'sage') }}">
            @if (has_nav_menu('primary_navigation'))
                {!! wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'menu_class' => 'hidden items-center gap-1 sm:flex',
                    'container' => false,
                    'echo' => false,
                    'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                    'link_before' =>
                        '<span class="rounded-lg px-3 py-1.5 text-sm font-medium text-neutral-600 transition hover:bg-cream-200 hover:text-neutral-900 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:hover:text-neutral-100">',
                    'link_after' => '</span>',
                ]) !!}
            @endif

            <a href="{{ home_url('/') }}"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-cream-300/60 bg-cream-50 text-neutral-700 shadow-sm transition hover:bg-cream-200 dark:border-neutral-800 dark:bg-neutral-900 dark:text-neutral-200 dark:hover:bg-neutral-800"
                aria-label="{{ __('Home', 'sage') }}" title="{{ __('Home', 'sage') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </a>

            <x-bento.theme-toggle />
        </nav>
    </div>
</header>
