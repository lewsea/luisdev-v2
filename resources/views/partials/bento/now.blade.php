<x-bento.card class="flex w-full flex-col">
    <div class="flex items-center justify-between">
        <x-bento.eyebrow>{{ __('Now', 'sage') }}</x-bento.eyebrow>
        <span class="text-xs font-medium text-neutral-400 dark:text-neutral-500">{{ date('M j, Y') }}</span>
    </div>

    <ul class="mt-4 space-y-3">
        @foreach ([
            ['eyebrow' => __('Building', 'sage'), 'text' => __('A bento-grid portfolio (you\'re looking at it)', 'sage')],
            ['eyebrow' => __('Griefing', 'sage'), 'text' => 'Griefing Games in Marvel Rivals Ranked'],
            ['eyebrow' => __('Pretending', 'sage'), 'text' => __('So hard at everything', 'sage')],
            ['eyebrow' => __('Running', 'sage'), 'text' => __('I quantify the speed of my unhappiness. As long as it can\'t catch me. I can\'t be depressed.', 'sage')],
        ] as $item)
            <li class="group/now flex items-start gap-3">
                <span aria-hidden="true" class="mt-1.5 inline-block h-2 w-2 shrink-0 rounded-full bg-neon-400 ring-4 ring-neon-400/20 transition group-hover/now:scale-125"></span>
                <div class="min-w-0 flex-1">
                    <p class="text-[11px] font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">{{ $item['eyebrow'] }}</p>
                    <p class="text-sm text-neutral-800 dark:text-neutral-200">{{ $item['text'] }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</x-bento.card>
