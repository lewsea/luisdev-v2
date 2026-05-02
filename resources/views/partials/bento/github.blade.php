<x-bento.card class="flex w-full flex-col">
    <div class="flex items-center justify-between">
        <div>
            <x-bento.eyebrow>{{ __('Recent on GitHub', 'sage') }}</x-bento.eyebrow>
            <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                {{ __('Recent things I have been building', 'sage') }}
            </p>
        </div>
        <a
            href="https://github.com/lewsea"
            target="_blank"
            rel="noopener noreferrer"
            class="hidden items-center gap-1.5 rounded-full border border-cream-300 bg-cream-100 px-3 py-1.5 text-xs font-medium text-neutral-700 no-underline transition hover:border-neon-400 hover:bg-neon-300/40 sm:inline-flex dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-200 dark:hover:border-neon-400 dark:hover:bg-neon-400/10 dark:hover:text-neon-300"
        >
            @lewsea <span aria-hidden="true">→</span>
        </a>
    </div>

    @if (! empty($repos))
        <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($repos as $repo)
                <a
                    href="{{ $repo['url'] ?? '#' }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="group/repo relative flex flex-col gap-2 rounded-xl border border-cream-300/60 bg-cream-100 p-4 no-underline transition hover:-translate-y-0.5 hover:border-neon-400 hover:bg-cream-50 hover:shadow-md dark:border-neutral-800 dark:bg-neutral-800/60 dark:hover:border-neon-400 dark:hover:bg-neutral-800"
                >
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="text-neutral-500 dark:text-neutral-400">
                            <path d="M2 2.5A2.5 2.5 0 0 1 4.5 0h8.75a.75.75 0 0 1 .75.75v12.5a.75.75 0 0 1-.75.75h-2.5a.75.75 0 0 1 0-1.5h1.75v-2h-8a1 1 0 0 0-.714 1.7.75.75 0 1 1-1.072 1.05A2.495 2.495 0 0 1 2 11.5Zm10.5-1h-8a1 1 0 0 0-1 1v6.708A2.486 2.486 0 0 1 4.5 9h8ZM5 12.25a.25.25 0 0 1 .25-.25h3.5a.25.25 0 0 1 .25.25v3.25a.25.25 0 0 1-.4.2l-1.45-1.087a.249.249 0 0 0-.3 0L5.4 15.7a.25.25 0 0 1-.4-.2Z"/>
                        </svg>
                        <span class="truncate font-medium text-neutral-900 group-hover/repo:text-neon-600 dark:text-neutral-100 dark:group-hover/repo:text-neon-300">
                            {{ $repo['repo'] ?? $repo['name'] ?? 'repo' }}
                        </span>
                    </div>

                    @if (! empty($repo['description']))
                        <p class="line-clamp-2 text-xs leading-relaxed text-neutral-600 dark:text-neutral-400">
                            {{ $repo['description'] }}
                        </p>
                    @endif

                    <div class="mt-auto flex items-center gap-3 pt-2 text-xs text-neutral-500 dark:text-neutral-400">
                        @if (! empty($repo['language']))
                            <span class="inline-flex items-center gap-1.5">
                                <span class="inline-block h-2 w-2 rounded-full" style="background-color: {{ $repo['languageColor'] ?? '#9eff00' }}"></span>
                                {{ $repo['language'] }}
                            </span>
                        @endif
                        @if (! empty($repo['stars']))
                            <span class="inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                    <path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Z"/>
                                </svg>
                                {{ $repo['stars'] }}
                            </span>
                        @endif
                        @if (! empty($repo['forks']))
                            <span class="inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                    <path d="M5 5.372v.878c0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75v-.878a2.25 2.25 0 1 1 1.5 0v.878a2.25 2.25 0 0 1-2.25 2.25h-1.5v2.128a2.251 2.251 0 1 1-1.5 0V8.5h-1.5A2.25 2.25 0 0 1 3.5 6.25v-.878a2.25 2.25 0 1 1 1.5 0ZM5 3.25a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Zm6.75.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm-3 8.75a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Z"/>
                                </svg>
                                {{ $repo['forks'] }}
                            </span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="mt-5 rounded-xl border border-dashed border-cream-300 bg-cream-100/50 p-6 text-center text-sm text-neutral-500 dark:border-neutral-700 dark:bg-neutral-800/40 dark:text-neutral-400">
            {{ __('Recent repositories will appear here.', 'sage') }}
            <a href="https://github.com/lewsea" target="_blank" rel="noopener noreferrer" class="font-medium text-neon-600 no-underline hover:text-neon-500 dark:text-neon-400">
                {{ __('Visit GitHub', 'sage') }} →
            </a>
        </div>
    @endif
</x-bento.card>
