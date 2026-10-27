<x-bento.card tone="dark" class="flex w-full flex-col justify-between">
    {{-- Decorative glow blobs --}}
    <div aria-hidden="true" class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-neon-400/30 blur-3xl"></div>
    <div aria-hidden="true" class="pointer-events-none absolute -bottom-20 -left-10 h-40 w-40 rounded-full bg-neon-500/20 blur-3xl"></div>

    <div class="relative flex items-center justify-between">
        <h2 class="text-sm font-semibold uppercase tracking-wider text-neon-300">
            {{ __('Get in touch', 'sage') }}
        </h2>
        <span class="inline-flex items-center gap-1.5 rounded-full bg-neon-400/20 px-2.5 py-1 text-xs font-medium text-neon-300">
            <span class="h-1.5 w-1.5 animate-[blinking_2s_ease-in-out_infinite] rounded-full bg-neon-400"></span>
            {{ __('NOT Available for work', 'sage') }}
        </span>
    </div>

    <a href="mailto:luis.gudmalin@gmail.com" title="{{ __('Email Luis', 'sage') }}" class="relative mt-6 inline-flex w-full items-center justify-center rounded-xl bg-neon-400 px-4 py-3 font-medium text-neutral-900 no-underline transition hover:bg-neon-300 hover:shadow-[0_0_30px_-5px_var(--color-neon-400)]">
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
