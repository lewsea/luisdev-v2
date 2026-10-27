<x-bento.card tone="dark" class="flex w-full flex-col justify-between">
    <div class="relative flex items-center justify-between">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-neon-300">
            {{ __('Get in touch', 'sage') }}
        </h2>
        <span class="inline-flex items-center gap-1.5 rounded-full bg-neon-400/20 px-2.5 py-1 text-xs font-medium text-neon-300">
            <span class="h-1.5 w-1.5 animate-[blinking_2s_ease-in-out_infinite] rounded-full bg-neon-400"></span>
            {{ __('NOT Available for work', 'sage') }}
        </span>
    </div>

    <a href="mailto:luis.gudmalin@gmail.com" title="{{ __('Email Luis', 'sage') }}" class="relative mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-neon-400 px-4 py-3 font-medium text-neutral-900 no-underline transition hover:bg-neon-300 hover:shadow-[0_0_30px_-5px_var(--color-neon-400)]">
        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
        </svg>
        <span class="truncate">luis.gudmalin@gmail.com</span>
    </a>

    <div class="relative mt-5 flex flex-wrap items-center gap-2">
        @php(
    $socials = [
        ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/luis-gudmalin-8b0349195/'],
        ['label' => 'GitHub', 'url' => 'https://github.com/lewsea'],
        ['label' => 'Lichess', 'url' => 'https://lichess.org/@/lewsea'],
        ['label' => 'freeCodeCamp', 'url' => 'https://www.freecodecamp.org/lewsea/'],
        ['label' => 'Steam', 'url' => 'https://steamcommunity.com/id/lewsea14/'],
    ]
)
        @foreach ($socials as $s)
            <x-bento.social-link :href="$s['url']" :label="$s['label']" />
        @endforeach
    </div>
</x-bento.card>
